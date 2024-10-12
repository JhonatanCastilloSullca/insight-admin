<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\DetalleReserva;
use App\Models\Servicio;
use App\Models\Proveedor;
use App\Models\Operar;
use App\Models\Notificacion;
use App\Models\OperarDetalleReserva;
use App\Models\OperarServicio;
use App\Models\OperarPasajero;
use DB;
use Carbon\Carbon;

class OperacionesCreate extends Component
{
    public $servicioid;
    public $servicioOperar;
    public $fecha;
    public $observacion;

    public $detalles = [];
    public $incluyesDetalle = [];
    public $paxTotal = 0;
    public $totalIngresos = 0;

    public $conIngreso = 0;
    public $ingresos;
    public $horarios;
    public $observaciones;

    public $precioServicio;
    public $monedaServicio;
    public $nombreServicio;
    public $idServicio;
    public $comentarioServicio;

    public $precioSoles;
    public $precioDolares;

    public $proveedorIngreso;
    public $proveedoresIngresos;
    public $servicioIngreso;
    public $ingresosTotales;
    
    public $servicios;
    public $totalSoles = 0;
    public $totalDolares = 0;

    public $hotelId;
    public $nuevoHotel;
    public $hotelNuevo = 0;
    public $todosHotel = 0;
    public $todosHotelLima = 0;
    public $direccionHotel;
    public $celularHotel;
    public $detalleHotel;
    public $proveedores;
    public $precioTipoCambio;

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
            $this->ingresos[$i] = $ingresos[$indiceViejo] ?? null;
            $this->observaciones[$i] = $observaciones[$indiceViejo] ?? null;
            $this->horarios[$i] = $horarios[$indiceViejo] ?? null;
            $this->detalles[$i] = $serviciosreserva[$indiceViejo] ?? null;
        }
    }

    public function mount($servicioinit = null, $fechainit = null)
    {
        $servicioinit = $servicioinit ? $servicioinit : $this->servicioid;
        $fechainit = $fechainit ? $fechainit : $this->fecha;
        if($servicioinit != null && $fechainit != null)
        {
            $this->detalles = [];
            $this->servicioid = $servicioinit;
            $this->fecha = $fechainit;
            $this->servicioOperar = Servicio::find($servicioinit);
            $detalles = DetalleReserva::where('fecha_viaje', $this->fecha)
            ->whereRelation('reserva', 'confirmado', 1)
            ->where('estado', 1)
            ->where('operado', 0)
            ->where(function($query) {
                $query->where('servicio_id', $this->servicioid)
                    ->orWhereRelation('servicio', 'servicio_id', $this->servicioid);
            })
            ->get();
            $this->paxTotal =  $detalles->sum('pax');
            $this->incluyesDetalle = $this->servicioOperar->incluyesOperarSinIngresos();
            $this->conIngreso = count($this->servicioOperar->incluyesOperarIngresos()) > 0 ? 1 : 0;
            $this->totalSoles = 0;
            $this->totalDolares = 0;
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
                    'celular' => $detalle->reserva->pasajeroprincipal()?->celular,
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
            foreach($this->incluyesDetalle as $i => $detalle2)
            {
                $this->precioServicio[$i] = 0;
                $this->monedaServicio[$i] = 2;
            }
            $this->precioTipoCambio = (($this->totalDolares * 3.70) + $this->totalSoles ) - (($this->totalDolares * 3.70 * 6) /100);
        }
        if($fechainit == null)
        {
            $this->fecha = date('Y-m-d');
        }
        $this->servicios = Servicio::whereIn('categoria_id',[5,6])->orderBy('titulo','asc')->get();
        $this->proveedoresIngresos = Proveedor::where('categoria_id',17)->get();
        $this->ingresosTotales = Servicio::where('categoria_id',17)->where('incluye',1)->get();
        $this->proveedores = Proveedor::select('id','nombre')->whereRelation('categoria','categoria_id',2)->get();
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

    public function cambiarTipoMoneda($i)
    {
        $this->monedaServicio[$i] = $this->monedaServicio[$i] == 1 ? 2:1;
    }

    public function buscarDetalles()
    {
        $this->incluyesDetalle = [];
        $this->detalles = [];
        if($this->servicioid != '' && $this->fecha != '')
        {
            $this->servicioOperar = Servicio::find($this->servicioid);
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
            $this->incluyesDetalle = $this->servicioOperar->incluyesOperarSinIngresos();
            $this->conIngreso = count($this->servicioOperar->incluyesOperarIngresos()) > 0 ? 1 : 0;
            $this->totalSoles = 0;
            $this->totalDolares = 0;
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
                    'servicio' => $detalle->servicio->titulo,
                    'tipo' => $detalle->tipo,
                    'moneda' => $detalle->moneda->abreviatura ,
                    'precio' => $detalle->precio * $detalle->pax,
                    'celular' => $detalle->reserva->pasajeroprincipal()->celular,
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
            foreach($this->incluyesDetalle as $i => $detalle2)
            {
                $this->precioServicio[$i] = 0;
                $this->monedaServicio[$i] = 2;
                $this->emit('selectProveedor',$i);
            }
            $this->precioTipoCambio = (($this->totalDolares * 3.70) + $this->totalSoles ) - (($this->totalDolares * 3.70 * 6) /100);
        }
    }

    public function updatedservicioid($id)
    {
        $this->buscarDetalles();
    }

    public function updatedfecha($id)
    {
        $this->buscarDetalles();
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

    public function costoTotal()
    {
        $totalSoles = 0;
        $totalDolares = 0;
        foreach($this->incluyesDetalle as $i => $incluye)
        {
            if($this->monedaServicio[$i]==2){
                $totalDolares += $this->precioServicio[$i];
            }
            if($this->monedaServicio[$i]==1){
                $totalSoles += $this->precioServicio[$i];
            }
        }

        $this->precioSoles = $totalSoles;
        $this->precioDolares = $totalDolares;
    }

    public function register()
    {
        foreach($this->incluyesDetalle as $i => $incluye)
        {
            $this->validate([
                'idServicio.'.$i => 'required',
                'precioServicio.'.$i => 'required|min:1|numeric',
            ]);
        }
        foreach($this->detalles as $i => $incluye)
        {
            $this->validate([
                'horarios.'.$i => 'required',
            ]);
        }
        if($this->totalIngresos > 0){
            $this->validate([
                'proveedorIngreso' => 'required',
            ]);
        }

        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $this->costoTotal();
            $operar = Operar::create([
                'fecha' => $this->fecha,
                'observacion' => $this->observacion,
                'cantidad_pax' => $this->paxTotal,
                'ingresos' => $this->totalIngresos,
                'precioSoles' => $this->precioSoles,
                'precioDolares' => $this->precioDolares,
                'user_id' => \Auth::user()->id,
                'servicio_id' => $this->servicioid,
                'estado' => 1,
                'tipo' => 0,
                'operado' => 1,
            ]);

            if($this->totalIngresos > 0){
                OperarServicio::create([
                    'operar_id' => $operar->id,
                    'servicio_id' => $this->servicioIngreso,
                    'proveedor_id' => $this->proveedorIngreso,
                    'precio' => $this->totalIngresos,
                    'moneda_id' => 1,
                    'cantidad' => $this->paxTotal,
                    'tipo' => 0,
                    'estado' => 1
                ]);
            }

            foreach($this->incluyesDetalle as $i => $incluye)
            {
                $operarServicio = OperarServicio::create([
                    'operar_id' => $operar->id,
                    'servicio_id' => $incluye->id,
                    'proveedor_id' => $this->idServicio[$i],
                    'precio' => $this->precioServicio[$i],
                    'observacion' => $this->comentarioServicio[$i] ?? null,
                    'moneda_id' => $this->monedaServicio[$i],
                    'cantidad' => $this->paxTotal,
                    'estado' => 1,
                    'tipo' => 0,
                ]);
            }

            foreach($this->detalles as $i => $detalle)
            {
                $operarReserva = OperarDetalleReserva::create([
                    'operar_id' => $operar->id,
                    'detalle_reserva_id' => $detalle['id'],
                    'recojo' => $this->horarios[$i],
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

        return redirect()->route('operacion.tours')->with('success', 'Operacion creado exitosamente.');
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

    public function render()
    {
        return view('livewire.operaciones-create');
    }
}
