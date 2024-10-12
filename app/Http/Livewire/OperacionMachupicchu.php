<?php

namespace App\Http\Livewire;

use App\Models\DetalleReserva;
use App\Models\Operar;
use App\Models\OperarDetalleReserva;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use App\Models\Servicio;
use Carbon\Carbon;
use Livewire\Component;
use DB;

class OperacionMachupicchu extends Component
{
    public $guiaId;
    public $servicioid;
    public $fecha;
    public $fechaFin;
    public $observacion;
    public $guiados;
    public $detallesOtros = [];

    public $detalles = [];
    public $paxTotal = 0;

    public $observaciones;
    public $idioma;
    public $operarId;
    public $monedaOperacion;
    public $precioOperacion;

    public $guias;
    public $servicios;
    public $proveedores;

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
    public $observacionFila;

    protected $listeners = ['actualizarOrdenServicios' => 'actualizarOrdenServicios'];

    public function actualizarOrdenServicios($ordenElementos)
    {
        // Crea una copia de los arrays originales para preservar los valores actuales
        $serviciosreserva = $this->detalles;
        $observaciones = $this->observaciones;
        $idioma = $this->idioma;
        $operarId = $this->operarId;
        $monedaOperacion = $this->monedaOperacion;
        $precioOperacion = $this->precioOperacion;
        $observacionFila = $this->observacionFila;
        // Recorre el array de índices reordenados
        foreach ($ordenElementos as $i => $indiceViejo) {
            // Usa el índice nuevo para actualizar los valores correspondientes en tus arrays de datos
            $this->detalles[$i] = $serviciosreserva[$indiceViejo] ?? null;
            $this->observaciones[$i] = $observaciones[$indiceViejo] ?? null;
            $this->idioma[$i] = $idioma[$indiceViejo] ?? null;
            $this->operarId[$i] = $operarId[$indiceViejo] ?? null;
            $this->monedaOperacion[$i] = $monedaOperacion[$indiceViejo] ?? null;
            $this->precioOperacion[$i] = $precioOperacion[$indiceViejo] ?? null;
            $this->observacionFila[$i] = $observacionFila[$indiceViejo] ?? null;
        }
    }

    public function mount()
    {
        $this->servicios = Servicio::whereIn('categoria_id',[5,6])->orderBy('titulo','asc')->get();
        $this->guias = Proveedor::where('categoria_id',15)->get();
        $this->guiados = Servicio::where('categoria_id',15)->get();
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
        $this->totalSoles = 0;
        $this->totalDolares = 0;
        $this->detalles = [];
        $this->detallesOtros = [];
        $this->observaciones = [];
        if($this->servicioid != '' && $this->fecha != '' && $this->fechaFin != '')
        {
            $servicioo = Servicio::find($this->servicioid);
            $detallesOtros = [];
            foreach($servicioo ->incluyesOperarIngresos() as $ser){
                $detallesOtros[]=[
                    'id' => $ser->id,
                    'titulo' => $ser->titulo,
                ];
            }
            $this->detallesOtros = $detallesOtros;
            $detalles = DetalleReserva::whereDate('fecha_viaje', '>=',$this->fecha)
            ->whereDate('fecha_viaje', '<=',$this->fechaFin)
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
                    'celular' => $detalle->reserva->pasajeroprincipal()->celular,
                    'hotel' => $detalle->hotel?->nombre.' '.$detalle->hotel?->direccion,
                ];
                $this->observaciones[$i] = $detalle->comentarios;
                $this->idioma[$i] = 'ESPAÑOL';
                $this->operarId[$i] = null;
                $this->monedaOperacion[$i] = 2;
                $this->precioOperacion[$i] = 0;
                $this->observacionFila[$i] = '';

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

                $entradas=[];
                foreach($detalle->reserva->operarTickets as $i => $servici)
                {
                    $operarser = OperarServicio::where('servicio_id',$servici->servicio_id)
                    ->where('operar_id',$servici->id)->first();
                    $serviciosss = Servicio::find($servici->servicio_id);
                    $entrada = [
                        'id' => $servici->id,
                        'servicioid' => $servici->servicio_id,
                        'servicioIdOtro' => $serviciosss->servicio_id,
                        'recojo' => $operarser->recojo,
                        'observacion' => $operarser->observacion,
                    ];
                    $entradas[] = $entrada;
                }
                $nuevoServicio['servicios'] = $entradas;
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
        // $this->servicios = DetalleReserva::join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        // ->join('reservas','reservas.id','=','detalle_reservas.reserva_id')->select('servicios.id','servicios.titulo as text')
        // ->where('servicios.categoria_id',5)->whereDate('detalle_reservas.fecha_viaje',$this->fecha)
        // ->where('detalle_reservas.operado',0)->where('reservas.confirmado',1)
        // ->groupBy('servicios.id','servicios.titulo')->orderBy('servicios.titulo','asc')->get();
        $this->buscarDetalles();
    }

    public function updatedfecha($id)
    {
        // $this->servicios = DetalleReserva::join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        // ->join('reservas','reservas.id','=','detalle_reservas.reserva_id')->select('servicios.id','servicios.titulo as text')
        // ->where('servicios.categoria_id',5)->whereDate('detalle_reservas.fecha_viaje',$this->fecha)
        // ->where('detalle_reservas.operado',0)->where('reservas.confirmado',1)
        // ->groupBy('servicios.id','servicios.titulo')->orderBy('servicios.titulo','asc')->get();
        $this->buscarDetalles();
        // $this->agregarServicios();
    }

    public function updatedfechaFin($id)
    {
        // $this->servicios = DetalleReserva::join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        // ->join('reservas','reservas.id','=','detalle_reservas.reserva_id')->select('servicios.id','servicios.titulo as text')
        // ->where('servicios.categoria_id',5)->whereDate('detalle_reservas.fecha_viaje',$this->fecha)
        // ->where('detalle_reservas.operado',0)->where('reservas.confirmado',1)
        // ->groupBy('servicios.id','servicios.titulo')->orderBy('servicios.titulo','asc')->get();
        $this->buscarDetalles();
        // $this->agregarServicios();
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
        unset($this->detalles[$i]);
        $this->observaciones = array_values($this->observaciones);
        $this->detalles = array_values($this->detalles);
        $this->calcularIngresos();
        $this->calcularPax();
    }

    public function cambiarTipoMoneda($i)
    {
        $this->monedaOperacion[$i] = $this->monedaOperacion[$i] == 1 ? 2:1;
    }

    public function register()
    {
        foreach($this->detalles as $i => $detalle)
        {
            $this->validate([
                'fecha' => 'required',
                'guiaId' => 'required',
                'servicioid' => 'required',
                'idioma.'.$i => 'required',
                'operarId.'.$i => 'required',
                'precioOperacion.'.$i => 'required',
            ]);
        }
        
        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $operar = Operar::create([
                'fecha' => $mytime->toDateTimeString(),
                'cantidad_pax' => $this->paxTotal,
                'ingresos' => 0,
                'precioSoles' => 0,
                'precioDolares' => 0,
                'servicio_id' => $this->servicioid,
                'user_id' => \Auth::user()->id,
                'estado' => 1,
                'operado' => 1,
                'machupicchu' => 1,
                'observacion' => $this->observacion,
            ]);            
            $precioSoles = 0;
            $precioDolares = 0;
            foreach($this->detalles as $i => $detalle)
            {
                if($this->monedaOperacion[$i] == 2){
                    $precioDolares += $this->precioOperacion[$i];
                }else{
                    $precioSoles += $this->precioOperacion[$i];
                }

                $operarServicio = OperarServicio::create([
                    'operar_id' => $operar->id,
                    'servicio_id' => $this->operarId[$i],
                    'proveedor_id' => $this->guiaId,
                    'precio' => $this->precioOperacion[$i],
                    'idioma' => $this->idioma[$i],
                    'observacion' => $this->observacionFila[$i],
                    'moneda_id' =>  $this->monedaOperacion[$i],
                    'detalle_reserva_id' =>  $detalle['id'],
                    'cantidad' => $this->paxTotal,
                    'estado' => 1,
                    'tipo' => 0,
                ]);

                $detalle = DetalleReserva::find($detalle['id']);
                $detalle->operado = 1;
                $detalle->save();
            }

            $operar->precioSoles = $precioSoles;
            $operar->precioDolares = $precioDolares;
            $operar->save();

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->route('operacion.machupicchu')->with('success', 'Operacion creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.operacion-machupicchu');
    }
}
