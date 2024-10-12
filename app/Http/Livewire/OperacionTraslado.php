<?php

namespace App\Http\Livewire;

use App\Models\DetalleReserva;
use App\Models\Operar;
use App\Models\OperarDetalleReserva;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use App\Models\Ubicacion;
use Livewire\Component;
use DB;
use Carbon\Carbon;

class OperacionTraslado extends Component
{
    public $fecha;
    public $ciudadId;
    public $ciudades;
    public $servicios;

    public $proveedorId;
    public $proveedores;
    public $monedaId;
    public $precioDetalle;
    public $recojo;
    public $observaciones;
    public $totalPax;

    public $editar =0;
    public $operacion;

    public $hotelId;
    public $nuevoHotel;
    public $hotelNuevo = 0;
    public $todosHotel = 0;
    public $todosHotelLima = 0;
    public $direccionHotel;
    public $celularHotel;
    public $detalleHotel;
    public $proveedoresHoteles;

    protected $listeners = ['actualizarOrdenServicios' => 'actualizarOrdenServicios'];

    public function actualizarOrdenServicios($ordenElementos)
    {
        // Crea una copia de los arrays originales para preservar los valores actuales
        $serviciosreserva = $this->servicios;
        $proveedorId = $this->proveedorId;
        $monedaId = $this->monedaId;
        $precioDetalle = $this->precioDetalle;
        $recojo = $this->recojo;
        $observaciones = $this->observaciones;

        // Recorre el array de índices reordenados
        foreach ($ordenElementos as $i => $indiceViejo) {
            // Usa el índice nuevo para actualizar los valores correspondientes en tus arrays de datos
            $this->servicios[$i] = $serviciosreserva[$indiceViejo] ?? null;
            $this->proveedorId[$i] = $proveedorId[$indiceViejo] ?? null;
            $this->monedaId[$i] = $monedaId[$indiceViejo] ?? null;
            $this->precioDetalle[$i] = $precioDetalle[$indiceViejo] ?? null;
            $this->recojo[$i] = $recojo[$indiceViejo] ?? null;
            $this->observaciones[$i] = $observaciones[$indiceViejo] ?? null;
            $this->emit("select2",$i);
        }
    }

    public function mount(Operar $operacion = null, $editar = 0)
    {
        if($editar == 1){
            $this->editar = 1;
            $this->operacion = $operacion;
            foreach($operacion->operarServicios as $i => $servicio){
                $this->servicios[] = [
                    'id' => $servicio->detalle_reserva_id,
                    'servicio_id' => $servicio->servicio_id,
                    'servicio' => $servicio->servicio?->titulo,
                    'pax' => $servicio->cantidad,
                    'nombreApellido' => $servicio->detalleReserva?->reserva?->pasajeroprincipal()->nombreCompleto,
                    'hotel' => $servicio->detalleReserva?->hotel?->nombre.' '.$servicio->detalleReserva?->hotel?->direccion,
                    'comentarios' => $servicio->detalleReserva?->comentarios,
                    'tipo' => $servicio->tipo,
                    'itinerario' => $servicio->tipo,
                ];
                $this->monedaId[$i] = $servicio->moneda_id;
                $this->proveedorId[$i] = $servicio->proveedor_id;
                $this->precioDetalle[$i] = $servicio->precio;
                $this->recojo[$i] = $servicio->recojo;
                $this->observaciones[$i] = $servicio->observacion;
            }
        }
        if($this->fecha){
            $this->buscarOperaciones(0);
        }
        $this->ciudades = Ubicacion::all();
        $this->proveedores = Proveedor::where('categoria_id',13)->get();
        $this->proveedoresHoteles = Proveedor::select('id','nombre')->whereRelation('categoria','categoria_id',2)->get();
    }

    public function agregarHotel($id)
    {
        $this->detalleHotel = DetalleReserva::find($id);
        $this->hotelId = $this->detalleHotel ? $this->detalleHotel->proveedor_id : null;
        $this->nuevoHotel='';
        $this->hotelNuevo=0;
        $this->todosHotel=0;
        $this->todosHotelLima=0;
        $this->direccionHotel=$this->detalleHotel->hotel ? $this->detalleHotel->hotel?->direccion : null;
        $this->celularHotel=$this->detalleHotel->hotel ? $this->detalleHotel->hotel?->celular : null;
        $this->emit('modalHotel',$this->detalleHotel->proveedor_id); 
    }

    public function cambiarhotelNuevo()
    {
        $this->hotelNuevo = $this->hotelNuevo == 0 ? 1 : 0;
    }

    public function updatedhotelId($id)
    {
        $proveedor = Proveedor::find($id);
        if($proveedor){
            $this->direccionHotel = $proveedor->direccion;
            $this->celularHotel = $proveedor->celular;
        }
    }

    public function guardarHotel()
    {
        $this->validate([
            'hotelId' => $this->hotelNuevo == 0 ? 'required' : 'nullable',
            'nuevoHotel' => $this->hotelNuevo == 1 ? 'required' : 'nullable',
        ]);

        if($this->hotelNuevo == 0){
            $proveedor = Proveedor::find($this->hotelId);
        }else{
            $proveedor = new Proveedor();
            $proveedor->nombre = $this->nuevoHotel;
            $proveedor->categoria_id = 8;
        }
        $proveedor->direccion = $this->direccionHotel;
        $proveedor->celular = $this->celularHotel;
        $proveedor->save();

        if($this->todosHotel == 1 || $this->todosHotelLima == 1){
            if($this->todosHotel == 1){
                $reserva = $this->detalleHotel->reserva;
                foreach($reserva->detallestours as $detalle){
                    if($detalle->servicio->ubicacion_id == 1){
                        $detalle->proveedor_id = $proveedor->id;
                        $detalle->save();
                    }
                }
            }
            if($this->todosHotelLima == 1){
                $reserva = $this->detalleHotel->reserva;
                foreach($reserva->detallestours as $detalle){
                    if($detalle->servicio->ubicacion_id == 2){
                        $detalle->proveedor_id = $proveedor->id;
                        $detalle->save();
                    }
                }
            }
        }else{
            $this->detalleHotel->proveedor_id = $proveedor->id;
            $this->detalleHotel->save();
        }
        $this->emit('cerrarModalHotel'); 
        $this->mount();
    }

    public function buscarOperaciones($i)
    {
        $this->servicios =[];
        if($i == 1){
            $this->monedaId = [];
            $this->proveedorId = [];
            $this->precioDetalle = [];
            $this->recojo = [];
            $this->observaciones = [];
        }
        $this->validate([
            'fecha' => 'required',
        ]);
        $servicios = DetalleReserva::whereRelation('servicio','categoria_id',6)->where('operado',0)
        ->whereDate('fecha_viaje',$this->fecha)->whereRelation('reserva','confirmado',1)
        ->when($this->ciudadId,function($query, $ciudadId){
            return $query->whereRelation('servicio','ubicacion_id',$ciudadId);
        })->get();
        $j = 0;
        foreach($servicios as $i => $servicio){
            $this->servicios[] = [
                'id' => $servicio->id,
                'servicio_id' => $servicio->servicio_id,
                'servicio' => $servicio->servicio?->titulo,
                'pax' => $servicio->pax,
                'nombreApellido' => $servicio->reserva?->pasajeroprincipal()?->nombreCompleto,
                'hotel' => $servicio->hotel?->nombre.' '.$servicio->hotel?->direccion,
                'comentarios' => $servicio->comentarios,
                'itinerario' => 0,
            ];
            $this->monedaId[$j] = 2;
            $this->precioDetalle[$j] = 0;
            $this->emit("select2",$j);
            $j++;
        }
        $detalles = DetalleReserva::whereRelation('servicio', 'categoria_id', 5)
        ->whereDate('fecha_viaje', $this->fecha)
        ->whereRelation('reserva', 'confirmado', 1)
        ->whereHas('itinerarios', function($query) {
            $query->whereExists(function($subquery) {
                // Aquí realizamos un join directo con la tabla pivot
                $subquery->select(DB::raw(1))
                         ->from('detalle_reserva_incluyes') // Nombre de la tabla pivot
                         ->join('servicios', 'detalle_reserva_incluyes.servicio_incluido_id', '=', 'servicios.id') // Relación con la tabla de servicios
                         ->where('servicios.categoria_id', 6) // Filtro por la categoría 6
                         ->whereColumn('detalle_reserva_incluyes.itinerario_reserva_id', 'itinerario_reservas.id') // Relacionamos con itinerarios
                         ->where('detalle_reserva_incluyes.operar', 0); // Filtro de operado = 0
            });
        })
        ->get();
        foreach($detalles as $i => $servicio){
            $itinerarios = DB::table('itinerario_reservas')
            ->where('itinerario_reservas.detalle_reserva_id', $servicio->id)
            ->get();
            foreach($itinerarios as $itinerario){
                $serviciosIncluidos = DB::table('detalle_reserva_incluyes')
                ->join('servicios', 'detalle_reserva_incluyes.servicio_incluido_id', '=', 'servicios.id')
                ->where('servicios.categoria_id', 6)
                ->where('detalle_reserva_incluyes.itinerario_reserva_id', $itinerario->id)
                ->where('detalle_reserva_incluyes.operar', 0)
                ->get();

                foreach($serviciosIncluidos as $serviciosIncluido){
                    $this->servicios[] = [
                        'id' => $servicio->id,
                        'servicio_id' => $serviciosIncluido->id,
                        'servicio' => $serviciosIncluido->titulo,
                        'pax' => $servicio->pax,
                        'nombreApellido' => $servicio->reserva?->pasajeroprincipal()?->nombreCompleto,
                        'hotel' => $servicio->hotel?->nombre.' '.$servicio->hotel?->direccion,
                        'comentarios' => $servicio->comentarios,
                        'itinerario' => 1,
                    ];
                    $this->monedaId[$j] = 2;
                    $this->precioDetalle[$j] = 0;
                    $this->emit("select2",$j);
                    $j++;
                }
            }
        }
        $this->totalPax = $servicios->sum('pax');
    }

    public function cambiarTipoMoneda($i)
    {
        $this->monedaId[$i] = $this->monedaId[$i] == 1 ? 2:1;
    }

    public function register()
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $this->validate([
                'proveedorId.*' => 'required',
                'precioDetalle.*' => 'required',
                'recojo.*' => 'required',
                'observaciones.*' => 'nullable',
            ]);

            $totalSoles = 0;
            $totalDolares = 0;
            foreach($this->servicios as $i => $servicio){
                if($this->precioDetalle[$i] > 0)
                {
                    if($this->monedaId[$i] == 2){
                        $totalDolares += $this->precioDetalle[$i];
                    }
                    if($this->monedaId[$i] == 1){
                        $totalSoles += $this->precioDetalle[$i];
                    }
                }
            }

            if($this->editar == 1){
                $operar = Operar::find($this->operacion->id);
            }else{
                $operar = new Operar();
                $operar->cantidad_pax = $this->totalPax;
                $operar->fecha = $this->fecha;
                $operar->user_id = \Auth::id();
                $operar->operado = 0;
                $operar->traslado = 1;
                $operar->estado = 1;
            }
            $operar->precioSoles = $totalSoles;
            $operar->precioDolares = $totalDolares;
            $operar->save();

            $operar->operarServicios()->delete();

            foreach($this->servicios as $i => $servicio)
            {
                if($this->precioDetalle[$i] > 0){
                    $operarservicio = OperarServicio::create([
                        'operar_id' => $operar->id,
                        'servicio_id' => $servicio['servicio_id'],
                        'proveedor_id' => $this->proveedorId[$i],
                        'precio' => $this->precioDetalle[$i],
                        'observacion' => $this->observaciones[$i] ?? null,
                        'cantidad' => $servicio['pax'],
                        'moneda_id' => $this->monedaId[$i],
                        'detalle_reserva_id' => $servicio['id'],
                        'recojo'  => $this->recojo[$i],
                        'tipo'  => $servicio['itinerario'] ?? 0,
                    ]);
    
                    if($servicio['itinerario'] == 1){
                        $serv = DetalleReserva::find($servicio['id']);
                        foreach($serv->itinerarios as $itinerario){
                            foreach($itinerario->incluyes as $incluye){
                                if($incluye->id == $servicio['servicio_id']){
                                    DB::table('detalle_reserva_incluyes')
                                    ->where('itinerario_reserva_id', $itinerario->id)
                                    ->where('servicio_incluido_id', $incluye->id)
                                    ->update(['operar' => 1]);
                                }
                            }
                        }
                    }
                    if($servicio['itinerario'] == 0){
                        $serv = DetalleReserva::find($servicio['id']);
                        $serv->operado = 1;
                        $serv->save();
                    }
                    
                }
            }
    
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->route('operacion.traslados')->with('success', 'Operacion creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.operacion-traslado');
    }
}
