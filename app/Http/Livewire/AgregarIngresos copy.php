<?php

namespace App\Http\Livewire;

use App\Exports\IncaRailExport;
use App\Exports\MinisterioExport;
use App\Exports\PeruRailExport;
use App\Models\DetalleReserva;
use App\Models\Operar;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use Livewire\WithFileUploads;
use App\Models\Reserva;
use App\Models\Servicio;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;

class AgregarIngresos extends Component
{
    use WithFileUploads;

    public $reserva;
    public $detalle;
    public $detalles;
    public $codigo;
    public $proveedorId;
    public $observacion;
    public $precio;
    public $moneda;
    public $archivo;
    public $imagen;
    public $imagenver;
    public $proveedores;

    public $machupicchu;

    public function mount($reservaId)
    {
        $this->reserva = Reserva::find($reservaId);
        $this->proveedores = Proveedor::where('categoria_id',17)->get();

        $machupicchu = Servicio::find(305);
        $ids= $machupicchu->incluyesOperarIngresos()->pluck('id')->toArray();
        $this->machupicchu = $machupicchu->incluyesOperarIngresos();

        $detalles = DetalleReserva::select('detalle_reservas.id','servicios.id as serv_id','servicios.servicio_id')
        ->join('itinerario_reservas', 'detalle_reservas.id', '=', 'itinerario_reservas.detalle_reserva_id')
        ->join('detalle_reserva_incluyes', 'itinerario_reservas.id', '=', 'detalle_reserva_incluyes.itinerario_reserva_id')
        ->join('servicios', 'servicios.id', '=', 'detalle_reserva_incluyes.servicio_incluido_id')
        ->where('detalle_reservas.reserva_id', $reservaId)
        ->whereRelation('reserva', 'confirmado', 1)
        ->where(function ($query) use ($ids) {
            $query->whereIn('detalle_reserva_incluyes.servicio_incluido_id', $ids)
                ->orWhereIn('servicios.servicio_id', $ids);
        })->get();

        dd($detalles[0]->incluyes->where('categoria_id',17)->where('id','!=',8));

        $itinerarioIds = $this->reserva->detalles->flatMap(function($detalle) {
            return $detalle->itinerarios->pluck('id');
        })->toArray();
        // $itinerarioIds = $this->detalle->itinerarios->pluck('id')->toArray();
        $serviciosIncluidos = DB::table('detalle_reserva_incluyes')
        ->join('servicios', 'detalle_reserva_incluyes.servicio_incluido_id', '=', 'servicios.id')
        ->join('itinerario_reservas', 'itinerario_reservas.id', '=', 'detalle_reserva_incluyes.itinerario_reserva_id')
        ->join('detalle_reservas', 'detalle_reservas.id', '=', 'itinerario_reservas.detalle_reserva_id')
        ->select('servicios.id','detalle_reserva_incluyes.itinerario_reserva_id','servicios.titulo','detalle_reserva_incluyes.operar','servicios.proveedor_id','detalle_reservas.fecha_viaje',DB::raw('SUM(detalle_reservas.pax) as sum_pax'))
        ->where('servicios.categoria_id', 17)
        ->where('servicios.id', '!=', 8)
        ->where('servicios.operar', 1)
        ->whereIn('detalle_reserva_incluyes.itinerario_reserva_id', $itinerarioIds)
        ->groupBy('servicios.id','detalle_reserva_incluyes.itinerario_reserva_id','servicios.titulo','detalle_reserva_incluyes.operar','servicios.proveedor_id','detalle_reservas.fecha_viaje')
        ->get();
        // $serviciosIncluidos = $this->reserva->operarServicios;
        $detalles =[];
        foreach($serviciosIncluidos as $i => $detalle)
        {
            $opera = Operar::where('reserva_id',$this->reserva->id)->where('servicio_id',$detalle->id)->first();
            $operar = OperarServicio::where('operar_id',$opera?->id)->first();
            if($operar){
                $detalles[] = [
                    'id' => $detalle->id,
                    'itinerarioId' => $detalle->itinerario_reserva_id,
                    'titulo' => $detalle->titulo,
                    'operar' => $detalle->operar,
                    'operarServicioId' => $operar->id,
                    'operarId' => $operar->operar->id,
                    'fecha_viaje' => $detalle->fecha_viaje,
                    'pax' => $detalle->sum_pax,
                ];
                $this->codigo[$i] = $operar->recojo;
                $this->observacion[$i] = $operar->observacion;
                $this->precio[$i] = $operar->precio;
                $this->moneda[$i] = $operar->moneda_id;
                $this->imagenver[$i] = $operar->imagen;
                $this->imagen[$i] = null;
                $this->proveedorId[$i] = $operar->proveedor_id;
            }else{
                $detalles[] = [
                    'id' => $detalle->id,
                    'itinerarioId' => $detalle->itinerario_reserva_id,
                    'titulo' => $detalle->titulo,
                    'operar' => $detalle->operar,
                    'operarServicioId' => null,
                    'operarId' => null,
                    'fecha_viaje' => $detalle->fecha_viaje,
                    'pax' => $detalle->sum_pax,
                ];
                $this->codigo[$i] = null;
                $this->observacion[$i] = null;
                $this->precio[$i] = 0;
                $this->moneda[$i] = 2;
                $this->imagenver[$i] = null;
                $this->imagen[$i] = null;
                $this->proveedorId[$i] = $detalle->proveedor_id;
            }
        }
        $this->detalles = $detalles;
    }

    public function cambiarTipoMoneda($i)
    {
        $this->moneda[$i] = $this->moneda[$i] == 1 ? 2:1;
    }

    public function guardarIngreso($i)
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $this->validate([
                'codigo.'.$i => 'required',
                'observacion.'.$i => 'required',
                'precio.'.$i => 'required',
            ]);

            if($this->detalles[$i]['operarId']){
                $operar = Operar::find($this->detalles[$i]['operarId']);
            }else{
                $operar = new Operar();
                $operar->cantidad_pax = $this->detalles[$i]['pax'];
                $operar->fecha = $this->detalles[$i]['fecha_viaje'];
                $operar->user_id = \Auth::id();
                $operar->reserva_id = $this->reserva->id;
                $operar->servicio_id = $this->detalles[$i]['id'];
                $operar->operado = 0;
                $operar->otros = 0;
                $operar->estado = 1;
            }
            if($this->moneda[$i] == 2){
                $operar->precioDolares = $this->precio[$i];
                $operar->precioSoles = 0;
            }else{
                $operar->precioDolares = 0;
                $operar->precioSoles = $this->precio[$i];
            }                
            $operar->save();

            if($this->detalles[$i]['operarServicioId']){
                $operarservicio = OperarServicio::find($this->detalles[$i]['operarServicioId']);
            }else{
                $operarservicio = new OperarServicio();
                $operarservicio->operar_id = $operar->id;
                $operarservicio->servicio_id = $this->detalles[$i]['id'];
            }

            $operarservicio->proveedor_id = $this->proveedorId[$i];
            $operarservicio->precio = $this->precio[$i];
            $operarservicio->observacion = $this->observacion[$i] ?? null;
            $operarservicio->cantidad = $this->detalles[$i]['pax'];
            $operarservicio->moneda_id = $this->moneda[$i];
            $operarservicio->codigo  = $this->codigo[$i];
            $operarservicio->save();

            if($this->imagen[$i]){
                $nombreimg=$operarservicio->id.'.'.$this->imagen[$i]->getClientOriginalExtension();
                $ruta=$this->imagen[$i]->storeAs('img/tickets',$nombreimg);
            }else{
                $nombreimg='';
            }

            $operarservicio->imagen = $nombreimg;
            $operarservicio->save();

            DB::table('detalle_reserva_incluyes')
                ->where('itinerario_reserva_id', $this->detalles[$i]['itinerarioId'])
                ->where('servicio_incluido_id', $this->detalles[$i]['id'])
                ->update(['operar' => 1]);

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
        $this->mount($this->reserva->id);
        return redirect()->back()->with('success', 'Agregado exitosamente.');
    }

    public function render()
    {
        return view('livewire.agregar-ingresos');
    }

    public function plantillaMinisterio()
    {
        return Excel::download(new MinisterioExport($this->reserva), 'ministerio.xlsx');
    }

    public function plantillaIncaRail()
    {
        return Excel::download(new IncaRailExport($this->reserva), 'inca-rail.xlsx');
    }

    public function plantillaPeruRail()
    {
        return Excel::download(new PeruRailExport($this->reserva), 'peru-rail.xlsx');
    }
}
