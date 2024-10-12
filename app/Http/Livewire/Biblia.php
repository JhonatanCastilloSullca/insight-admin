<?php

namespace App\Http\Livewire;

use App\Exports\BibliaExport;
use Livewire\Component;
use App\Models\DetalleReserva;
use App\Models\Medio;
use App\Models\Servicio;
use App\Models\Operar;
use App\Models\OperarServicio;
use App\Models\OperarPasajero;
use App\Models\OperarDetalleReserva;
use App\Models\Notificacion;
use App\Models\Pago;
use App\Models\Proveedor;
use App\Models\Reserva;
use App\Models\Total;
use Carbon\Carbon;

use DB;
use Maatwebsite\Excel\Facades\Excel;

class Biblia extends Component
{
    public $detallesReserva;
    public $fecha_inicio;
    public $fecha_fin;
    public $servicios;
    public $detalle;
    public $servicioFilter;

    public $hotelId;
    public $searchText;
    public $hotelNuevo = 0;
    public $nuevoHotel;
    public $direccionHotel;
    public $celularHotel;
    public $proveedores;
    public $todosHotel = 0;
    public $todosHotelLima = 0;

    public $reservaIdPago;
    public $monedaIdPago;
    public $montoPago;
    public $montoPorcentajePago;
    public $medioIdPago;
    public $num_operacionPago;
    public $comentarioPago;
    public $existSaldo = 0;

    public $reservas;
    
    public $detallesReservaOperar;
    public $selectAll = false;
    public $selected = [];
    public $primerCategoriaServicio;

    public $servicioOperar;
    public $fechaOperar;

    public $incluyes;

    public $idProveedor = [];
    public $ProveedorEndose = [];
    public $precioServicio = [];
    public $precioEndose;
    public $observacionEndose;

    //PASAJEROS
    public $ingresos;
    public $horarios;
    public $observaciones;

    public $pax = 0;
    public $sumaingresos = 0;
    public $concatobservaciones;

    public $endose = 0;
    public $pagado;

    public $VueloOperar;
    public $HorarioOperar;
    
    public $recojoEndose;
    public $comentarioDetalle;
    public $pagosContabilidad = [];

    public function mount()
    {
        $mytime = Carbon::now('America/Lima');
        $this->fecha_inicio = $this->fecha_inicio ? $this->fecha_inicio : $mytime->toDateString();
        $this->fecha_fin = $this->fecha_fin ? $this->fecha_fin : $mytime->addDays(2)->toDateString();

        $this->servicios = Servicio::whereIn('categoria_id', [5,6])->orderBy('titulo','asc')->get();
        $this->ProveedorEndose = Proveedor::where('categoria_id', '11')->get();
        $this->proveedores = Proveedor::select('id','nombre')->whereRelation('categoria','categoria_id',2)->get();

        $this->detallesReserva = DetalleReserva::whereBetween('fecha_viaje', [$this->fecha_inicio, $this->fecha_fin])
        ->whereRelation('reserva','confirmado',1)->leftJoin('servicios', 'detalle_reservas.servicio_id', '=', 'servicios.id') // Unir la tabla de servicios
        ->when($this->servicioFilter, function($query, $servicioFilter) {
            return $query->where('servicios.id', $servicioFilter);
        })
        ->when($this->searchText, function($query, $searchText) {
            return $query->whereHas('reserva.pasajeros',function($query) use ($searchText){
                return $query->whereRaw("UPPER(REPLACE(CONCAT(nombres, ' ', apellidoPaterno, ' ', apellidoMaterno), '  ', ' ')) LIKE ?", ["%$searchText%"]);
            });
        })->when($this->pagado, function($query, $pagado) {
            if($pagado == 2){
                $pagado = 0;
            }
            return $query->whereRelation('reserva','pagado', $pagado);
        })->whereIn('servicios.categoria_id',[5,6])
        ->orderBy('fecha_viaje', 'asc')
        ->orderBy('servicios.titulo', 'asc')
        ->select('detalle_reservas.*')
        ->get();
    }

    public function agregarHotel($id)
    {
        $this->detalle = DetalleReserva::find($id);
        $this->hotelId = $this->detalle ? $this->detalle->proveedor_id : null;
        $this->nuevoHotel='';
        $this->hotelNuevo=0;
        $this->todosHotel=0;
        $this->todosHotelLima=0;
        $this->direccionHotel=$this->detalle?->hotel?->direccion;
        $this->celularHotel=$this->detalle?->hotel?->celular;
        $this->emit('modalHotel',$this->detalle->proveedor_id); 
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
                $reserva = $this->detalle->reserva;
                foreach($reserva->detallestours as $detalle){
                    if($detalle->servicio->ubicacion_id == 1){
                        $detalle->proveedor_id = $proveedor->id;
                        $detalle->save();
                    }
                    
                }
            }
            if($this->todosHotelLima == 1){
                $reserva = $this->detalle->reserva;
                foreach($reserva->detallestours as $detalle){
                    if($detalle->servicio->ubicacion_id == 2){
                        $detalle->proveedor_id = $proveedor->id;
                        $detalle->save();
                    }
                }
            }
        }else{
            $this->detalle->proveedor_id = $proveedor->id;
            $this->detalle->save();
        }
        $this->emit('cerrarModalHotel'); 
        $this->mount();
    }

    public function agregarComentario($id)
    {
        $this->detalle = DetalleReserva::find($id);
        $this->comentarioDetalle = $this->detalle->comentarios;
        $this->emit('modalComentario'); 
    }

    public function guardarComentario()
    {
        $this->detalle->comentarios = $this->comentarioDetalle;
        $this->detalle->save();
        $this->emit('cerrarModalCometario'); 
        $this->mount();
    }

    public function contabilidad($detalleId,$contabilidad)
    {
        if($contabilidad == 0)
        {
            $detalle = DetalleReserva::find($detalleId);
            $this->pagosContabilidad = $detalle->reserva->pagos;
            $this->emit('modalContabilidad');
        }
    }

    public function contabilizarpago(Pago $pago)
    {
        $pago->contabilidad = 1;
        $pago->save();

        $reserva = $pago->reserva;
        $aux = 1;
        foreach($reserva->pagos as $pago){
            if($pago->contabilidad == 0){
                $aux = 0;
            }
        }

        if($aux == 1 && $reserva->pagado == 1){
            $reserva->contabilidad = 1;
            $reserva->save();
        }
        $this->emit('cerrarModalContabilidad');
        $this->mount();
    }

    public function agregarPago($id,$monedaId)
    {
        $detalle = DetalleReserva::find($id);
        $this->reservaIdPago = $detalle->reserva_id;
        $total = Total::where('saldo','>','0')->where('reserva_id',$this->reservaIdPago)->where('moneda_id',$monedaId)->first();
        if($total){
            $this->existSaldo = 1;

            $data=Medio::select('id','nombre as text')->where('moneda_id',$monedaId)->where('estado',1)->get();
            $data = $data->toArray();
            array_unshift($data, ['id' => '', 'text' => 'Seleccione']);

            $this->montoPago = $total->saldo;
            $this->montoPorcentajePago = $total->saldo;
            $this->monedaIdPago = $monedaId;
            $this->medioIdPago = '';
            $this->num_operacionPago = '';
            $this->comentarioPago = '';

            $this->emit('modalPago',null,$data); 
        }else{
            $this->existSaldo = 0;
        }
    }

    public function guardarPago()
    {
        try
        {
            DB::beginTransaction();
            $total = Total::where('saldo','>','0')->where('reserva_id',$this->reservaIdPago)->where('moneda_id',$this->monedaIdPago)->first();
            $this->validate([
                'montoPago' => 'required|numeric|min:1|max:'.$total?->saldo,
                'medioIdPago' => 'required|exists:medios,id',
                'num_operacionPago' => 'nullable|max:100',
                'comentarioPago' => 'nullable',
            ]);
            $mytime= Carbon::now('America/Lima');
            $medio = Medio::find($this->medioIdPago);
            $monto_porcentaje = ($medio->porcentaje * $this->montoPago)/100;
            $pagoContabilidad = \Auth::user()->roles[0]->name == 'Administrador' ? 1 : 0;
            $pagar = Pago::create([
                'user_id' => \Auth::user()->id,
                'moneda_id' => $this->monedaIdPago,
                'medio_id' => $this->medioIdPago,
                'reserva_id' => $this->reservaIdPago,
                'fecha' => $mytime->toDateTimeString(),
                'monto' => $this->montoPago,
                'monto_porcentaje' =>  $this->montoPorcentajePago,
                'num_operacion' => $this->num_operacionPago,
                'comentarios' => $this->comentarioPago,
                'contabilidad' => $pagoContabilidad,
            ]);
            $total->saldo = $total->saldo - $this->montoPago;
            $total->acuenta = $total->acuenta + $this->montoPago;
            $total->save();
            $reserva = Reserva::find($this->reservaIdPago);
            if ($reserva->saldoCero) {
                $reserva->update(['pagado' => 1]);
            } else {
                $reserva->update(['pagado' => 0]);
            }
            $aux = 1;
            foreach($reserva->pagos as $pago){
                if($pago->contabilidad == 0){
                    $aux = 0;
                }
            }

            if($aux == 1 && $reserva->pagado == 1){
                $reserva->contabilidad = 1;
                $reserva->save();
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        $this->emit('cerrarModalPago'); 
        $this->mount();
    }

    public function overview()
    {
        $this->mount();
    }

    public function excelBiblia()
    {
        $detalles = $this->detallesReserva;
        $detalles = $detalles->sortBy(function($detallereserva) {
            // Ordenar por fecha de viaje y luego por hora de recojo
            return sprintf('%s %s', 
                $detallereserva->fecha_viaje, 
                $detallereserva->detallesoperar->recojo ?? $detallereserva->operarServicio->recojo ?? '00:00:00'
            );
        })->values(); 
        return Excel::download(new BibliaExport($detalles), 'biblia.xlsx');
    }

    public function render()
    {
        return view('livewire.biblia');
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selected = $this->detallesReserva->pluck('id')->toArray();
        } else {
            $this->selected = [];
        }
    }
    public function OperarBiblia()
    {
        $this->detallesReservaOperar = DetalleReserva::whereIn('id', $this->selected)->get();
        $resultado = null;
        $primerServicioId = null;
        $primerFechaViaje = null;
        $this->primerCategoriaServicio = null;
        if ($this->detallesReservaOperar->isNotEmpty()) {
            $primerDetalle = $this->detallesReservaOperar->first();
            $primerServicioId = $primerDetalle->servicio_id;
            $this->primerCategoriaServicio = $primerDetalle->servicio->categoria_id;
            $primerFechaViaje = $primerDetalle->fecha_viaje;
            $resultado = $this->detallesReservaOperar->every(function ($detalle) use ($primerServicioId, $primerFechaViaje) {
                if ($detalle->fecha_viaje == null || $primerFechaViaje == null) {
                    return false;
                }
                return $detalle->servicio_id == $primerServicioId && $detalle->fecha_viaje == $primerFechaViaje;
            })
                ? 1
                : 2;
            $this->servicioOperar = Servicio::find($primerServicioId);
            $this->fechaOperar = $primerFechaViaje;
            $this->incluyes = $this->servicioOperar->incluyes->where('categoria_id', '!=', 11);
        }

        if ($resultado == 1) {
            if ($this->primerCategoriaServicio == 1) {
                foreach ($this->incluyes as $incluye) {
                    $id = $incluye->id;
                    $data = $incluye->categoria->proveedoresSelect;
                    $this->emit('llenarSelect', $id, $data);
                }
                $this->emit('openModalTours');
            } elseif ($this->primerCategoriaServicio == 2) {
                $this->emit('openModalHotel');
            } elseif ($this->primerCategoriaServicio == 3) {
                $this->emit('openModalVuelo');
            } else {
                dd($this->primerCategoriaServicio);
            }
            $this->pax = DetalleReserva::whereIn('id', $this->selected)->sum('pax');
        } else {
            return redirect()->route('biblia.biblia')->with('success', 'Servicios y Fechas no coordinadas');
        }
    }
    public function EndosarBiblia()
    {
        $this->detallesReservaOperar = DetalleReserva::whereIn('id', $this->selected)->get();
        $resultado = null;
        $primerServicioId = null;
        $primerFechaViaje = null;
        $this->primerCategoriaServicio = null;
        if ($this->detallesReservaOperar->isNotEmpty()) {
            $primerDetalle = $this->detallesReservaOperar->first();
            $primerServicioId = $primerDetalle->servicio_id;
            $this->primerCategoriaServicio = $primerDetalle->servicio->categoria_id;
            $primerFechaViaje = $primerDetalle->fecha_viaje;
            $resultado = $this->detallesReservaOperar->every(function ($detalle) use ($primerServicioId, $primerFechaViaje) {
                if ($detalle->fecha_viaje == null || $primerFechaViaje == null) {
                    return false;
                }
                return $detalle->servicio_id == $primerServicioId && $detalle->fecha_viaje == $primerFechaViaje;
            })
                ? 1
                : 2;
            $this->servicioOperar = Servicio::find($primerServicioId);
            $this->fechaOperar = $primerFechaViaje;
            $this->incluyes = $this->servicioOperar->incluyes->where('categoria_id', '!=', 11);
        }
        if ($resultado == 1) {
            if ($this->primerCategoriaServicio == 1) {
                $this->emit('openModalEndoseTour');
            } else {
                return redirect()->route('biblia.biblia')->with('success', 'Solo puedes endosar Tours');
            }
            $this->pax = DetalleReserva::whereIn('id', $this->selected)->sum('pax');
        } else {
            return redirect()->route('biblia.biblia')->with('success', 'Servicios y Fechas no coordinadas');
        }
    }
    public function EndoseOperar()
    {
        $this->endose = 0;

        $operar = new Operar();
        $operar->fecha = $this->fechaOperar;
        $operar->cantidad_pax = $this->pax;
        $operar->observacion = '';
        $operar->precio = $this->sumaingresos;
        $operar->servicio_id = $this->servicioOperar->id;
        $operar->user_id = \Auth::id();
        $operar->estado = '1';
        $operar->operado = $this->endose;
        $operar->save();

        try {
            DB::beginTransaction();

            OperarServicio::create([
                'operar_id' => $operar->id,
                'servicio_id' => $this->servicioOperar->id,
                'proveedor_id' => $this->idProveedor,
                'precio' => $this->precioEndose,
                'observacion' => $this->observacionEndose,
                'tipo' => '0',
            ]);
            Notificacion::create([
                'notificacion' => 'Operacion Endose Servicio' . ' ' . $this->servicioOperar->id,
                'user_id' => \Auth::user()->id,
                'estado' => '0',
                'tipo' => '1', //Categoria Tours
            ]);

            foreach ($this->detallesReservaOperar as $i => $detalle) {
                OperarDetalleReserva::create([
                    'operar_id' =>  $operar->id,
                    'detalle_reserva_id'   =>  $detalle->id,
                    'recojo'    => $this->recojoEndose,
                ]);
                $detalle->update([
                    'operado' => '1',
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('biblia.biblia')->with('success', 'Operacion Guardada Correctamente.');
    }

    public function OperarDetalles()
    {
        $operar = new Operar();
        $operar->fecha = $this->fechaOperar;
        $operar->cantidad_pax = $this->pax;
        $operar->observacion = '';
        $operar->precio = $this->sumaingresos;
        $operar->servicio_id = $this->servicioOperar->id;
        $operar->user_id = \Auth::id();
        $operar->estado = '1';
        $operar->operado = $this->endose;
        $operar->save();

        try {
            DB::beginTransaction();
            foreach ($this->incluyes as $inc) {
                OperarServicio::create([
                    'operar_id' => $operar->id,
                    'servicio_id' => $inc->id,
                    'proveedor_id' => $this->idProveedor[$inc->id],
                    'precio' => $this->precioServicio[$inc->id],
                    'observacion' => '',
                    'tipo' => '1',
                ]);
                Notificacion::create([
                    'notificacion' => 'Operacion Servicio' . ' ' . $inc->titulo,
                    'user_id' => \Auth::user()->id,
                    'estado' => '0',
                    'tipo' => $inc->categoria_id,
                ]);
            }
            foreach ($this->detallesReservaOperar as $k => $detalle) {
                OperarDetalleReserva::create([
                    'operar_id' => $operar->id,
                    'detalle_reserva_id' => $detalle->id,
                    'recojo' => $this->horarios[$k],
                    'ingresos'    => $this->ingresos[$k],
                ]);
                $detalle->update([
                    'operado' => '1',
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('biblia.biblia')->with('success', 'Operacion Guardada Correctamente.');
    }
    public function OperarDetallesHotel()
    {
        try {
            DB::beginTransaction();
            $operar = new Operar();
            $operar->fecha = $this->fechaOperar;
            $operar->cantidad_pax = $this->pax;
            $operar->observacion = 'Reserva de Hotel' . $this->servicioOperar->id;
            $operar->precio = $this->sumaingresos;
            $operar->servicio_id = $this->servicioOperar->id;
            $operar->user_id = \Auth::id();
            $operar->estado = '1';
            $operar->operado = $this->endose;
            $operar->save();
            OperarServicio::create([
                'operar_id' => $operar->id,
                'servicio_id' => $this->servicioOperar->id,
                'proveedor_id' => $this->idProveedor[$this->servicioOperar->id],
                'precio' => $this->sumaingresos,
                'observacion' => '',
                'tipo' => '1',
            ]);
            foreach ($this->detallesReservaOperar as $k => $detalle) {
                OperarDetalleReserva::create([
                    'operar_id' => $operar->id,
                    'detalle_reserva_id' => $detalle->id,
                ]);
                $detalle->update([
                    'operado' => '1',
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('biblia.biblia')->with('success', 'Operacion Hotel Guardada Correctamente.');
    }
    public function OperarDetallesVuelo()
    {
        try {
            DB::beginTransaction();
            $operar = new Operar();
            $operar->fecha = $this->fechaOperar;
            $operar->cantidad_pax = $this->pax;
            $operar->observacion = 'Reserva de Vuelo' . $this->servicioOperar->id;
            $operar->precio = $this->sumaingresos;
            $operar->servicio_id = $this->servicioOperar->id;
            $operar->user_id = \Auth::id();
            $operar->estado = '1';
            $operar->operado = $this->endose;
            $operar->save();
            OperarServicio::create([
                'operar_id' => $operar->id,
                'servicio_id' => $this->servicioOperar->id,
                'precio' => $this->sumaingresos,
                'observacion' => '',
                'tipo' => '1',
            ]);
            foreach ($this->detallesReservaOperar as $k => $detalle) {
                OperarDetalleReserva::create([
                    'operar_id' => $operar->id,
                    'detalle_reserva_id' => $detalle->id,
                    'recojo' => $this->HorarioOperar,
                ]);
                $detalle->update([
                    'operado' => '1',
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('biblia.biblia')->with('success', 'Operacion Vuelo Guardada Correctamente.');
    }

    public function updatedIngresos()
    {
        $this->sumaingresos = 0;
        foreach ($this->ingresos as $ingreso) {
            $this->sumaingresos += $ingreso;
        }
    }
    public function updatedObservaciones()
    {
        $this->concatobservaciones = '';
        foreach ($this->observaciones as $observacion) {
            $this->concatobservaciones = $this->concatobservaciones . '/' . $observacion;
        }
    }
    public function remove($i)
    {
        $this->pax -= $this->detallesReservaOperar[$i]->pax;
        unset($this->ingresos[$i]);
        unset($this->observaciones[$i]);
        unset($this->detallesReservaOperar[$i]);
        $this->ingresos = array_values($this->ingresos);
        $this->observaciones = array_values($this->observaciones);
        $this->detallesReservaOperar = $this->detallesReservaOperar->values();
        $this->updatedIngresos();
        $this->updatedObservaciones();
    }
    public function buscarDetalles()
    {
        $this->servicioFilter = $this->servicioFilter == '' ? null : $this->servicioFilter;
        $this->searchText = $this->searchText == '' ? null : $this->searchText;
        $this->detallesReserva = DetalleReserva::whereBetween('fecha_viaje', [$this->fecha_inicio, $this->fecha_fin])
        ->whereRelation('reserva','confirmado',1)->leftJoin('servicios', 'detalle_reservas.servicio_id', '=', 'servicios.id') // Unir la tabla de servicios
        ->when($this->servicioFilter, function($query, $servicioFilter) {
            return $query->where('servicios.id', $servicioFilter);
        })
        ->when($this->searchText, function($query, $searchText) {
            return $query->whereHas('reserva.pasajeros',function($query) use ($searchText){
                return $query->whereRaw("UPPER(REPLACE(CONCAT(nombres, ' ', apellidoPaterno, ' ', apellidoMaterno), '  ', ' ')) LIKE ?", ["%$searchText%"]);
            });
        })->when($this->pagado, function($query, $pagado) {
            if($pagado == 2){
                $pagado = 0;
            }
            return $query->whereRelation('reserva','pagado', $pagado);
        })->whereIn('servicios.categoria_id',[5,6])
        ->orderBy('fecha_viaje', 'asc')
        ->orderBy('servicios.titulo', 'asc')
        ->select('detalle_reservas.*')
        ->get();
    }
    public function limpiarDetalles()
    {
        $mytime = Carbon::now('America/Lima');
        $this->detallesReserva = DetalleReserva::all();
        $this->fecha_inicio = $mytime->toDateString();
        $this->fecha_fin = $mytime->addDays(2)->toDateString();
        $this->emit('buscarDetalles');
    }
}
