<?php

namespace App\Http\Livewire;

use App\Models\Aeropuertos;
use App\Models\Cuota;
use App\Models\Cupon;
use App\Models\DetalleReserva;
use App\Models\Documento;
use App\Models\Historia;
use App\Models\ItinerarioReserva;
use App\Models\Medio;
use App\Models\Moneda;
use App\Models\Pago;
use App\Models\Pais;
use App\Models\Pasajero;
use App\Models\User;
use App\Models\Precio;
use App\Models\Reprogramacion;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Total;
use App\Services\HistoriaService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

class CrearReserva extends Component
{
    use WithFileUploads;

    public $fechaReserva;
    public $nombres;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $nacimiento;
    public $principalPasajero=0;
    public $genero='MASCULINO';
    public $celular;
    public $email;
    public $tarifa="ADULTO";
    public $pais_id;
    public $documento='DNI';
    public $num_doc;
    public $comentario;
    public $imagen;
    public $imagenver;
    public $pasajeros;
    public $paises;
    public $pasajerosreserva=[];
    public $serviciosreserva=[];
    public $hotelesreserva=[];
    public $vuelosreserva=[];
    public $pagosreserva=[];
    public $pasajero_id_editar;

    public $servicios;
    public $monedas;
    public $servicio_id;
    public $detalleServicioId;
    public $pax=1;
    public $fecha_viaje;
    public $tarifaServicio=1;
    public $moneda_id=2;
    public $precio;
    public $preciomin;
    public $incluye;
    public $noincluye;
    public $comentariodetalle;
    public $incluyes;
    public $tiposervicio=0;
    public $servicio_id_editar;

    public $hotel_id_editar;
    public $hotel_id;
    public $detalleHotelId;
    public $paxhotel;
    public $cantidadHabitaciones;
    public $fecha_viajehotel;
    public $fecha_viajehotelfin;
    public $checkinn_hotel;
    public $checkout_hotel;
    public $preciohotel;
    public $preciohotelmin;
    public $moneda_idhotel=2;
    public $incluyehotel;
    public $noincluyehotel;
    public $comentariodetallehotel;
    public $adicionalHotel;

    public $vuelo_id_editar;
    public $vuelo_id;
    public $detalleVueloId;
    public $paxvuelo;
    public $fecha_viajevuelo;
    public $fecha_viajevuelofin;
    public $preciovuelo;
    public $preciovuelomin;
    public $moneda_idvuelo;
    public $incluyevuelo;
    public $noincluyevuelo;
    public $descripcionvuelo;
    public $comentariodetallevuelo;
    public $tipovuelo=1;
    public $equipajevuelo;
    public $desde;
    public $hasta;
    public $desderetorno;
    public $hastaretorno;

    public $totalsoles = 0;
    public $totaldolares = 0;
    public $pagosoles = 0;
    public $pagodolares = 0;
    public $saldosoles = 0;
    public $saldodolares = 0;
    public $descuentosoles=0;
    public $descuentodolares=0;

    public $monedapago;
    public $montopago;
    public $num_operacion;
    public $comentariopago;
    public $medio_pago;
    public $codigodescuento;
    public $cuponid = null;
    public $reserva = null;
    public $pagoId=null;

    public $cuotas = 0;
    public $fechacuota;
    public $monedacuota;
    public $montocuota;
    public $comentariocuota;
    public $aeropuertos;

    public $itinerarios=[];
    public $itinerarioshotel=[];
    public $itinerariosvuelo=[];
    public $tarifas;
    public $precioId=1;
    public $hoteles;
    public $incluyeHoteles;
    public $vuelos;
    public $incluyeVuelos;
    public $incluyeServicios;

    public $vendedorId;
    public $vendedores;

    public bool $isSaving = false;

    protected $listeners = ['actualizarOrdenServicios' => 'actualizarOrdenServicios'];

    public function actualizarOrdenServicios($ordenElementos)
    {
        // Crea una copia de los arrays originales para preservar los valores actuales
        $serviciosreserva = $this->serviciosreserva;

        // Recorre el array de índices reordenados
        foreach ($ordenElementos as $i => $indiceViejo) {
            // Usa el índice nuevo para actualizar los valores correspondientes en tus arrays de datos
            $this->serviciosreserva[$i] = $serviciosreserva[$indiceViejo] ?? null;
        }
    }

    public function mount(Reserva $reserva = null)
    {
        $this->servicios = Servicio::whereIn('categoria_id',[5,6])->orderBy('titulo','asc')->get();
        $this->incluyeServicios = Servicio::whereRelation('categoria','detalle',1)->whereNotIn('categoria_id',[2,3,5])->orderBy('titulo','asc')->get();
        $this->hoteles = Servicio::where('categoria_id', 2)->where('incluye', 0)->get(); 
        $this->incluyeHoteles = Servicio::where('incluye',1)->where('categoria_id',2)->orderBy('titulo','asc')->get();
        $this->vuelos = Servicio::where('categoria_id',3)->where('incluye',0)->orderBy('titulo','asc')->get();
        $this->incluyeVuelos = Servicio::where('incluye',1)->where('categoria_id',3)->orderBy('titulo','asc')->get();
        $this->tarifas = Precio::all();
        $this->aeropuertos = Aeropuertos::all();
        $this->reserva = $reserva;
        $this->paises = Pais::all();
        $this->monedas = Moneda::all();
        $this->vendedores = User::get();

        if($reserva != null)
        {
            $this->vendedorId = $reserva->user_id;
            $this->fechaReserva = $reserva->fecha ? date("Y-m-d",strtotime($reserva->fecha)) : Carbon::now()->format("Y-m-d");
            foreach($reserva->pasajeros as $pasajero)
            {
                $nuevoPasajero = [
                    'id' => $pasajero->id,
                    'nombres' => $pasajero->nombres,
                    'apellidoPaterno' => $pasajero->apellidoPaterno,
                    'apellidoMaterno' => $pasajero->apellidoMaterno,
                    'nacimiento' => $pasajero->nacimiento,
                    'genero' => $pasajero->genero,
                    'celular' => $pasajero->celular,
                    'email' => $pasajero->email,
                    'tarifa' => $pasajero->tarifa,
                    'pais_id' => $pasajero->pais_id,
                    'pais_nombre' => $pasajero->pais->nombre,
                    'documento' => $pasajero->documento?->tipo_documento,
                    'num_doc' => $pasajero->documento?->num_documento,
                    'comentario' => $pasajero->comentario,
                    'imagen' => $pasajero->imagen,
                    'principal' => $pasajero->principal,
                ];
                $this->pasajerosreserva[] = $nuevoPasajero;
            }

            foreach($reserva->detallestours as $detalle){
                $nuevoServicio = [
                    'detalle_id' => $detalle->id,
                    'id' => $detalle->servicio_id,
                    'servicio' => $detalle->servicio->titulo,
                    'pax' => $detalle->pax,
                    'fecha_viaje' => $detalle->fecha_viaje ? date("Y-m-d",strtotime($detalle->fecha_viaje)) : null,
                    'precio' => $detalle->precio,
                    'tipo' => $detalle->tipo,
                    'precio_id' => $detalle->precio_id,
                    'precioNombre' => $detalle->precioTarifa?->nombre,
                    'moneda_id' => $detalle->moneda_id,
                    'moneda' => $detalle->moneda->abreviatura,
                    'comentariodetalle' => $detalle->comentarios,
                ];
                $itinerarios = [];
                foreach($detalle->itinerarios as $i => $itinerario){
                    $incluyes=[];
                    $itinerari = [
                        'dia' => $i+1,
                    ];
                    foreach($itinerario->incluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                    $noincluyes=[];
                    foreach($itinerario->noincluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $noincluyes[] = $incluye;
                    }
                
                    $itinerari['incluye'] = $incluyes;
                    $itinerari['noincluye'] = $noincluyes;
                    $itinerarios[] = $itinerari;
                }

                $nuevoServicio['itinerarios'] = $itinerarios;
                $this->serviciosreserva[] = $nuevoServicio;
            }

            foreach($reserva->detalleshoteles as $detalle){
                $nuevoHotel = [
                    'detalle_id' => $detalle->id,
                    'id' => $detalle->servicio_id,
                    'servicio' => $detalle->servicio->proveedor?->nombre.' '.$detalle->servicio->proveedor?->ubicacion?->nombre.' '.$detalle->servicio->titulo,
                    'pax' => $detalle->pax,
                    'noches' => $detalle->equipaje,
                    'fecha_viaje' => $detalle->fecha_viaje ? date("Y-m-d H:i",strtotime($detalle->fecha_viaje)) : null,
                    'fecha_viajefin' => $detalle->fecha_viajefin ? date("Y-m-d H:i",strtotime($detalle->fecha_viajefin)) : null,
                    'precio' => $detalle->precio,
                    'adicional' => $detalle->adicional,
                    'tipo' => $detalle->tipo,
                    'precio_id' => $detalle->precio_id,
                    'moneda_id' => $detalle->moneda_id,
                    'moneda' => $detalle->moneda->abreviatura,
                    'comentariodetalle' => $detalle->comentarios,
                ];
                $itinerarios = [];
                foreach($detalle->itinerarios as $i => $itinerario){
                    $incluyes=[];
                    $itinerari = [
                        'dia' => $i+1,
                    ];
                    foreach($itinerario->incluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                    $noincluyes=[];
                    foreach($itinerario->noincluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $noincluyes[] = $incluye;
                    }
                
                    $itinerari['incluye'] = $incluyes;
                    $itinerari['noincluye'] = $noincluyes;
                    $itinerarios[] = $itinerari;
                }

                $nuevoHotel['itinerarios'] = $itinerarios;
            
                $this->hotelesreserva[] = $nuevoHotel;
            }

            foreach($reserva->detallesvuelos as $detalle){
                $cadena_sin_ida_vuelta = str_replace(['IDA', 'VUELTA'], '', $detalle->descripcion);
                $partes = explode("-", $cadena_sin_ida_vuelta);
                $parte_primera = trim($partes[0]);
                preg_match('/\((.*?)\)/', $parte_primera, $matches);
                $valores_deseados = explode('/', $matches[1]);
                if(isset($partes[1])){
                    $parte_segunda = trim($partes[1]);
                    preg_match('/\((.*?)\)/', $parte_segunda, $matches1);
                    $valores_deseados2 = explode('/', $matches1[1]);
                }
                
                $nuevoVuelo = [
                    'detalle_id' => $detalle->id,
                    'id' => $detalle->servicio_id,
                    'servicio' => $detalle->servicio->titulo,
                    'pax' => $detalle->pax,
                    'descripcion' => $detalle->descripcion,
                    'fecha_viaje' => $detalle->fecha_viaje,
                    'fecha_viajefin' => $detalle->fecha_viajefin,
                    'precio' => $detalle->precio,
                    'tipo' => $detalle->tipo,
                    'moneda_id' => $detalle->moneda_id,
                    'moneda' => $detalle->moneda->abreviatura,
                    'comentariodetalle' => $detalle->comentarios,
                    'equipajevuelo' => $detalle->equipaje,
                    'precio_id' => $detalle->precio_id,
                    'desde' => $valores_deseados[0],
                    'hasta' => $valores_deseados[1],
                    'desderetorno' => $valores_deseados2[0] ?? null,
                    'hastaretorno' => $valores_deseados2[1] ?? null,
                ];
                $itinerarios = [];
                foreach($detalle->itinerarios as $i => $itinerario){
                    $incluyes=[];
                    $itinerari = [
                        'dia' => $i+1,
                    ];
                    foreach($itinerario->incluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                    $noincluyes=[];
                    foreach($itinerario->noincluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $noincluyes[] = $incluye;
                    }
                
                    $itinerari['incluye'] = $incluyes;
                    $itinerari['noincluye'] = $noincluyes;
                    $itinerarios[] = $itinerari;
                }

                $nuevoVuelo['itinerarios'] = $itinerarios;
            
                $this->vuelosreserva[] = $nuevoVuelo;
            }

            foreach($reserva->totales as $total){
                if($total->moneda_id == 1){
                    $this->totalsoles = $total->total;
                    $this->pagosoles = $total->acuenta;
                    $this->saldosoles = $total->saldo;
                    $this->descuentosoles= $total->descuento;
                }else{
                    $this->totaldolares = $total->total;
                    $this->pagodolares = $total->acuenta;
                    $this->saldodolares = $total->saldo;
                    $this->descuentodolares= $total->descuento;
                }
            }

            $this->cuotas = count($reserva->cuotas);
            foreach($reserva->cuotas as $i => $cuota){
                $this->fechacuota[$i] = $cuota->fecha;
                $this->montocuota[$i] = $cuota->monto;
                $this->monedacuota[$i] = $cuota->moneda_id;
                $this->comentariocuota[$i] = $cuota->comentarios;
            }

            foreach($reserva->pagos as $pagoo)
            {
                $nuevoPago = [
                    'pago_id' => $pagoo->id,
                    'id' => $pagoo->medio_id,
                    'medio' => $pagoo->medio->nombre,
                    'monto' => $pagoo->monto,
                    'num_operacion' => $pagoo->num_operacion,
                    'moneda_id' => $pagoo->moneda_id,
                    'moneda' => $pagoo->moneda->abreviatura,
                    'comentariopago' => $pagoo->comentarios,
                ];
        
                $this->pagosreserva[] = $nuevoPago;
            }
        }
    }

    public function abrirPasajero()
    {
        $this->pasajero_id_editar=null;
        $this->nacimiento= '';
        $this->genero= 'MASCULINO';
        $this->celular= '';
        $this->email= '';
        $this->tarifa= "ADULTO";
        $this->pais_id= '';
        $this->documento= 'DNI';
        $this->num_doc= '';
        $this->comentario= '';
        $this->imagen = '';
        $this->imagenver= '';
        $this->nombres= '';
        $this->apellidoPaterno= '';
        $this->apellidoMaterno= '';
        $this->principalPasajero= 0;
        $this->emit('EncontrarPasajero',null);
    }

    public function searchDocumento()
    {
        $this->validate([
            'documento' => 'required',
            'num_doc' => 'required',
        ]);

        $pasajero = Pasajero::whereRelation('documento','tipo_documento',$this->documento)->whereRelation('documento','num_documento',$this->num_doc)->first();

        if($pasajero){
            $this->nombres= $pasajero->nombres;
            $this->apellidoPaterno= $pasajero->apellidoPaterno;
            $this->apellidoMaterno= $pasajero->apellidoMaterno;
            $this->nacimiento= $pasajero->nacimiento;
            $this->genero= $pasajero->genero;
            $this->celular= $pasajero->celular;
            $this->email= $pasajero->email;
            $this->tarifa= $pasajero->tarifa;
            $this->pais_id= $pasajero->pais_id;
            $this->documento= $pasajero->documento->tipo_documento;
            $this->num_doc= $pasajero->documento->num_documento;
            $this->comentario= $pasajero->comentario;
            $this->imagenver= $pasajero->imagen;
            $this->emit('EncontrarPasajero',$pasajero->pais_id);
        }else{
            if ($this->documento == 'DNI') {
                $token = config('services.apisunat.token');
                $urldni = config('services.apisunat.urldni');
                $host = 'api.apis.net.pe';
                if (gethostbyname($host) == $host) {
                    session()->flash('success', 'No hay conexión a Internet. Por favor, verifica tu conexión y vuelve a intentarlo.');
                } else {
                    try {
                        $response = Http::timeout(10)->withHeaders([
                            'Referer' => 'http://apis.net.pe/api-ruc',
                            'Authorization' => 'Bearer ' . $token
                        ])->get($urldni . $this->num_doc);
                        $persona = ($response->json());
                        if (isset($persona['message']) || $persona == "") {
                                session()->flash('success', 'Dni no Valido');
                        } else {
                            $this->nombres= $persona['nombres'];
                            $this->apellidoPaterno= $persona['apellidoPaterno'];
                            $this->apellidoMaterno= $persona['apellidoMaterno'];
                        }
                    } catch (RequestException $e) {
                        if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                            session()->flash('success', 'Se ha superado el límite de tiempo de la solicitud. Por favor, inténtalo de nuevo más tarde.');
                        } else {
                            session()->flash('success', 'Ocurrió un error al consumir la API:');
                        }
                    }
                }
            }
        }
    }


    public function agregarPasajero()
    {
        if($this->principalPasajero == 1){
            $text = 'nullable|email|max:100';
            $text2 = 'nullable|max:50';
        }else{
            $text = 'nullable|email|max:100';
            $text2 = 'nullable|max:50';
        }

        $this->validate([
            'nombres' => 'required',
            'apellidoPaterno' => 'required',
            'genero' => 'required',
            'nacimiento' => 'required|date',
            'celular' => $text2,
            'email' => $text,
            'pais_id' => 'required|exists:pais,id',
            'documento' => 'required',
            'num_doc' => 'required',
        ]);

        $pais = Pais::find($this->pais_id);
        $documento=Documento::firstOrCreate([
            'tipo_documento' => $this->documento,
            'num_documento' => $this->num_doc,
            ],[
        ]);
        if($this->imagen){
            $nombreimg=$this->documento.'-'.$this->num_doc.'.'.$this->imagen->getClientOriginalExtension();
            $ruta=$this->imagen->storeAs('img/documentos',$nombreimg);
            Image::make('storage/'.$ruta)->fit(1600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('storage/'.$ruta,null,'jpg');
        }else{
            if($this->imagenver!=''){
                $nombreimg=$this->imagenver;
            }else{
                
                $nombreimg='';
            }
        }
        $pasajero=Pasajero::updateOrCreate([
            'nombres' => $this->nombres,
            'apellidoPaterno' => $this->apellidoPaterno,
            'apellidoMaterno' => $this->apellidoMaterno,
            'documento_id' => $documento->id
        ],[
            'genero' => $this->genero,
            'nacimiento' => $this->nacimiento,
            'celular' => $this->celular,
            'email' => $this->email,
            'tarifa' => $this->tarifa,
            'pais_id' => $this->pais_id,
            'imagen' => $nombreimg,
            'comentario' => $this->comentario,
            'principal' => $this->principalPasajero,
        ]);
        
        $nuevoPasajero = [
            'id' => $pasajero->id,
            'nombres' => $this->nombres,
            'apellidoPaterno' => $this->apellidoPaterno,
            'apellidoMaterno' => $this->apellidoMaterno,
            'nacimiento' => $this->nacimiento,
            'genero' => $this->genero,
            'celular' => $this->celular,
            'email' => $this->email,
            'tarifa' => $this->tarifa,
            'pais_id' => $this->pais_id,
            'pais_nombre' => $pais->nombre,
            'documento' => $this->documento,
            'num_doc' => $this->num_doc,
            'comentario' => $this->comentario,
            'principal' => $this->principalPasajero,
            'imagen' => $nombreimg
        ];

        if($this->pasajero_id_editar != '' ){
            $this->pasajerosreserva[$this->pasajero_id_editar] = $nuevoPasajero;
        }else{
            $this->pasajerosreserva[] = $nuevoPasajero;
        }
        $this->emit('cerrarPasajero');
    }

    public function reducirPasajero($i)
    {
        unset($this->pasajerosreserva[$i]);
        $this->pasajerosreserva = array_values($this->pasajerosreserva);
    }

    public function editarPasajero($i)
    {
        $pasajero=Pasajero::find($this->pasajerosreserva[$i]['id']);
        $this->pasajero_id_editar=$i;
        $this->nacimiento= $pasajero->nacimiento;
        $this->genero= $pasajero->genero;
        $this->celular= $pasajero->celular;
        $this->email= $pasajero->email;
        $this->tarifa= $pasajero->tarifa;
        $this->pais_id= $pasajero->pais_id;
        $this->documento= $pasajero->documento->tipo_documento;
        $this->num_doc= $pasajero->documento->num_documento;
        $this->comentario= $pasajero->comentario;
        $this->imagenver= $pasajero->imagen;
        $this->imagen= '';
        $this->nombres= $pasajero->nombres;
        $this->apellidoPaterno= $pasajero->apellidoPaterno;
        $this->apellidoMaterno= $pasajero->apellidoMaterno;
        $this->principalPasajero= $pasajero->principal;        
        $this->emit('EncontrarPasajero',$this->pasajerosreserva[$i]['pais_id']);
    }

    public function updatedservicioId($id)
    {
        $servicio=Servicio::find($id);
        if($servicio == ""){
            $this->servicio_id = null;
            $this->incluye = [];
            $this->noincluye = [];
        }else{
            $this->servicio_id = $servicio->id;
            $this->itinerarios = $servicio->itinerarios;
            $precio = $servicio->precios()->wherePivot('moneda_id', $this->moneda_id)->wherePivot('precio_id', $this->precioId)->first();
            $this->precio = $precio ? $precio->pivot?->precio : 0;
            $this->preciomin = $precio ? $precio->pivot?->precio_minimo : 0;
            foreach($servicio->itinerarios as $i => $itinerario)
            {
                $this->incluye[$i] = $itinerario->incluyes->pluck('id');
                $this->noincluye[$i] = $itinerario->noincluyes->pluck('id');
                $this->emit('EncontrarServicio',$this->servicio_id,$this->incluye[$i],$this->noincluye[$i],$i);
            }
        }
    }

    public function agregarServicio()
    {
        $this->monedapago = $this->moneda_id;
        $this->preciomin = $this->preciomin ? $this->preciomin : 0;
        $this->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'pax' => 'required',
            'fecha_viaje' => 'required|date',
            'precio' => 'required|min:'.$this->preciomin.'|numeric',
            'moneda_id' => 'required|exists:monedas,id',
            'precioId' => 'required|exists:precios,id',
        ]);
        $servicio = Servicio::find($this->servicio_id);
        $moneda = Moneda::find($this->moneda_id);
        $price = Precio::find($this->precioId);
        $nuevoServicio = [
            'detalle_id' => $this->detalleServicioId,
            'id' => $servicio->id,
            'servicio' => $servicio->titulo,
            'pax' => $this->pax,
            'fecha_viaje' => $this->fecha_viaje,
            'precio' => $this->precio,
            'tipo' => $this->tiposervicio,
            'precio_id' => $this->precioId,
            'precioNombre' => $price->nombre,
            'moneda_id' => $this->moneda_id,
            'moneda' => $moneda->abreviatura,
            'comentariodetalle' => $this->comentariodetalle,
        ];
        
        $itinerarios = [];
        foreach($this->itinerarios as $i => $itinerario){
            $incluyes=[];
            $itinerari = [
                'dia' => $i+1,
            ];
            foreach($this->incluye[$i] as $id)
            {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $incluyes[] = $incluye;
            }
            $noincluyes=[];
            foreach($this->noincluye[$i] as $id)
            {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $noincluyes[] = $incluye;
            }
        
            $itinerari['incluye'] = $incluyes;
            $itinerari['noincluye'] = $noincluyes;
            $itinerarios[] = $itinerari;
        }

        $nuevoServicio['itinerarios'] = $itinerarios;
    
        if($this->servicio_id_editar != '' ){
            $this->serviciosreserva[$this->servicio_id_editar] = $nuevoServicio;
        }else{
            $this->serviciosreserva[] = $nuevoServicio;
        }

        usort($this->serviciosreserva, function($a, $b) {
            return strtotime($a['fecha_viaje']) - strtotime($b['fecha_viaje']);
        });

        $this->totales();
        $this->emit('cerrarServicio');
    }

    public function reducirServicio($i)
    {
        unset($this->serviciosreserva[$i]);
        $this->serviciosreserva = array_values($this->serviciosreserva);
        $this->totales();
    }

    public function editarServicio($i)
    {
        $this->detalleServicioId = $this->serviciosreserva[$i]['detalle_id'];
        $this->servicio_id_editar = $i;
        $this->servicio_id= $this->serviciosreserva[$i]['id'];
        $this->pax= $this->serviciosreserva[$i]['pax'];
        $this->fecha_viaje= $this->serviciosreserva[$i]['fecha_viaje'];
        $this->precio= $this->serviciosreserva[$i]['precio'];
        $this->tiposervicio= $this->serviciosreserva[$i]['tipo'] == 0 ? 0 : 1;
        $this->precioId= $this->serviciosreserva[$i]['precio_id'];
        $this->moneda_id= $this->serviciosreserva[$i]['moneda_id'];
        $this->itinerarios = $this->serviciosreserva[$i]['itinerarios'];
        $servicio=Servicio::find($this->serviciosreserva[$i]['id']);
        $precio = $servicio->precios()->wherePivot('moneda_id', $this->moneda_id)->wherePivot('precio_id', $this->precioId)->first();
        $this->preciomin = $precio ? $precio->pivot?->precio_minimo : 0;
        $this->comentariodetalle= $this->serviciosreserva[$i]['comentariodetalle'];
        foreach($this->itinerarios as $i => $itinerario)
        {
            $this->incluye[$i]= collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluye[$i]= collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarServicio',$this->servicio_id,$this->incluye[$i],$this->noincluye[$i],$i);
        }
    }

    public function duplicarServicio($i)
    {
        $this->servicio_id_editar = null;
        $this->detalleServicioId = null;
        $this->servicio_id= $this->serviciosreserva[$i]['id'];
        $this->pax= $this->serviciosreserva[$i]['pax'];
        $this->fecha_viaje= $this->serviciosreserva[$i]['fecha_viaje'];
        $this->precio= $this->serviciosreserva[$i]['precio'];
        $this->tiposervicio= $this->serviciosreserva[$i]['tipo'] == 0 ? 0 : 1;
        $this->precioId= $this->serviciosreserva[$i]['precio_id'];
        $this->moneda_id= $this->serviciosreserva[$i]['moneda_id'];
        $this->itinerarios = $this->serviciosreserva[$i]['itinerarios'];
        $this->comentariodetalle= $this->serviciosreserva[$i]['comentariodetalle'];
        foreach($this->itinerarios as $i => $itinerario)
        {
            $this->incluye[$i]= collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluye[$i]= collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarServicio',$this->servicio_id,$this->incluye[$i],$this->noincluye[$i],$i);

        }
    }

    public function abrirServicio()
    {
        $this->detalleServicioId = null;
        $this->servicio_id_editar = null;
        $this->servicio_id= null;
        $this->fecha_viaje= '';
        $this->pax= count($this->pasajerosreserva);
        $this->precio= 0;
        $this->tiposervicio= 0;
        $this->tarifaServicio= 0;
        $this->incluye= [];
        $this->noincluye= [];
        $this->itinerarios= [];
        $this->comentariodetalle= '';
        $this->emit('EncontrarServicio',null,null,null);
    }

    public function abrirHotel()
    {
        $this->detalleHotelId = null;
        $this->hotel_id_editar = null;
        $this->hotel_id= null;
        $this->paxhotel= 1;
        $this->fecha_viajehotel= '';
        $this->fecha_viajehotelfin= '';
        $this->cantidadHabitaciones = 1;
        $this->preciohotel= '';
        $this->moneda_idhotel= $this->moneda_id;
        $this->incluyehotel= [];
        $this->noincluyehotel= [];
        $this->itinerarioshotel = [];
        $this->comentariodetallehotel= '';
        $this->adicionalHotel = 0;
        $this->checkinn_hotel = '';
        $this->checkout_hotel = '';
        $this->emit('EncontrarHotel',null,null,null);
    }

    public function updatedhotelId($id)
    {
        $servicio=Servicio::find($id);
        if($servicio == ""){
            $this->hotel_id = null;
            $this->incluyehotel = null;
            $this->noincluyehotel = null;
        }else{
            $this->hotel_id = $servicio->id;
            $this->itinerarioshotel = $servicio->itinerarios;
            $precio = $servicio->precios()->wherePivot('moneda_id', $this->moneda_idhotel)->first();
            $this->preciohotel = $precio ? $precio->pivot?->precio : 0;
            $this->preciohotelmin = $precio ? $precio->pivot?->precio_minimo : 0;
            $this->checkinn_hotel = $servicio->proveedor->checkinn ? date("H:i",strtotime($servicio->proveedor->checkinn)) : '10:00';
            $this->checkout_hotel = $servicio->proveedor->checkout ? date("H:i",strtotime($servicio->proveedor->checkout)) : '12:00';
            foreach($servicio->itinerarios as $i => $itinerario)
            {
                $this->incluyehotel[$i] = $itinerario->incluyes->pluck('id');
                $this->noincluyehotel[$i] = $itinerario->noincluyes->pluck('id');
                $this->emit('EncontrarHotel',$this->hotel_id,$this->incluyehotel[$i],$this->noincluyehotel[$i]);  
            }
        }
    }

    public function agregarHotel()
    {
        $this->monedapago = $this->moneda_idhotel;
        $this->validate([
            'hotel_id' => 'required|exists:servicios,id',
            'paxhotel' => 'required',
            'cantidadHabitaciones' => 'required',
            'fecha_viajehotel' => 'required|date',
            'fecha_viajehotelfin' => 'required|date',
            'checkinn_hotel' => 'required',
            'checkout_hotel' => 'required',
            'preciohotel' => 'required|min:'.$this->preciohotelmin.'|numeric',
            'moneda_idhotel' => 'required|exists:monedas,id',
        ]);
        $servicio = Servicio::find($this->hotel_id);
        $moneda = Moneda::find($this->moneda_idhotel);
        $fechaInicio = Carbon::createFromFormat('Y-m-d', $this->fecha_viajehotel);
        $fechaFin = Carbon::createFromFormat('Y-m-d', $this->fecha_viajehotelfin);
        $fechaHoraCheckinn = Carbon::createFromFormat('Y-m-d H:i', $this->fecha_viajehotel . ' ' . $this->checkinn_hotel);
        $fechaHoraCheckiout = Carbon::createFromFormat('Y-m-d H:i', $this->fecha_viajehotelfin . ' ' . $this->checkout_hotel);
        $this->cantidadHabitaciones = $fechaFin->diffInDays($fechaInicio);
        $nuevoHotel = [
            'detalle_id' => $this->detalleHotelId,
            'id' => $servicio->id,
            'servicio' => $servicio->proveedor?->nombre.' '.$servicio->proveedor?->ubicacion?->nombre.' '.$servicio->titulo,
            'pax' => $this->paxhotel,
            'fecha_viaje' => $fechaHoraCheckinn,
            'fecha_viajefin' => $fechaHoraCheckiout,
            'precio' => $this->preciohotel,
            'moneda_id' => $this->moneda_idhotel,
            'precio_id' => 1,
            'noches' => $this->cantidadHabitaciones,
            'moneda' => $moneda->abreviatura,
            'comentariodetalle' => $this->comentariodetallehotel,
            'adicional' => $this->adicionalHotel,
        ];
        $itinerarios = [];
        foreach($this->itinerarioshotel as $i => $itinerario){
            $incluyes=[];
            $itinerari = [
                'dia' => $i+1,
            ];
            foreach($this->incluyehotel[$i] as $id)
            {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $incluyes[] = $incluye;
            }
            $noincluyes=[];
            foreach($this->noincluyehotel[$i] as $id)
            {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $noincluyes[] = $incluye;
            }
        
            $itinerari['incluye'] = $incluyes;
            $itinerari['noincluye'] = $noincluyes;
            $itinerarios[] = $itinerari;
        }

        $nuevoHotel['itinerarios'] = $itinerarios;
    
        if($this->hotel_id_editar != '' ){
            $this->hotelesreserva[$this->hotel_id_editar] = $nuevoHotel;
        }else{
            $this->hotelesreserva[] = $nuevoHotel;
        }
        usort($this->hotelesreserva, function($a, $b) {
            return strtotime($a['fecha_viaje']) - strtotime($b['fecha_viaje']);
        });
        $this->totales();
        $this->emit('cerrarHotel');
    }

    public function reducirHotel($i)
    {
        unset($this->hotelesreserva[$i]);
        $this->hotelesreserva = array_values($this->hotelesreserva);
        $this->totales();
    }

    public function editarHotel($i)
    {
        $this->detalleHotelId = $this->hotelesreserva[$i]['detalle_id'];
        $this->hotel_id_editar = $i;
        $this->hotel_id= $this->hotelesreserva[$i]['id'];
        $this->paxhotel= $this->hotelesreserva[$i]['pax'];
        $this->cantidadHabitaciones = $this->hotelesreserva[$i]['noches'];
        $this->fecha_viajehotel= date("Y-m-d",strtotime($this->hotelesreserva[$i]['fecha_viaje']));
        $this->fecha_viajehotelfin= date("Y-m-d", strtotime($this->hotelesreserva[$i]['fecha_viajefin']));
        $this->checkinn_hotel= date("H:i",strtotime($this->hotelesreserva[$i]['fecha_viaje']));
        $this->checkout_hotel= date("H:i",strtotime($this->hotelesreserva[$i]['fecha_viajefin']));
        $this->preciohotel= $this->hotelesreserva[$i]['precio'];
        $this->moneda_idhotel= $this->hotelesreserva[$i]['moneda_id'];
        $this->itinerarioshotel = $this->hotelesreserva[$i]['itinerarios'];
        $this->adicionalHotel = $this->hotelesreserva[$i]['adicional'];
        $servicio=Servicio::find($this->hotelesreserva[$i]['id']);
        $precio = $servicio->precios()->wherePivot('moneda_id', $this->moneda_idhotel)->first();
        $this->preciohotelmin = $precio ? $precio->pivot?->precio_minimo : 0;
        $this->comentariodetallehotel= $this->hotelesreserva[$i]['comentariodetalle'];
        foreach($this->itinerarioshotel as $i => $itinerario)
        {
            $this->incluyehotel[$i]= collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluyehotel[$i]= collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarHotel',$this->hotel_id,$this->incluyehotel[$i],$this->noincluyehotel[$i]);
        }
        
    }

    public function duplicarHotel($i)
    {    
        $this->detalleHotelId = null;
        $this->hotel_id= $this->hotelesreserva[$i]['id'];
        $this->paxhotel= $this->hotelesreserva[$i]['pax'];
        $this->cantidadHabitaciones = $this->hotelesreserva[$i]['noches'];
        $this->fecha_viajehotel= $this->hotelesreserva[$i]['fecha_viaje'];
        $this->fecha_viajehotelfin= $this->hotelesreserva[$i]['fecha_viajefin'];
        $this->preciohotel= $this->hotelesreserva[$i]['precio'];
        $this->moneda_idhotel= $this->hotelesreserva[$i]['moneda_id'];
        $this->itinerarioshotel = $this->hotelesreserva[$i]['itinerarios'];
        $this->adicionalHotel = $this->hotelesreserva[$i]['adicional'];
        $this->comentariodetallehotel= $this->hotelesreserva[$i]['comentariodetalle'];
        foreach($this->itinerarioshotel as $i => $itinerario)
        {
            $this->incluyehotel[$i]= collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluyehotel[$i]= collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarHotel',$this->hotel_id,$this->incluyehotel[$i],$this->noincluyehotel[$i]);
        }
    }

    public function abrirVuelo()
    {
        $this->detalleVueloId = null;
        $this->vuelo_id_editar = null;
        $this->vuelo_id= null;
        $this->paxvuelo= $this->pax;
        $this->fecha_viajevuelo= '';
        $this->fecha_viajevuelofin= '';
        $this->preciovuelo= '';
        $this->moneda_idvuelo= '';
        $this->incluyevuelo= [];
        $this->noincluyevuelo= [];
        $this->itinerariosvuelo = [];
        $this->descripcionvuelo= '';
        $this->comentariodetallevuelo= '';
        $this->tipovuelo= 1;
        $this->equipajevuelo= 0;
        $this->desde= null;
        $this->hasta= null;
        $this->desderetorno= null;
        $this->hastaretorno= null;
        $this->emit('EncontrarVuelo',null,null,null,$this->desde,$this->hasta,$this->desderetorno,$this->hastaretorno);
    }

    public function updatedvueloId($id)
    {
        $servicio=Servicio::find($id);
        if($servicio == ""){
            $this->vuelo_id = null;
            $this->incluyevuelo = null;
            $this->noincluyevuelo = null;
        }else{
            $this->vuelo_id = $servicio->id;
            $this->itinerariosvuelo = $servicio->itinerarios;
            foreach($servicio->itinerarios as $i => $itinerario)
            {
                $this->incluyevuelo[$i] = $itinerario->incluyes->pluck('id');
                $this->noincluyevuelo[$i] = $itinerario->noincluyes->pluck('id');
                $this->emit('EncontrarVuelo',$this->vuelo_id,$this->incluyevuelo[$i],$this->noincluyevuelo[$i],$this->desde,$this->hasta,$this->desderetorno,$this->hastaretorno);
            }
        }
    }

    public function agregarVuelo()
    {
        $this->monedapago = $this->moneda_idvuelo;
        $validacionfechafin = $this->tipovuelo == 1 ? 'required|date' : 'nullable|date';
        $this->validate([
            'vuelo_id' => 'required|exists:servicios,id',
            'paxvuelo' => 'required',
            'fecha_viajevuelo' => 'required|date',
            'fecha_viajevuelofin' => $validacionfechafin,
            'preciovuelo' => 'required',
            'moneda_idvuelo' => 'required|exists:monedas,id',
        ]);
        $servicio = Servicio::find($this->vuelo_id);
        $moneda = Moneda::find($this->moneda_idvuelo);
        $nuevoVuelo = [
            'detalle_id' => $this->detalleVueloId,
            'id' => $servicio->id,
            'servicio' => $servicio->titulo,
            'pax' => $this->paxvuelo,
            'fecha_viaje' => $this->fecha_viajevuelo,
            'fecha_viajefin' => $this->fecha_viajevuelofin,
            'precio' => $this->preciovuelo,
            'moneda_id' => $this->moneda_idvuelo,
            'precio_id' => 1,
            'moneda' => $moneda->abreviatura,
            'comentariodetalle' => $this->comentariodetallevuelo,
            'descripcion' => $this->descripcionvuelo,
            'tipo' => $this->tipovuelo,
            'equipajevuelo' => $this->equipajevuelo,
            'desde' => $this->desde,
            'hasta' => $this->hasta,
            'desderetorno' => $this->desderetorno,
            'hastaretorno' => $this->hastaretorno,
        ];
        $itinerarios = [];
        foreach($this->itinerariosvuelo as $i => $itinerario){
            $incluyes=[];
            $itinerari = [
                'dia' => $i+1,
            ];
            foreach($this->incluyevuelo[$i] as $id)
            {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $incluyes[] = $incluye;
            }
            $noincluyes=[];
            foreach($this->noincluyevuelo[$i] as $id)
            {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $noincluyes[] = $incluye;
            }
        
            $itinerari['incluye'] = $incluyes;
            $itinerari['noincluye'] = $noincluyes;
            $itinerarios[] = $itinerari;
        }
        
        $nuevoVuelo['itinerarios'] = $itinerarios;
    
        if($this->vuelo_id_editar != '' ){
            $this->vuelosreserva[$this->vuelo_id_editar] = $nuevoVuelo;
        }else{
            $this->vuelosreserva[] = $nuevoVuelo;
        }
        usort($this->vuelosreserva, function($a, $b) {
            return strtotime($a['fecha_viaje']) - strtotime($b['fecha_viaje']);
        });
        $this->totales();
        $this->emit('cerrarVuelo');
    }

    public function reducirVuelo($i)
    {
        unset($this->vuelosreserva[$i]);
        $this->vuelosreserva = array_values($this->vuelosreserva);
        $this->totales();
    }

    public function editarVuelo($i)
    {
        $this->detalleVueloId = $this->vuelosreserva[$i]['detalle_id'];
        $this->vuelo_id_editar = $i;
        $this->vuelo_id= $this->vuelosreserva[$i]['id'];
        $this->paxvuelo= $this->vuelosreserva[$i]['pax'];
        $this->fecha_viajevuelo= $this->vuelosreserva[$i]['fecha_viaje'];
        $this->fecha_viajevuelofin= $this->vuelosreserva[$i]['fecha_viajefin'];
        $this->preciovuelo= $this->vuelosreserva[$i]['precio'];
        $this->moneda_idvuelo= $this->vuelosreserva[$i]['moneda_id'];
        $this->itinerariosvuelo = $this->vuelosreserva[$i]['itinerarios'];
        $this->comentariodetallevuelo= $this->vuelosreserva[$i]['comentariodetalle'];
        $this->descripcionvuelo= $this->vuelosreserva[$i]['descripcion'];
        $this->tipovuelo= $this->vuelosreserva[$i]['tipo'];
        $this->equipajevuelo= $this->vuelosreserva[$i]['equipajevuelo'];
        $this->desde= $this->vuelosreserva[$i]['desde'];
        $this->hasta= $this->vuelosreserva[$i]['hasta'];
        $this->desderetorno= $this->vuelosreserva[$i]['desderetorno'];
        $this->hastaretorno= $this->vuelosreserva[$i]['hastaretorno'];
        foreach($this->itinerariosvuelo as $i => $itinerario)
        {
            $this->incluyevuelo[$i]= collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluyevuelo[$i]= collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarVuelo',$this->vuelo_id,$this->incluyevuelo[$i],$this->noincluyevuelo[$i],$this->desde,$this->hasta,$this->desderetorno,$this->hastaretorno);
        }
    }

    public function totales()
    {
        $totalsoles = 0;
        $totaldolares = 0;
        foreach($this->serviciosreserva as $reserva)
        {
            if($reserva['moneda_id']==1)
            {
                $totalsoles += $reserva['precio'] * $reserva['pax'];
            }else{
                $totaldolares += $reserva['precio'] * $reserva['pax'];
            }
        }
        foreach($this->hotelesreserva as $reserva)
        {
            if($reserva['moneda_id']==1)
            {
                $totalsoles += $reserva['precio'] * $reserva['pax'] * $reserva['noches'] + $reserva['adicional'];
            }else{
                $totaldolares += $reserva['precio'] * $reserva['pax'] * $reserva['noches'] + $reserva['adicional'];
            }
        }
        foreach($this->vuelosreserva as $reserva)
        {
            if($reserva['moneda_id']==1)
            {
                $totalsoles += $reserva['precio'] * $reserva['pax'] + $reserva['equipajevuelo'];
            }else{
                $totaldolares += $reserva['precio'] * $reserva['pax'] + $reserva['equipajevuelo'];
            }
        }
        $this->totalsoles = $totalsoles;
        $this->totaldolares = $totaldolares;
        $this->saldosoles = $totalsoles - $this->pagosoles;
        $this->saldodolares = $totaldolares - $this->pagodolares ;
    }

    public function updatingmonedapago($id)
    {
        $data=Medio::select('id','nombre as text')->where('moneda_id',$id)->where('estado',1)->get();
        $data = $data->toArray();
        array_unshift($data, ['id' => '', 'text' => 'Seleccione']);
        if($data){
            $this->emit('LlenarMedio',null,$data);
        }
    }

    public function updatedmontopago()
    {
        $data=Medio::select('id','nombre as text')->where('moneda_id',$this->monedapago)->where('estado',1)->get();
        $data = $data->toArray();
        array_unshift($data, ['id' => '', 'text' => 'Seleccione']);
        if($data){
            $this->emit('LlenarMedio',null,$data);
        }
    }

    public function agregarPago()
    {
        $acuenta = 0;
        foreach($this->pagosreserva as $pago)
        {
            if($pago['moneda_id']==$this->monedapago)
            {
                $acuenta += $pago['monto'];
            }
        }

        if($this->monedapago == 1){
            $saldo = $this->totalsoles - $acuenta;
        }else{
            $saldo = $this->totaldolares - $acuenta;
        }
        
        $this->validate([
            'monedapago' => 'required|exists:monedas,id',
            'montopago' => 'required|numeric|min:1|max:'.$saldo,
            'num_operacion' => 'nullable|max:100',
            'medio_pago' => 'required|exists:medios,id',
            'comentariopago' => 'nullable',
        ]);
        $medio = Medio::find($this->medio_pago);
        $moneda = Moneda::find($this->monedapago);
        $nuevoPago = [
            'pago_id' => $this->pagoId,
            'id' => $medio->id,
            'medio' => $medio->nombre,
            'monto' => $this->montopago,
            'num_operacion' => $this->num_operacion,
            'moneda_id' => $moneda->id,
            'moneda' => $moneda->abreviatura,
            'comentariopago' => $this->comentariopago,
        ];

        $this->pagosreserva[] = $nuevoPago;
        $this->pagoId = null;
        $this->monedapago= null;
        $this->montopago= 0;
        $this->num_operacion= '';
        $this->medio_pago= '';
        $this->moneda_id= null;
        $this->comentariopago= '';
        $this->emit('LlenarMedio',null,[]);
        $this->acuentas();
    }

    public function reducirPago($i)
    {
        unset($this->pagosreserva[$i]);
        $this->pagosreserva = array_values($this->pagosreserva);
        $this->acuentas();
    }

    public function editarPago($i)
    {
        $this->pagoId = $this->pagosreserva[$i]['pago_id'];
        $this->monedapago= $this->pagosreserva[$i]['moneda_id'];
        $this->montopago= $this->pagosreserva[$i]['monto'];
        $this->num_operacion= $this->pagosreserva[$i]['num_operacion'];
        $this->medio_pago= $this->pagosreserva[$i]['id'];
        $this->comentariopago= $this->pagosreserva[$i]['comentariopago'];
        $data=Medio::select('id','nombre as text')->where('moneda_id',$this->pagosreserva[$i]['moneda_id'])->where('estado',1)->get();
        $data = $data->toArray();
        array_unshift($data, ['id' => '', 'text' => 'Seleccione']);
        $this->emit('LlenarMedio',$this->medio_pago,$data);
        unset($this->pagosreserva[$i]);
        $this->acuentas();
    }

    public function acuentas()
    {
        $acuentasoles = 0;
        $acuentadolares = 0;
        foreach($this->pagosreserva as $pago)
        {
            if($pago['moneda_id']==1)
            {
                $acuentasoles += $pago['monto'];
            }else{
                $acuentadolares += $pago['monto'];
            }
        }
        $this->pagosoles = $acuentasoles;
        $this->pagodolares = $acuentadolares;
        $this->saldosoles = $this->totalsoles - $acuentasoles;
        $this->saldodolares = $this->totaldolares - $acuentadolares;
    }

    public function agregarDescuento()
    {
        $cupon = Cupon::where('cupon',$this->codigodescuento)->where('estado',1)->first();
        if($cupon){
            if($this->totalsoles>0){
                if($cupon->tipo==1){
                    $this->descuentosoles = $cupon->descuento;
                    $this->totalsoles =  $this->totalsoles - $cupon->descuento;
                }else{
                    $this->descuentosoles = ($this->totalsoles * $cupon->descuento) / 100;
                    $this->totalsoles =  $this->totalsoles - $this->descuentosoles;
                }
                $this->cuponid = $cupon->id;
            }

            if($this->totaldolares>0){
                if($cupon->tipo==1){
                    $this->descuentodolares = $cupon->descuento;
                    $this->totaldolares =  $this->totaldolares - $cupon->descuento;
                }else{
                    $this->descuentodolares = ($this->totaldolares * $cupon->descuento) / 100;
                    $this->totaldolares =  $this->totaldolares - $this->descuentodolares;
                }
                $this->cuponid = $cupon->id;
            }
            $this->acuentas();
        }else{
            $this->cuponid = null;
            $this->totales();
            $this->acuentas();
            session()->flash('success', 'Cupon no activo');
        }
    }

    public function agregarCuotas()
    {
        $this->validate([
            'cuotas' => 'required|min:1',
        ]);

        $moneda = $this->totalsoles > 0 ? 1 : 2;

        for($i=0;$i<$this->cuotas;$i++){
            $this->fechacuota[$i] = isset($this->fechacuota[$i]) ? $this->fechacuota[$i] : "";
            $this->monedacuota[$i] = isset($this->monedacuota[$i]) ? $this->monedacuota[$i] : $moneda;
            $this->montocuota[$i] = isset($this->montocuota[$i]) ? $this->montocuota[$i] : 0;
            $this->comentariocuota[$i] = isset($this->comentariocuota[$i]) ? $this->comentariocuota[$i] : '';
        }

        // $cociente = intdiv($this->cuotas,2);
        // $residuo = $this->cuotas % 2;

        // if($this->saldosoles > 0 && $this->saldodolares > 0){
        //     if($residuo != 0){
        //         for($i=0;$i<$cociente+1;$i++)
        //         {
        //             $this->fechacuota[$i] = '';
        //             $this->monedacuota[$i] = 1;
        //             $this->montocuota[$i] = $this->saldosoles / ($cociente+1);
        //         }
        //         for($j=0;$j<$cociente;$j++)
        //         {
        //             $this->fechacuota[$i] = '';
        //             $this->monedacuota[$i] = 2;
        //             $this->montocuota[$i] = $this->saldodolares / $cociente;
        //             $i++;
        //         }
        //     }else{
        //         for($i=0;$i<$cociente;$i++)
        //         {
        //             $this->fechacuota[$i] = '';
        //             $this->monedacuota[$i] = 1;
        //             $this->montocuota[$i] = $this->saldosoles / $cociente;
        //         }
        //         for($j=0;$j<$cociente;$j++)
        //         {
        //             $this->fechacuota[$i] = '';
        //             $this->monedacuota[$i] = 2;
        //             $this->montocuota[$i] = $this->saldodolares / $cociente;
        //             $i++;
        //         }
        //     }
        // }else{
        //     if($this->saldosoles > 0 ){
        //         for($i=0;$i<$this->cuotas;$i++)
        //         {
        //             $this->fechacuota[$i] = '';
        //             $this->monedacuota[$i] = 1;
        //             $this->montocuota[$i] = $this->saldosoles / $this->cuotas;
        //         }
        //     }
        //     if($this->saldodolares > 0 ){
        //         for($i=0;$i<$this->cuotas;$i++)
        //         {
        //             $this->fechacuota[$i] = '';
        //             $this->monedacuota[$i] = 2;
        //             $this->montocuota[$i] = $this->saldodolares / $this->cuotas;
        //         }
        //     }
        // }
        
    }

    public function cambiarTipoMoneda($i)
    {
        $this->monedacuota[$i] = $this->monedacuota[$i] ==1 ? 2:1;
    }

    public function registrarReserva()
    {
        if ($this->isSaving) {
            return; // Prevenir que se ejecute si ya está en proceso
        }

        $this->isSaving = true;

        for($i=0;$i<$this->cuotas;$i++){
            $this->validate([
                'fechacuota.'.$i => 'required',
                'montocuota.'.$i => 'required',
            ]);
        }

        if($this->cuotas > 0)
        {
            $saldosoles=0;
            $saldodolares=0;
            for($i=0; $i < $this->cuotas; $i++){
                if($this->monedacuota[$i] == 1)
                {
                    $saldosoles += $this->montocuota[$i];
                }else{
                    $saldodolares += $this->montocuota[$i];
                }
            }        
            if($saldosoles == $this->saldosoles && $saldodolares == $this->saldodolares)
            {

            }else{
                session()->flash('success', 'Las cuotas deben sumar igual al saldo.');
            }
        }
        try
        {
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');
            $confirmadoAnterior=0;
            $confirmado = ($this->pagosoles > 0 || $this->pagodolares > 0) ? 1 : 0;
            $this->fechaReserva = Carbon::createFromFormat('Y-m-d', $this->fechaReserva);
            
            $historiaService = app(HistoriaService::class);
            
            $reserva = Reserva::find($this->reserva->id);
            if (!$reserva) {
                $reserva = Reserva::create([
                    'user_id' => \Auth::user()->id,
                    'fecha' => $this->fechaReserva->setTimeFrom(Carbon::now()),
                    'confirmado' => $confirmado,
                ]);
            } else {
                if($this->vendedorId != $reserva->user_id){
                    $vendedor = User::find($this->vendedorId);
                    $historiaService->addChanges('counter',$reserva->user->nombre,$vendedor->nombre);
                }

                $reserva->user_id = $this->vendedorId ? $this->vendedorId : $reserva->user_id;
                $reserva->confirmado = $confirmado;
                $reserva->fecha = $this->fechaReserva->setTimeFrom(Carbon::now());
                $reserva->save();
            }

            if($this->reserva->confirmado != 0){
                $confirmadoAnterior=1;
            }else{
                if($confirmado == 1){
                    $reserva->fecha = $mytime->toDateTimeString();
                    $reserva->save();
                }
            }

            foreach ($reserva->totales as $total) {
                $total->estado = 0;
                $total->save();
            }
            if($this->totalsoles > 0){
                $totalComparar = Total::where('reserva_id',$reserva->id)->where('moneda_id',1)->first();
                if($totalComparar){
                    if($this->pagosoles != $totalComparar->acuenta){
                        $historiaService->addChanges('total_soles_acuenta',$this->pagosoles,$totalComparar->acuenta);
                    }
                    if($this->saldosoles != $totalComparar->saldo){
                        $historiaService->addChanges('total_soles_saldo',$this->saldosoles,$totalComparar->saldo);
                    }
                    if($this->totalsoles != $totalComparar->total){
                        $historiaService->addChanges('total_soles_total',$this->totalsoles,$totalComparar->total);
                    }
                }
                else{
                    $totalComparar = new Total();
                }
                $totalComparar->reserva_id = $reserva->id;
                $totalComparar->moneda_id = 1;
                $totalComparar->cupon_id = $this->cuponid;
                $totalComparar->acuenta = $this->pagosoles;
                $totalComparar->saldo = $this->saldosoles;
                $totalComparar->total = $this->totalsoles;
                $totalComparar->descuento = $this->descuentosoles;
                $totalComparar->estado = 1;
                $totalComparar->save();
            }


            if($this->totaldolares > 0){
                $totalComparar = Total::where('reserva_id',$reserva->id)->where('moneda_id',2)->first();
                if($totalComparar){
                    if($this->pagodolares != $totalComparar->acuenta){
                        $historiaService->addChanges('total_dolares_acuenta',$this->pagodolares,$totalComparar->acuenta);
                    }
                    if($this->saldodolares != $totalComparar->saldo){
                        $historiaService->addChanges('total_dolares_saldo',$this->saldodolares,$totalComparar->saldo);
                    }
                    if($this->totaldolares != $totalComparar->total){
                        $historiaService->addChanges('total_dolares_total',$this->totaldolares,$totalComparar->total);
                    }
                }else{
                    $totalComparar = new Total();
                    $totalComparar->reserva_id = $reserva->id;
                    $totalComparar->moneda_id = 2;
                }
                $totalComparar->cupon_id = $this->cuponid;
                $totalComparar->acuenta = $this->pagodolares;
                $totalComparar->saldo = $this->saldodolares;
                $totalComparar->total = $this->totaldolares;
                $totalComparar->descuento = $this->descuentodolares;
                $totalComparar->estado = 1;
                $totalComparar->save();
                
            }
            $totaleseliminar = Total::where('reserva_id',$reserva->id)->where('estado',0)->delete();

            $pasajeroIds = array_column($this->pasajerosreserva, 'id');

            // Sincronizar la relación de pasajeros con los IDs proporcionados
            $reserva->pasajeros()->sync($pasajeroIds);

            foreach ($reserva->detallestours as $detalle) {
                $detalle->estado = 0;
                $detalle->save();
            }
            
            foreach ($this->serviciosreserva as $i => $servicio) {
                $detalle = DetalleReserva::find($servicio['detalle_id']);
                if ($detalle) {
                    // Comparar y agregar cambios usando HistoriaService
                    if ($servicio['id'] != $detalle->servicio_id) {
                        $historiaService->addChanges('servicios' . $i . 'servicio', $servicio['id'], $detalle->servicio_id);
                    }
                    if ($servicio['moneda_id'] != $detalle->moneda_id) {
                        $historiaService->addChanges('servicios' . $i . 'moneda', $servicio['moneda_id'], $detalle->moneda_id);
                    }
                    if ($servicio['fecha_viaje'] != date('Y-m-d',strtotime( $detalle->fecha_viaje))) {
                        $historiaService->addChanges('servicios' . $i . 'fecha_viaje', $servicio['fecha_viaje'], date('Y-m-d',strtotime( $detalle->fecha_viaje)));
                    }
                    if ($servicio['pax'] != $detalle->pax) {
                        $historiaService->addChanges('servicios' . $i . 'pax', $servicio['pax'], $detalle->pax);
                    }
                    if ($servicio['precio'] != $detalle->precio) {
                        $historiaService->addChanges('servicios' . $i . 'precio', $servicio['precio'], $detalle->precio);
                    }
                    if ($servicio['comentariodetalle'] != $detalle->comentarios) {
                        $historiaService->addChanges('servicios' . $i . 'comentarios', $servicio['comentariodetalle'], $detalle->comentarios);
                    }
                } else {
                    $detalle = new DetalleReserva();
                }
            
                // Actualizar o asignar los nuevos valores al detalle
                $detalle->reserva_id = $reserva->id;
                $detalle->servicio_id = $servicio['id'];
                $detalle->moneda_id = $servicio['moneda_id'];
                $detalle->fecha_viaje = $servicio['fecha_viaje'] != '' ? $servicio['fecha_viaje'] : null;
                $detalle->pax = $servicio['pax'];
                $detalle->precio = $servicio['precio'];
                $detalle->tipo = $servicio['tipo'] ?? 0;
                $detalle->precio_id = $servicio['precio_id'];
                $detalle->comentarios = $servicio['comentariodetalle'];
                $detalle->orden = $i;
                $detalle->estado = 1;  // Marcar como activo
                $detalle->save();
            
                // Procesar los itinerarios
                foreach ($servicio['itinerarios'] as $itinerario) {
                    $ite = ItinerarioReserva::where('detalle_reserva_id', $detalle->id)
                        ->where('dia', $itinerario['dia'])
                        ->first();
            
                    if (!$ite) {
                        $ite = new ItinerarioReserva();
                        $ite->detalle_reserva_id = $detalle->id;
                        $ite->dia = $itinerario['dia'];
                    }
                    $ite->save();
            
                    // Comparar y sincronizar `incluyes` y `noincluyes`
                    $incluyeIds = array_column($itinerario['incluye'], 'id');
                    $noincluyeIds = array_column($itinerario['noincluye'], 'id');
            
                    $oldIncluyeIds = $ite->incluyes->pluck('id')->toArray();
                    $oldNoIncluyeIds = $ite->noincluyes->pluck('id')->toArray();
            
                    if($this->reserva->id){
                        // Comparar y agregar cambios para `incluyes`
                        if (array_diff($incluyeIds, $oldIncluyeIds) || array_diff($oldIncluyeIds, $incluyeIds)) {
                            $historiaService->addChanges('servicio_detalle_' . $i . '_incluyes', $incluyeIds, $oldIncluyeIds);
                        }
                
                        // Comparar y agregar cambios para `noincluyes`
                        if (array_diff($noincluyeIds, $oldNoIncluyeIds) || array_diff($oldNoIncluyeIds, $noincluyeIds)) {
                            $historiaService->addChanges('servicio_detalle_' . $i . '_noincluyes', $noincluyeIds, $oldNoIncluyeIds);
                        }
                    }
            
                    // Sincronizar relaciones
                    $ite->incluyes()->sync($incluyeIds);
                    $ite->noincluyes()->sync($noincluyeIds);
                }
            }

            foreach ($reserva->detalleshoteles as $detalle) {
                $detalle->estado = 0;
                $detalle->save();
            }

            foreach($this->hotelesreserva as $i => $servicio){
                $detalle = DetalleReserva::find($servicio['detalle_id']);
                if ($detalle) {
                    // Comparar y agregar cambios usando HistoriaService
                    if ($servicio['id'] != $detalle->servicio_id) {
                        $historiaService->addChanges('hoteles' . $i . 'servicio', $servicio['id'], $detalle->servicio_id);
                    }
                    if ($servicio['moneda_id'] != $detalle->moneda_id) {
                        $historiaService->addChanges('hoteles' . $i . 'moneda', $servicio['moneda_id'], $detalle->moneda_id);
                    }
                    if ($servicio['fecha_viaje'] != $detalle->fecha_viaje) {
                        $historiaService->addChanges('hoteles' . $i . 'check inn', $servicio['fecha_viaje'], $detalle->fecha_viaje);
                    }
                    if ($servicio['fecha_viajefin'] != $detalle->fecha_viajefin) {
                        $historiaService->addChanges('hoteles' . $i . 'check out', $servicio['fecha_viajefin'], $detalle->fecha_viajefin);
                    }
                    if ($servicio['pax'] != $detalle->pax) {
                        $historiaService->addChanges('hoteles' . $i . 'cantidad', $servicio['pax'], $detalle->pax);
                    }
                    if ($servicio['noches'] != $detalle->equipaje) {
                        $historiaService->addChanges('hoteles' . $i . 'noches', $servicio['noches'], $detalle->equipaje);
                    }
                    if ($servicio['precio'] != $detalle->precio) {
                        $historiaService->addChanges('hoteles' . $i . 'precio', $servicio['precio'], $detalle->precio);
                    }
                    if ($servicio['comentariodetalle'] != $detalle->comentarios) {
                        $historiaService->addChanges('hoteles' . $i . 'comentarios', $servicio['comentariodetalle'], $detalle->comentarios);
                    }
                } else {
                    $detalle = new DetalleReserva();
                }
                
                $detalle->reserva_id = $reserva->id;
                $detalle->servicio_id = $servicio['id'];
                $detalle->moneda_id = $servicio['moneda_id'];
                $detalle->fecha_viaje = $servicio['fecha_viaje'] ? Carbon::parse($servicio['fecha_viaje'])->setTimezone('America/Lima')->format('Y-m-d H:i:s') : null;
                $detalle->fecha_viajefin = $servicio['fecha_viajefin'] ? Carbon::parse($servicio['fecha_viajefin'])->setTimezone('America/Lima')->format('Y-m-d H:i:s') : null;
                $detalle->pax = $servicio['pax'];
                $detalle->equipaje = $servicio['noches'];
                $detalle->precio = $servicio['precio'];
                $detalle->tipo = $servicio['tipo'] ?? 0;
                $detalle->precio_id = $servicio['precio_id'];
                $detalle->adicional = $servicio['adicional'] ?? 0;
                $detalle->comentarios = $servicio['comentariodetalle'];
                $detalle->estado = 1;  // Marcar como activo
                $detalle->save();
    
                foreach ($servicio['itinerarios'] as $itinerario) {
                    $ite = ItinerarioReserva::where('detalle_reserva_id', $detalle->id)
                        ->where('dia', $itinerario['dia'])
                        ->first();
            
                    if (!$ite) {
                        $ite = new ItinerarioReserva();
                        $ite->detalle_reserva_id = $detalle->id;
                        $ite->dia = $itinerario['dia'];
                    }
                    $ite->save();
                
                    // Comparar y sincronizar `incluyes` y `noincluyes`
                    $incluyeIds = array_column($itinerario['incluye'], 'id');
                    $noincluyeIds = array_column($itinerario['noincluye'], 'id');
            
                    $oldIncluyeIds = $ite->incluyes->pluck('id')->toArray();
                    $oldNoIncluyeIds = $ite->noincluyes->pluck('id')->toArray();
            
                    if($this->reserva->id){
                        // Comparar y agregar cambios para `incluyes`
                        if (array_diff($incluyeIds, $oldIncluyeIds) || array_diff($oldIncluyeIds, $incluyeIds)) {
                            $historiaService->addChanges('hotel_detalle_' . $i . '_incluyes', $incluyeIds, $oldIncluyeIds);
                        }
                
                        // Comparar y agregar cambios para `noincluyes`
                        if (array_diff($noincluyeIds, $oldNoIncluyeIds) || array_diff($oldNoIncluyeIds, $noincluyeIds)) {
                            $historiaService->addChanges('hotel_detalle_' . $i . '_noincluyes', $noincluyeIds, $oldNoIncluyeIds);
                        }
                    }
            
                    // Sincronizar relaciones
                    $ite->incluyes()->sync($incluyeIds);
                    $ite->noincluyes()->sync($noincluyeIds);
                }
            }

            foreach ($reserva->detallesvuelos as $detalle) {
                $detalle->estado = 0;
                $detalle->save();
            }

            foreach($this->vuelosreserva as $i => $servicio){
                $detalle = DetalleReserva::find($servicio['detalle_id']);
                if ($detalle) {
                    // Comparar y agregar cambios usando HistoriaService
                    if ($servicio['id'] != $detalle->servicio_id) {
                        $historiaService->addChanges('vuelos' . $i . 'vuelo', $servicio['id'], $detalle->servicio_id);
                    }
                    if ($servicio['moneda_id'] != $detalle->moneda_id) {
                        $historiaService->addChanges('vuelos' . $i . 'moneda', $servicio['moneda_id'], $detalle->moneda_id);
                    }
                    if ($servicio['fecha_viaje'] != $detalle->fecha_viaje) {
                        $historiaService->addChanges('vuelos' . $i . 'fecha ida', $servicio['fecha_viaje'], $detalle->fecha_viaje);
                    }
                    if ($servicio['fecha_viajefin'] != $detalle->fecha_viajefin) {
                        $historiaService->addChanges('vuelos' . $i . 'fecha vuelta', $servicio['fecha_viajefin'], $detalle->fecha_viajefin);
                    }
                    if ($servicio['pax'] != $detalle->pax) {
                        $historiaService->addChanges('vuelos' . $i . 'pax', $servicio['pax'], $detalle->pax);
                    }
                    if ($servicio['precio'] != $detalle->precio) {
                        $historiaService->addChanges('vuelos' . $i . 'precio', $servicio['precio'], $detalle->precio);
                    }
                    if ($servicio['comentariodetalle'] != $detalle->comentarios) {
                        $historiaService->addChanges('vuelos' . $i . 'comentarios', $servicio['comentariodetalle'], $detalle->comentarios);
                    }
                } else {
                    $detalle = new DetalleReserva();
                }
                $detalle->reserva_id = $reserva->id;
                $detalle->servicio_id = $servicio['id'];
                $detalle->moneda_id = $servicio['moneda_id'];
                $detalle->fecha_viaje = $servicio['fecha_viaje'] != '' ? $servicio['fecha_viaje'] : null;
                $detalle->fecha_viajefin = $servicio['fecha_viajefin'] ? $servicio['fecha_viajefin']: null;
                $detalle->pax = $servicio['pax'];
                $detalle->precio = $servicio['precio'];
                $detalle->tipo = $servicio['tipo'] ?? 0;
                $detalle->precio_id = $servicio['precio_id'];
                $detalle->comentarios = $servicio['comentariodetalle'];
                $detalle->descripcion = $servicio['tipo'] ? 'IDA ('.$servicio['desde'].'/'.$servicio['hasta'].') - VUELTA ('.$servicio['desderetorno'].'/'.$servicio['hastaretorno'].') ': 'IDA ('.$servicio['desde'].'/'.$servicio['hasta'].') ';
                $detalle->equipaje = $servicio['equipajevuelo'] ?? 0;
                $detalle->estado = 1;  // Marcar como activo
                $detalle->save();

                foreach ($servicio['itinerarios'] as $itinerario) {
                    $ite = ItinerarioReserva::where('detalle_reserva_id', $detalle->id)
                        ->where('dia', $itinerario['dia'])
                        ->first();
            
                    if (!$ite) {
                        $ite = new ItinerarioReserva();
                        $ite->detalle_reserva_id = $detalle->id;
                        $ite->dia = $itinerario['dia'];
                    }
                    $ite->save();
                
                    // Comparar y sincronizar `incluyes` y `noincluyes`
                    $incluyeIds = array_column($itinerario['incluye'], 'id');
                    $noincluyeIds = array_column($itinerario['noincluye'], 'id');
            
                    $oldIncluyeIds = $ite->incluyes->pluck('id')->toArray();
                    $oldNoIncluyeIds = $ite->noincluyes->pluck('id')->toArray();
            
                    if($this->reserva->id){
                        // Comparar y agregar cambios para `incluyes`
                        if (array_diff($incluyeIds, $oldIncluyeIds) || array_diff($oldIncluyeIds, $incluyeIds)) {
                            $historiaService->addChanges('vuelo_detalle_' . $i . '_incluyes', $incluyeIds, $oldIncluyeIds);
                        }
                
                        // Comparar y agregar cambios para `noincluyes`
                        if (array_diff($noincluyeIds, $oldNoIncluyeIds) || array_diff($oldNoIncluyeIds, $noincluyeIds)) {
                            $historiaService->addChanges('vuelo_detalle_' . $i . '_noincluyes', $noincluyeIds, $oldNoIncluyeIds);
                        }
                    }
            
                    // Sincronizar relaciones
                    $ite->incluyes()->sync($incluyeIds);
                    $ite->noincluyes()->sync($noincluyeIds);
                }
            }

            $detalleseliminar = DetalleReserva::where('reserva_id',$reserva->id)->where('estado',0)->get();
            foreach($detalleseliminar as $detalle)
            {
                foreach($detalle->itinerarios as $itinerario){
                    $itinerario->incluyes()->detach();
                    $itinerario->noincluyes()->detach();
                    $itinerario->delete();
                }
                $detalle->delete();
            }

            foreach ($reserva->pagos as $pago) {
                $pago->estado = 0;
                $pago->save();
            }

            foreach($this->pagosreserva as $pagover){
                $medio = Medio::find($pagover['id']);
                $monto_porcentaje = ($medio->porcentaje * $pagover['monto'])/100;
                $pago = Pago::find($pagover['pago_id']);
                if($pago){
                    if ($pagover['moneda_id'] != $pago->moneda_id) {
                        $historiaService->addChanges('pagos' . $i . 'moneda', $pagover['moneda_id'], $pago->moneda_id);
                    }
                    if ($pagover['id'] != $pago->medio_id) {
                        $historiaService->addChanges('pagos' . $i . 'medio', $pagover['id'], $pago->medio_id);
                    }
                    if ($pagover['monto'] != $pago->monto) {
                        $historiaService->addChanges('pagos' . $i . 'monto', $pagover['monto'], $pago->monto);
                    }
                    if ($pagover['num_operacion'] != $pago->num_operacion) {
                        $historiaService->addChanges('pagos' . $i . 'num_operacion', $pagover['num_operacion'], $pago->num_operacion);
                    }
                    if ($pagover['comentariopago'] != $pago->comentarios) {
                        $historiaService->addChanges('pagos' . $i . 'comentarios', $pagover['comentariopago'], $pago->comentarios);
                    }
                }else{
                    $pago = new Pago();
                    $pago->user_id = \Auth::user()->id;
                    $pago->fecha = $mytime->toDateTimeString();
                }
                $pago->moneda_id = $pagover['moneda_id'];
                $pago->medio_id = $pagover['id'];
                $pago->reserva_id = $reserva->id;
                $pago->monto = $pagover['monto'];
                $pago->monto_porcentaje =  $pagover['monto'] - $monto_porcentaje;
                $pago->num_operacion = $pagover['num_operacion'];
                $pago->comentarios = $pagover['comentariopago'];
                $pago->estado = 1;
                $pago->save();

                $reserva->estado = 1;
                $reserva->save();
            }

            $pagoseliminar = Pago::where('reserva_id',$reserva->id)->where('estado',0)->delete();

            if($this->cuponid)
            {
                $cupon=Cupon::find($this->cuponid);
                $cantidad = $cupon->cantidad +1;
                $cupon->cantidad = $cantidad;
                $cupon->montoSoles += $this->descuentosoles;
                $cupon->montoDolares += $this->descuentodolares;
                if($cantidad == $cupon->maximo){
                    $cupon->estado = 0;
                }
                $cupon->save();
            }

            $reserva->cuotas()->delete();
            
            if($this->cuotas > 0)
            {
                for($i = 0; $i < $this->cuotas; $i++){
                    $cuota = $reserva->cuotas()->create([
                        'nroCuota' => $i + 1,  
                        'fecha' => $this->fechacuota[$i],
                        'monto' => $this->montocuota[$i],
                        'moneda_id' => $this->monedacuota[$i],
                        'comentarios' => $this->comentariocuota[$i],
                    ]);
                }
            }
            
            // Guardar todos los cambios en un solo registro en la tabla historia
            $historiaService->saveChanges($reserva->id);

            $reserva = Reserva::find($reserva->id);
            $primeraFecha = $reserva->primerafecha();
            
            if ($reserva->saldoCero) {
                $reserva->update(['pagado' => 1]);
            } else {
                $reserva->update(['pagado' => 0]);
            }

            //actualizar tour con hotel
            foreach($reserva->detallestours as $detalleTour){
                foreach($reserva->detalleshoteles as $detalleHotel){
                    if(date("Y-m-d",strtotime($detalleTour->fecha_viaje)) >= date("Y-m-d",strtotime($detalleHotel->fecha_viaje)) && date("Y-m-d",strtotime($detalleTour->fecha_viaje)) <= date("Y-m-d",strtotime($detalleHotel->fecha_viajefin)) && $detalleTour->servicio->ubicacion_id == $detalleHotel->servicio->proveedor->ubicacion_id ){
                        $detalleTour->update(['proveedor_id' => $detalleHotel->servicio->proveedor_id,
                        'hotelJisa' => 1]);
                    }
                }
            }

            if($reserva->primerafecha()->fecha_viaje != null){
                if($this->reserva->id){
                    if($confirmadoAnterior == 0 ){
                        if ($primeraFecha) {
                            // Formatear la fecha para obtener la fecha completa (Y-m-d)
                            $fechaCompleta = Carbon::parse($primeraFecha->fecha_viaje)->format('Y-m-d');

                            // Buscar la última reserva confirmada en la misma fecha donde la primera fecha de detalle coincida
                            $ultimaReservaMismaFecha = Reserva::where('confirmado', 1)
                                ->whereHas('detallestours', function ($query) use ($fechaCompleta) {
                                    $query->whereDate('fecha_viaje', $fechaCompleta);
                                })
                                ->where(function($query) use ($fechaCompleta) {
                                    $query->whereRaw("
                                        (SELECT MIN(fecha_viaje) FROM detalle_reservas WHERE detalle_reservas.reserva_id = reservas.id) = ?", 
                                        [$fechaCompleta]
                                    );
                                })
                                ->orderBy('numero', 'desc')
                                ->first();

                            // Asignar el siguiente número correlativo
                            $numero = $ultimaReservaMismaFecha ? $ultimaReservaMismaFecha->numero + 1 : 1;

                            $reserva->numero = $numero;
                            $reserva->save();
                        }
                    }
                }else{
                    if($confirmado == 1){
    
                        if ($primeraFecha) {
                            // Formatear la fecha para obtener la fecha completa (Y-m-d)
                            $fechaCompleta = Carbon::parse($primeraFecha->fecha_viaje)->format('Y-m-d');

                            // Buscar la última reserva confirmada en la misma fecha donde la primera fecha de detalle coincida
                            $ultimaReservaMismaFecha = Reserva::where('confirmado', 1)
                                ->whereHas('detallestours', function ($query) use ($fechaCompleta) {
                                    $query->whereDate('fecha_viaje', $fechaCompleta);
                                })
                                ->where(function($query) use ($fechaCompleta) {
                                    $query->whereRaw("
                                        (SELECT MIN(fecha_viaje) FROM detalle_reservas WHERE detalle_reservas.reserva_id = reservas.id) = ?", 
                                        [$fechaCompleta]
                                    );
                                })
                                ->orderBy('numero', 'desc')
                                ->first();

                            // Asignar el siguiente número correlativo
                            $numero = $ultimaReservaMismaFecha ? $ultimaReservaMismaFecha->numero + 1 : 1;

                            $reserva->numero = $numero;
                            $reserva->save();
                        }
                    }
                }
            }
            
            

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        $this->isSaving = false;
        
        if($confirmado==1){
            return redirect()
            ->route("reserva.index")
            ->with("success", "Reserva Agregado Correctamente.");
        }
        return redirect()
            ->route("reserva.sinconfirmar")
            ->with("success", "Reserva Agregado Correctamente.");
    }

    public function render()
    {
        return view('livewire.crear-reserva');
    }
}