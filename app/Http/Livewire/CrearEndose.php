<?php

namespace App\Http\Livewire;

use App\Models\DetalleReserva;
use App\Models\Operar;
use App\Models\OperarDetalleReserva;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use App\Models\Servicio;
use Livewire\Component;
use DB;
use Carbon\Carbon;

class CrearEndose extends Component
{
    public $agenciaId;
    public $servicioid;
    public $fecha;
    public $observacion;

    public $detalles = [];
    public $paxTotal = 0;
    public $totalIngresos = 0;

    public $ingresos;
    public $horarios;
    public $observaciones;

    public $precio;
    public $monedaPrecio = 2;

    public $agencias;
    public $servicios;

    public $hotelId;
    public $nuevoHotel;
    public $hotelNuevo = 0;
    public $todosHotel = 0;
    public $todosHotelLima = 0;
    public $direccionHotel;
    public $celularHotel;
    public $detalleHotel;

    public $totalSoles = 0;
    public $totalDolares = 0;
    public $precioTipoCambio;
    public $proveedores;

    protected $listeners = ['actualizarOrdenServicios' => 'actualizarOrdenServicios'];

    public function actualizarOrdenServicios($ordenElementos)
    {
        // Crea una copia de los arrays originales para preservar los valores actuales
        $serviciosreserva = $this->detalles;
        $ingresos = $this->ingresos;
        $horarios = $this->horarios;
        $observaciones = $this->observaciones;
        // Recorre el array de índices reordenados
        foreach ($ordenElementos as $i => $indiceViejo) {
            // Usa el índice nuevo para actualizar los valores correspondientes en tus arrays de datos
            $this->detalles[$i] = $serviciosreserva[$indiceViejo] ?? null;
            $this->ingresos[$i] = $ingresos[$indiceViejo] ?? null;
            $this->observaciones[$i] = $observaciones[$indiceViejo] ?? null;
            $this->horarios[$i] = $horarios[$indiceViejo] ?? null;
        }
    }

    public function mount()
    {
        // $this->fecha = date('Y-m-d');
        // $fecha = $this->fecha;
        // $this->servicios = DetalleReserva::join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        // ->join('reservas','reservas.id','=','detalle_reservas.reserva_id')->select('servicios.id','servicios.titulo as text')
        // ->where('servicios.categoria_id',5)->whereDate('detalle_reservas.fecha_viaje',$this->fecha)
        // ->where('detalle_reservas.operado',0)->where('reservas.confirmado',1)
        // ->groupBy('servicios.id','servicios.titulo')->orderBy('servicios.titulo','asc')->get();
        $this->agencias = Proveedor::where('categoria_id',18)->get();
        $this->proveedores = Proveedor::select('id','nombre')->whereRelation('categoria','categoria_id',2)->get();
    }

    public function agregarServicios()
    {
        $data=$this->servicios->toArray();
        array_unshift($data, ['id' => '', 'text' => 'Seleccione']);
        $this->emit('agregarServicios',$this->servicioid,$data);
    }

    public function buscarDetalles()
    {
        $this->paxTotal = 0;
        $this->totalIngresos = 0;
        $this->totalSoles = 0;
        $this->totalDolares = 0;
        $this->detalles = [];
        $this->observaciones = [];
        $this->ingresos = [];
        if($this->servicioid != '' && $this->fecha != '')
        {
            $detalles = DetalleReserva::where('fecha_viaje', $this->fecha)
            ->whereRelation('reserva', 'confirmado', 1)
            ->where('estado', 1)
            ->where('operado', 0)
            ->where(function($query) {
                $query->where('servicio_id', $this->servicioid)
                    ->orWhereRelation('servicio', 'servicio_id', $this->servicioid);
            })
            ->get();
            $this->paxTotal = $detalles->sum('pax');

            foreach($detalles as $i => $detalle)
            {
                if($detalle->moneda_id == 2){
                    $this->totalDolares += $detalle->precio * $detalle->pax;
                }else{
                    $this->totalSoles += $detalle->precio * $detalle->pax;
                }
                $nuevoServicio = [
                    'id' => $detalle->id,
                    'reservaid' => $detalle->reserva->id,
                    'pax' => $detalle->pax,
                    'fecha' => $detalle->fecha_viaje,
                    'precio' => $detalle->precio * $detalle->pax,
                    'moneda' => $detalle->moneda->abreviatura ,
                    'tipo' => $detalle->tipo,
                    'servicio' => $detalle->servicio->titulo,
                    'celular' => $detalle->reserva?->pasajeroprincipal()?->celular,
                    'hotel' => $detalle->hotel?->nombre.' '.$detalle->hotel?->direccion,
                ];
                $this->observaciones[$i] = $detalle->comentarios;
                $this->ingresos[$i] = 0;
                $this->horarios[$i] = null;

                $incluyes=[];
                foreach($detalle->itinerarios as $i => $itinerario)
                {
                    foreach($itinerario->incluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                }

                $pasajeros=[];
                foreach($detalle->reserva->pasajeros as $i => $pasajero)
                {
                    $pasajero = [
                        'nombreCompleto' => $pasajero->nombrePaterno,
                        'cumpleaños' => $pasajero->pasajeroscumpleaño($this->fecha),
                        'edad' => $pasajero->edad,
                        'pais' => $pasajero->pais->nombre,
                    ];
                    $pasajeros[] = $pasajero;
                }

                $nuevoServicio['incluyes'] = $incluyes;
                $nuevoServicio['pasajeros'] = $pasajeros;
                $this->detalles[] = $nuevoServicio;
            }
            $this->precioTipoCambio = (($this->totalDolares * 3.70) + $this->totalSoles ) - (($this->totalDolares * 3.70 * 6) /100);
        }
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
        $this->updatedservicioid(1);
    }

    public function updatedservicioid($id)
    {
        $this->servicios = DetalleReserva::join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        ->join('reservas','reservas.id','=','detalle_reservas.reserva_id')->select('servicios.id','servicios.titulo as text')
        ->where('servicios.categoria_id',5)->whereDate('detalle_reservas.fecha_viaje',$this->fecha)
        ->where('detalle_reservas.operado',0)->where('reservas.confirmado',1)
        ->groupBy('servicios.id','servicios.titulo')->orderBy('servicios.titulo','asc')->get();
        $this->buscarDetalles();
    }

    public function updatedfecha($id)
    {
        $this->servicios = DetalleReserva::join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        ->join('reservas','reservas.id','=','detalle_reservas.reserva_id')->select('servicios.id','servicios.titulo as text')
        ->where('servicios.categoria_id',5)->whereDate('detalle_reservas.fecha_viaje',$this->fecha)
        ->where('detalle_reservas.operado',0)->where('reservas.confirmado',1)
        ->groupBy('servicios.id','servicios.titulo')->orderBy('servicios.titulo','asc')->get();
        $this->buscarDetalles();
        $this->agregarServicios();
    }

    public function updatedingresos($nested, $precio)
    {
        $this->calcularIngresos();
    }

    public function calcularIngresos()
    {
        $total = 0;
        foreach($this->ingresos as $ingreso)
        {
            $total += $ingreso ? $ingreso : 0;
        }
        $this->totalIngresos = $total;
    }

    public function calcularPax()
    {
        $total = 0;
        foreach($this->detalles as $detalle)
        {
            $total += $detalle['pax'];
        }
        $this->paxTotal = $total;
    }

    public function remove($i)
    {
        unset($this->observaciones[$i]);
        unset($this->horarios[$i]);
        unset($this->ingresos[$i]);
        unset($this->detalles[$i]);
        $this->observaciones = array_values($this->observaciones);
        $this->horarios = array_values($this->horarios);
        $this->ingresos = array_values($this->ingresos);
        $this->detalles = array_values($this->detalles);
        $this->calcularIngresos();
        $this->calcularPax();
    }

    public function cambiarTipoMoneda()
    {
        $this->monedaPrecio = $this->monedaPrecio == 1 ? 2:1;
    }

    public function register()
    {
        $this->validate([
            'fecha' => 'required',
            'precio' => 'required|min:1|numeric',
            'agenciaId' => 'required',
            'servicioid' => 'required',
        ]);

        $precioSoles = 0;
        $precioDolares = 0;
        if($this->monedaPrecio == 2){
            $precioDolares= $this->precio * $this->paxTotal;
        }else{
            $precioSoles= $this->precio * $this->paxTotal;
        }
        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $operar = Operar::create([
                'fecha' => $this->fecha,
                'cantidad_pax' => $this->paxTotal,
                'ingresos' => $this->totalIngresos,
                'precioSoles' => $precioSoles,
                'precioDolares' => $precioDolares,
                'servicio_id' => $this->servicioid,
                'user_id' => \Auth::user()->id,
                'estado' => 1,
                'operado' => 1,
                'observacion' => $this->observacion,
                'endose' => 1,
            ]);

            $operarServicio = OperarServicio::create([
                'operar_id' => $operar->id,
                'servicio_id' => $this->servicioid,
                'proveedor_id' => $this->agenciaId,
                'precio' => $this->monedaPrecio == 2 ? $precioDolares : $precioSoles,
                'observacion' => 'ENDOSE',
                'moneda_id' => $this->monedaPrecio,
                'cantidad' => $this->paxTotal,
                'estado' => 1,
                'tipo' => 1,
            ]);

            foreach($this->detalles as $i => $detalle)
            {
                $operarReserva = OperarDetalleReserva::create([
                    'operar_id' => $operar->id,
                    'detalle_reserva_id' => $detalle['id'],
                    'recojo' => $this->horarios[$i] != '' ? $this->horarios[$i] : null,
                    'ingresos' => $this->ingresos[$i] ?? 0,
                    'cantidad' => $detalle['pax'],
                    'observacion' => $this->observaciones[$i] ?? null,
                ]);

                $detalle = DetalleReserva::find($detalle['id']);
                $detalle->operado = 1;
                $detalle->save();
            }

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->route('endose.index')->with('success', 'Endose creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.crear-endose');
    }
}
