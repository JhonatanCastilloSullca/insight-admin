<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Servicio;
use App\Models\Cuota;
use App\Models\Pais;
use App\Models\Pasajero;
use App\Models\Paquete;
use App\Models\DetallePaquete;
use App\Models\DetallePaqueteIncluye;
use App\Models\DetallePaqueteNoIncluye;
use App\Models\Aeropuertos;
use App\Models\Documento;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Exception;


class PaquetesCreate extends Component
{
    use WithFileUploads;
    public $editingIndex;
    public $editingIndexHotel;
    public $editingIndexVuelo;
    //PASAJEROS
    public $nombres;
    public $nacimiento;
    public $genero;
    public $celular;
    public $email;
    public $tarifa;
    public $pais_id;
    public $documento;
    public $num_doc;
    public $comentario;
    public $imagenpasajero;
    public $imagenver;
    public $pasajeros;
    public $paises;
    public $pasajerosreserva = [];
    //PASAJEROS
    public $imagenprincipal;
    public $imagensecundario;
    public $total = 0.00;
    public $total_soles = 0.00;
    public $total_dolares = 0.00;
    public $video;
    public $subtitulo;
    public $duracion;
    public $precio_neto;
    public $precio_min;
    public $precio_neto_soles;
    public $precio_neto_dolar;
    public $precio_min_soles;
    public $precio_min_dolar;
    //Servicios Detalles Hotel
    public $serviciosHotel;
    public $incluyeserviceHotel = [];
    public $monedaservicioHotel = 1;
    public $precioserviciosolesHotel = 0.00;
    public $precioserviciodolaresHotel = 0.00;
    public $servicioDataHotel = [];
    public $noincluyeserviceHotel = [];
    public $incluyeHotel;
    public $no_incluyeHotel;
    public $servicioincluyesHotel;
    public $incluyesHotel = [];
    public $noincluyeHotel;
    public $reservaDataHotel = [];
    public $servicioHotel;
    public $servicioincluyeHotel = [];
    //Servicios Detalles Vuelo
    public $serviciosVuelo;
    public $incluyeserviceVuelo = [];
    public $monedaservicioVuelo = 1;
    public $precioserviciosolesVuelo = 0.00;
    public $precioserviciodolaresVuelo = 0.00;
    public $servicioDataVuelo = [];
    public $noincluyeserviceVuelo = [];
    public $incluyeVuelo;
    public $no_incluyeVuelo;
    public $servicioincluyesVuelo;
    public $incluyesVuelo = [];
    public $noincluyeVuelo;
    public $reservaDataVuelo = [];
    public $servicioVuelo;
    public $servicioincluyeVuelo = [];
    public $desde;
    public $hasta;
    public $desdevuelta;
    public $hastavuelta;
    public $idavuelta;
    //Servicios Detalles
    public $servicios;
    public $incluyeservice = [];
    public $monedaservicio = 1;
    public $precioserviciosoles = 0.00;
    public $precioserviciodolares = 0.00;
    public $servicioData = [];
    public $noincluyeservice = [];
    public $incluye;
    public $no_incluye;
    public $servicioincluyes;
    public $incluyes = [];
    public $noincluye;
    public $reservaData = [];
    public $servicio;
    public $servicioincluye = [];
    public $privado = false;
    public $adulto = false;
    public $diaservicio;
    //Datos Generales
    public $imagen;
    public $titulo;
    public $mensaje_bienvenida;
    public $cantpax;
    public $cantpaxniños;
    public $regularsoles;
    public $regulardolares;
    public $descripcion;
    public $generalData = [];
    public $user;

    public $totales = [];
    protected function rules()
    {
        return [
            'titulo' => 'required|string|max:200',
            'mensaje_bienvenida' => 'nullable|string|max:200',
            'cantpax' => 'nullable|numeric|min:1',
            'cantpaxniños' => 'nullable|numeric|min:1',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }
    public function updatedidavuelta($value)
    {
    }
    public function mount()
    {
        $this->aeropuertos = Aeropuertos::all();
        $this->paises = Pais::all();
        $this->pasajeros = Pasajero::all();
        $this->user = \Auth::user();
        $this->servicios = Servicio::whereIn('categoria_id', [5,6])->get();
        $this->serviciosHotel = Servicio::where('categoria_id', '2')->get();
        $this->serviciosVuelo = Servicio::where('categoria_id', '3')->get();
        $this->servicioincluyesHotel =  Servicio::select('id','titulo')->where('categoria_id',7)->get();
        $this->servicioincluyes =  Servicio::select('id','titulo')->whereIn('categoria_id',[9,10,11,12,13])->get();
        $this->servicioincluyesVuelo = Servicio::select('id','titulo')->where('categoria_id',8)->get();
    }
    public function render()
    {
        return view('livewire.paquetes-create');
    }
    public function updatingnombres($nombre)
    {
        $pasajero = Pasajero::where('nombres', '=', $nombre)->first();
        if ($pasajero == "") {
            $this->genero = '';
            $this->celular = '';
            $this->email = '';
            $this->pais_id = '';
        } else {
            $this->genero = $pasajero->genero;
            $this->celular = $pasajero->celular;
            $this->email = $pasajero->email;
            $this->pais_id = $pasajero->pais_id;
            $this->emit('Encontrar', $pasajero->pais_id);
        }
    }
    public function agregarPasajero()
    {
        $pais = Pais::find($this->pais_id);
        $documento = Documento::firstOrCreate([
            'tipo_documento' => $this->documento,
            'num_documento' => $this->num_doc,
        ], []);
        if ($this->imagenpasajero) {
            $nombreimg = $this->documento . '-' . $this->num_doc . '.' . $this->imagenpasajero->getClientOriginalExtension();
            $ruta = $this->imagenpasajero->storeAs('img/documentos', $nombreimg);
            Image::make('storage/' . $ruta)->fit(1600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('storage/' . $ruta, null, 'jpg');
        } else {
            if ($this->imagenver != '') {
                $nombreimg = $this->imagenver;
            } else {
                $nombreimg = '';
            }
        }
        $pasajero = Pasajero::firstOrCreate([
            'nombres' => $this->nombres,
            'documento_id' => $documento->id
        ], [
            'genero' => $this->genero,
            'celular' => $this->celular,
            'email' => $this->email,
            'pais_id' => $this->pais_id,
        ]);
        $nuevoPasajero = [
            'id' => $pasajero->id,
            'nombres' => $this->nombres,
            'genero' => $this->genero,
            'celular' => $this->celular,
            'email' => $this->email,
            'pais_id' => $this->pais_id,
            'pais_nombre' => $pais->nombre,
        ];
        $this->pasajerosreserva[] = $nuevoPasajero;
    }
    public function reducirPasajero($i)
    {
        unset($this->pasajerosreserva[$i]);
    }
    public function register()
    {
        $this->generalData[] = [
            'titulo'                => $this->titulo,
            'mensaje_bienvenida'    => $this->mensaje_bienvenida,
            'cantpax'               => $this->cantpax,
            'cantpaxniños'          => $this->cantpaxniños,
            'regularsoles'          => $this->regularsoles,
            'regulardolares'        => $this->regulardolares,
            'descripcion'           => $this->descripcion,
        ];
    }
    public function updatedServicio()
    {
        $servicio = Servicio::find($this->servicio);

        foreach($servicio->precios as $precio){
            $this->totales[] = [
                'id' => $precio->id,
                'nombre' => $precio->nombre,
                'moneda_id' => $precio->pivot?->moneda_id,
                'precio' => $precio->pivot?->precio,
                'preciomin' => $precio->pivot?->precio,
            ];
        }
        if ($servicio && $servicio->incluyes) {
            $this->servicioData = [
                'servicio' => $servicio,
            ];
            $this->incluyeservice = $servicio->incluyes->map(function ($item) {
                return ['id' => $item->id, 'titulo' => $item->titulo];
            })->toArray();
            $this->noincluyeservice = $servicio->noincluyes->map(function ($item) {
                return ['id' => $item->id, 'titulo' => $item->titulo];
            })->toArray();
        } else {
            $this->servicioData = [];
            $this->incluyeservice = [];
            $this->noincluyeservice = [];
        }
    }
    public function updatedServicioHotel()
    {
        $servicio = Servicio::find($this->servicioHotel);
        $this->precioserviciosolesHotel = $servicio->precio_neto_soles;
        $this->precioserviciodolaresHotel = $servicio->precio_neto_dolar;
        if ($servicio && $servicio->incluyes) {
            $this->servicioDataHotel = [
                'servicio' => $servicio,
            ];
            $this->incluyeserviceHotel = $servicio->incluyes->map(function ($item) {
                return ['id' => $item->id, 'titulo' => $item->titulo];
            })->toArray();
            $this->noincluyeserviceHotel = $servicio->noincluyes->map(function ($item) {
                return ['id' => $item->id, 'titulo' => $item->titulo];
            })->toArray();
        } else {
            $this->servicioDataHotel = [];
            $this->incluyeserviceHotel = [];
            $this->noincluyeserviceHotel = [];
        }
    }
    public function updatedServicioVuelo()
    {
        $servicio = Servicio::find($this->servicioVuelo);
        $this->precioserviciosolesVuelo = $servicio->precio_neto_soles;
        $this->precioserviciodolaresVuelo = $servicio->precio_neto_dolar;
        if ($servicio && $servicio->incluyes) {
            $this->servicioDataVuelo = [
                'servicio' => $servicio,
            ];
            $this->incluyeserviceVuelo = $servicio->incluyes->map(function ($item) {
                return ['id' => $item->id, 'titulo' => $item->titulo];
            })->toArray();
            $this->noincluyeserviceVuelo = $servicio->noincluyes->map(function ($item) {
                return ['id' => $item->id, 'titulo' => $item->titulo];
            })->toArray();
        } else {
            $this->servicioDataVuelo = [];
            $this->incluyeserviceVuelo = [];
            $this->noincluyeserviceVuelo = [];
        }
    }
    public function IncluyeDetalle()
    {
        $servicio = Servicio::find($this->incluye);
        if ($servicio) {
            $data = ['id' => $servicio->id, 'titulo' => $servicio->titulo];
            $found = false;
            foreach ($this->incluyeservice as $item) {
                if ($item['id'] == $data['id']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->incluyeservice[] = $data;
                if(count($servicio->precios)>0){
                    foreach($this->totales as &$total) { // Itera por referencia
                        foreach($servicio->precios as $precio) {
                            if($total['id'] == $precio->id && $total['moneda_id'] == $precio->pivot->moneda_id) {
                                $total['precio'] += $precio->pivot->precio;
                            }
                        }
                    }
                }
            }
        }
    }
    public function IncluyeDetalleHotel()
    {
        $servicio = Servicio::find($this->incluyeHotel);
        if ($servicio) {
            $data = ['id' => $servicio->id, 'titulo' => $servicio->titulo];
            $found = false;
            foreach ($this->incluyeserviceHotel as $item) {
                if ($item['id'] == $data['id']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->incluyeserviceHotel[] = $data;
            }
        }
    }
    public function IncluyeDetalleVuelo()
    {
        $servicio = Servicio::find($this->incluyeVuelo);
        if ($servicio) {
            $data = ['id' => $servicio->id, 'titulo' => $servicio->titulo];
            $found = false;
            foreach ($this->incluyeserviceVuelo as $item) {
                if ($item['id'] == $data['id']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->incluyeserviceVuelo[] = $data;
            }
        }
    }
    public function Eliminardetalle($index)
    {
        unset($this->incluyeservice[$index]);
        $this->incluyeservice = array_values($this->incluyeservice);
    }
    public function EliminardetalleHotel($index)
    {
        unset($this->incluyeserviceHotel[$index]);
        $this->incluyeserviceHotel = array_values($this->incluyeserviceHotel);
    }
    public function EliminardetalleVuelo($index)
    {
        unset($this->incluyeserviceVuelo[$index]);
        $this->incluyeserviceVuelo = array_values($this->incluyeserviceVuelo);
    }
    public function NoincluyeDetalle()
    {
        $servicio = Servicio::find($this->incluye);
        if ($servicio) {
            $data = ['id' => $servicio->id, 'titulo' => $servicio->titulo];
            $found = false;
            foreach ($this->noincluyeservice as $item) {
                if ($item['id'] == $data['id']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->noincluyeservice[] = $data;
            }
        }
    }
    public function NoincluyeDetalleHotel()
    {
        $servicio = Servicio::find($this->incluyeHotel);
        if ($servicio) {
            $data = ['id' => $servicio->id, 'titulo' => $servicio->titulo];
            $found = false;
            foreach ($this->noincluyeserviceHotel as $item) {
                if ($item['id'] == $data['id']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->noincluyeserviceHotel[] = $data;
            }
        }
    }
    public function NoincluyeDetalleVuelo()
    {
        $servicio = Servicio::find($this->incluyeVuelo);
        if ($servicio) {
            $data = ['id' => $servicio->id, 'titulo' => $servicio->titulo];
            $found = false;
            foreach ($this->noincluyeserviceVuelo as $item) {
                if ($item['id'] == $data['id']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->noincluyeserviceVuelo[] = $data;
            }
        }
    }
    public function EliminarNoIncluyeDetalle($index)
    {
        unset($this->noincluyeservice[$index]);
        $this->noincluyeservice = array_values($this->noincluyeservice);
    }
    public function EliminarNoIncluyeDetalleHotel($index)
    {
        unset($this->noincluyeserviceHotel[$index]);
        $this->noincluyeserviceHotel = array_values($this->noincluyeserviceHotel);
    }
    public function EliminarNoIncluyeDetalleVuelo($index)
    {
        unset($this->noincluyeserviceVuelo[$index]);
        $this->noincluyeserviceVuelo = array_values($this->noincluyeserviceVuelo);
    }
    public function registerDetalle()
    {
        if ($this->editingIndex !== null) {
            if ($this->reservaData[$this->editingIndex]['adulto'] == 1) {
                $this->total_soles -= $this->reservaData[$this->editingIndex]['precioserviciosoles'];
                $this->total_dolares -= $this->reservaData[$this->editingIndex]['precioserviciodolares'];
            } else {
                $this->total_soles -= $this->reservaData[$this->editingIndex]['precioserviciosoles'];
                $this->total_dolares -= $this->reservaData[$this->editingIndex]['precioserviciodolares'];
            }
            $this->reservaData[$this->editingIndex] = [
                'servicioData' => $this->servicioData ? $this->servicioData :  $this->reservaData[$this->editingIndex]['servicioData'],
                'incluyeservice' => $this->incluyeservice,
                'noincluyeservice' => $this->noincluyeservice,
                'monedaservicio' => $this->monedaservicio,
                'precioserviciosoles' => $this->precioserviciosoles,
                'precioserviciodolares' => $this->precioserviciodolares,
                'dia_servicio' => $this->diaservicio,
                'tipo' => $this->privado ? 1 : 0,
                'adulto' => $this->adulto ? 1 : 0,
            ];
            if ($this->adulto == 1) {
                $this->total_soles += $this->precioserviciosoles;
                $this->total_dolares += $this->precioserviciodolares;
            } else {
                $this->total_soles += $this->precioserviciosoles;
                $this->total_dolares += $this->precioserviciodolares;
            }
            $this->editingIndex = null;
        } else {
            $this->reservaData[] = [
                'servicioData' => $this->servicioData,
                'incluyeservice' => $this->incluyeservice,
                'noincluyeservice' => $this->noincluyeservice,
                'monedaservicio' => $this->monedaservicio,
                'precioserviciosoles' => $this->precioserviciosoles,
                'precioserviciodolares' => $this->precioserviciodolares,
                'dia_servicio' => $this->diaservicio,
                'tipo' => $this->privado ? 1 : 0,
                'adulto' => $this->adulto ? 1 : 0,
            ];
            if ($this->adulto == 1) {
                $this->total_soles += $this->precioserviciosoles;
                $this->total_dolares += $this->precioserviciodolares;
            } else {
                $this->total_soles += $this->precioserviciosoles;
                $this->total_dolares += $this->precioserviciodolares;
            }
        }
        $this->servicioData = null;
        $this->incluyeservice = [];
        $this->noincluyeservice = [];
        $this->precioserviciosoles = null;
        $this->precioserviciodolares = null;
        $this->errorPrecio = '';
        $this->privado = false;
        $this->adulto = false;
        $this->aduldiaservicioto = null;
        $this->reset('incluye');
        $this->reset('servicio');
    }
    public function registerDetalleHotel()
    {
        if ($this->editingIndexHotel !== null) {
            $this->total_soles -= $this->reservaDataHotel[$this->editingIndexHotel]['precioserviciosolesHotel'];
            $this->total_dolares -= $this->reservaDataHotel[$this->editingIndexHotel]['precioserviciodolaresHotel'];
            $this->reservaDataHotel[$this->editingIndexHotel] = [
                'servicioDataHotel' => $this->servicioDataHotel ? $this->servicioDataHotel : $this->reservaDataHotel[$this->editingIndexHotel]['servicioDataHotel'],
                'incluyeserviceHotel' => $this->incluyeserviceHotel,
                'noincluyeserviceHotel' => $this->noincluyeserviceHotel,
                'precioserviciosolesHotel' => $this->precioserviciosolesHotel,
                'precioserviciodolaresHotel' => $this->precioserviciodolaresHotel,

            ];
            $this->total_soles += $this->precioserviciosolesHotel;
            $this->total_dolares += $this->precioserviciodolaresHotel;
            $this->editingIndexHotel = null;
        } else {
            $this->reservaDataHotel[] = [
                'servicioDataHotel' => $this->servicioDataHotel,
                'incluyeserviceHotel' => $this->incluyeserviceHotel,
                'noincluyeserviceHotel' => $this->noincluyeserviceHotel,
                'precioserviciosolesHotel' => $this->precioserviciosolesHotel,
                'precioserviciodolaresHotel' => $this->precioserviciodolaresHotel,

            ];
            $this->total_soles += $this->precioserviciosolesHotel;
            $this->total_dolares += $this->precioserviciodolaresHotel;
        }
        $this->servicioDataHotel = null;
        $this->incluyeserviceHotel = [];
        $this->noincluyeserviceHotel = [];
        $this->precioservicioHotel = null;
        $this->precioserviciosolesHotel = null;
        $this->precioserviciodolaresHotel = null;
        $this->reset('incluyeHotel');
        $this->reset('servicioHotel');
    }
    public function registerDetalleVuelo()
    {
        if ($this->editingIndexVuelo !== null) {
            $this->total_soles -= $this->reservaDataVuelo[$this->editingIndexVuelo]['precioserviciosolesVuelo'];
            $this->total_dolares -= $this->reservaDataVuelo[$this->editingIndexVuelo]['precioserviciodolaresVuelo'];
            $this->reservaDataVuelo[$this->editingIndexVuelo] = [
                'servicioDataVuelo'             => $this->servicioDataVuelo ? $this->servicioDataVuelo : $this->reservaDataVuelo[$this->editingIndexVuelo]['servicioDataVuelo'],
                'incluyeserviceVuelo'           => $this->incluyeserviceVuelo,
                'noincluyeserviceVuelo'         => $this->noincluyeserviceVuelo,
                'precioserviciosolesVuelo'      => $this->precioserviciosolesVuelo,
                'precioserviciodolaresVuelo'    => $this->precioserviciodolaresVuelo,
                'idavuelta'                     => $this->idavuelta,
                'desde'                         => $this->desde,
                'hasta'                         => $this->hasta,
                'desdevuelta'                   => $this->desdevuelta,
                'hastavuelta'                   => $this->hastavuelta,
            ];

            $this->total_soles += $this->precioserviciosolesVuelo;
            $this->total_dolares += $this->precioserviciodolaresVuelo;
            $this->editingIndexVuelo = null;
        } else {
            $this->reservaDataVuelo[] = [
                'servicioDataVuelo'             => $this->servicioDataVuelo,
                'incluyeserviceVuelo'           => $this->incluyeserviceVuelo,
                'noincluyeserviceVuelo'         => $this->noincluyeserviceVuelo,
                'precioserviciosolesVuelo'      => $this->precioserviciosolesVuelo,
                'precioserviciodolaresVuelo'    => $this->precioserviciodolaresVuelo,
                'idavuelta'                     => $this->idavuelta,
                'desde'                         => $this->desde,
                'hasta'                         => $this->hasta,
                'desdevuelta'                   => $this->desdevuelta,
                'hastavuelta'                   => $this->hastavuelta,
            ];
            $this->total_soles += $this->precioserviciosolesVuelo;
            $this->total_dolares += $this->precioserviciodolaresVuelo;
        }
        $this->servicioDataVuelo = null;
        $this->incluyeserviceVuelo = [];
        $this->noincluyeserviceVuelo = [];
        $this->precioservicioVuelo = null;
        $this->desde = null;
        $this->hasta = null;
        $this->desdevuelta = null;
        $this->hastavuelta = null;
        $this->precioserviciosolesVuelo = null;
        $this->precioserviciodolaresVuelo = null;
        $this->reset('incluyeVuelo');
        $this->reset('servicioVuelo');
    }
    public function EditarreservaData($index)
    {
        $this->editingIndex = $index;
        $this->emit('openModal');
    }
    public function EditarreservaDataHotel($index)
    {
        $this->editingIndexHotel = $index;
        $this->emit('openModalHotel');
    }
    public function EditarreservaDataVuelo($index)
    {
        $this->editingIndexVuelo = $index;
        $this->emit('openModalVuelo');
    }
    public function EliminarreservaData($index)
    {
        if (isset($this->reservaData[$index]['precioserviciosoles'])) {
            if ($this->reservaData[$index]['adulto'] == 1) {
                $this->total_soles -= $this->reservaData[$index]['precioserviciosoles'];
            } else {
                $this->total_soles -= $this->reservaData[$index]['precioserviciosoles'];
            }
        }
        if (isset($this->reservaData[$index]['precioserviciodolares'])) {
            if ($this->reservaData[$index]['adulto'] == 1) {
                $this->total_dolares -= $this->reservaData[$index]['precioserviciodolares'];
            } else {
                $this->total_dolares -= $this->reservaData[$index]['precioserviciodolares'];
            }
        }
        unset($this->reservaData[$index]);
        $this->reservaData = array_values($this->reservaData);
    }
    public function EliminarreservaDataHotel($index)
    {
        if (isset($this->reservaDataHotel[$index]['precioserviciosolesHotel'])) {
            $this->total_soles -= $this->reservaDataHotel[$index]['precioserviciosolesHotel'];
        }
        if (isset($this->reservaDataHotel[$index]['precioserviciodolaresHotel'])) {
            $this->total_dolares -= $this->reservaDataHotel[$index]['precioserviciodolaresHotel'];
        }
        unset($this->reservaDataHotel[$index]);
        $this->reservaDataHotel = array_values($this->reservaDataHotel);
    }
    public function EliminarreservaDataVuelo($index)
    {
        if (isset($this->reservaDataVuelo[$index]['precioserviciosolesVuelo'])) {
            $this->total_soles -= $this->reservaDataVuelo[$index]['precioserviciosolesVuelo'];
        }
        if (isset($this->reservaDataVuelo[$index]['precioserviciodolaresVuelo'])) {
            $this->total_dolares -= $this->reservaDataVuelo[$index]['precioserviciodolaresVuelo'];
        }
        unset($this->reservaDataVuelo[$index]);
        $this->reservaDataVuelo = array_values($this->reservaDataVuelo);
    }
    public function savePaquete()
    {
        $validatedData = $this->validate([
            'titulo'              =>    'required|max:250',
            'reservaData'         =>    'required',
        ], [
            'reservaData.required' => 'El paquete debe tener al menos un servicio',
        ]);
        $mytime = Carbon::now('America/Lima');
        $paquete = new Paquete;
        $paquete->titulo                =  $this->titulo;
        $paquete->mensaje_bienvenida    =  $this->mensaje_bienvenida;
        $paquete->fecha_registro        = now('America/Lima');
        $paquete->cantidad_pax          =  $this->cantpax;
        $paquete->cantpaxniños          =  $this->cantpaxniños;
        $paquete->regularsoles          =  $this->regularsoles;
        $paquete->regulardolares        =  $this->regulardolares;
        $paquete->descripcion           =  $this->descripcion;
        $pais = Pais::find($this->pais_id);
        $pasajero = null;
        if ($this->nombres) {
            $pasajero = Pasajero::firstOrCreate([
                'nombres' => $this->nombres,
            ], [
                'genero' => $this->genero,
                'celular' => $this->celular,
                'email' => $this->email,
                'pais_id' => $this->pais_id,
            ]);
        }
        $ultimoPaquete = Paquete::orderBy('id', 'desc')->count();
        $ultimoid = $ultimoPaquete + 1;
        if ($this->imagenprincipal) {
            $imagen = Image::make($this->imagenprincipal->getRealPath());
            $imagen->resize(1600, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $nombreArchivo = 'paquetes/' . Str::slug('paquete-' . $ultimoid, '-') . '.' . $this->imagenprincipal->getClientOriginalExtension();
            $imagen->save(storage_path('app/public/' . $nombreArchivo));
            $paquete->img_principal = $nombreArchivo;
        } else {
            $paquete->img_principal = 'paquetes/default.png';
        }
        if ($this->imagensecundario) {
            $imagen = Image::make($this->imagensecundario->getRealPath());
            $imagen->resize(1600, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $nombreArchivo = 'paquetes/' . Str::slug('paquete-secundario-' . $ultimoid, '-') . '.' . $this->imagensecundario->getClientOriginalExtension();
            $imagen->save(storage_path('app/public/' . $nombreArchivo));
            $paquete->img_secundario = $nombreArchivo;
        } else {
            $paquete->img_secundario = 'paquetes/default.png';
        }
        $paquete->video                 =  $this->video;
        $paquete->publico               =  1;
        $paquete->precio_soles          =  $this->total_soles;
        $paquete->precio_dolares        =  $this->total_dolares;
        $paquete->estado                =  1;
        $paquete->user_id               =  $this->user->id;
        $paquete->pasajero_id           =  $pasajero ? $pasajero->id : null;
        $paquete->save();
        $paquete->pasajeros()->attach($pasajero);
        foreach ($this->reservaData as $reserva) {
            $detallePaquete = DetallePaquete::create([
                'paquete_id'    => $paquete->id,
                'servicio_id'   => $reserva['servicioData']['servicio']['id'],
                'dia_servicio'  => $reserva['dia_servicio'],
                'preciosoles'   => $reserva['precioserviciosoles'],
                'preciodolares' => $reserva['precioserviciodolares'],
                'tipo'          => $reserva['tipo'],
                'adulto'        => $reserva['adulto'],
            ]);
            if (!empty($reserva['incluyeservice'])) {
                foreach ($reserva['incluyeservice'] as $incluyeService) {
                    DetallePaqueteIncluye::create([
                        'detalle_paquete_id' => $detallePaquete->id,
                        'servicio_incluido_id' => $incluyeService['id'],
                    ]);
                }
            }
            if (!empty($reserva['noincluyeservice'])) {
                foreach ($reserva['noincluyeservice'] as $noIncluyeService) {
                    DetallePaqueteNoIncluye::create([
                        'detalle_paquete_id' => $detallePaquete->id,
                        'servicio_no_incluido_id' => $noIncluyeService['id'],
                    ]);
                }
            }
        }
        foreach ($this->reservaDataHotel as $reserva) {
            $detallePaquete = DetallePaquete::create([
                'paquete_id'    => $paquete->id,
                'servicio_id'   => $reserva['servicioDataHotel']['servicio']['id'],
                'preciosoles'   => $reserva['precioserviciosolesHotel'],
                'preciodolares' => $reserva['precioserviciodolaresHotel'],
            ]);
            if (!empty($reserva['incluyeserviceHotel'])) {
                foreach ($reserva['incluyeserviceHotel'] as $incluyeService) {
                    DetallePaqueteIncluye::create([
                        'detalle_paquete_id' => $detallePaquete->id,
                        'servicio_incluido_id' => $incluyeService['id'],
                    ]);
                }
            }
            if (!empty($reserva['noincluyeserviceHotel'])) {
                foreach ($reserva['noincluyeserviceHotel'] as $noIncluyeService) {
                    DetallePaqueteNoIncluye::create([
                        'detalle_paquete_id' => $detallePaquete->id,
                        'servicio_no_incluido_id' => $noIncluyeService['id'],
                    ]);
                }
            }
        }
        foreach ($this->reservaDataVuelo as $reserva) {

            $detallePaqueteData = [
                'paquete_id'        => $paquete->id,
                'servicio_id'       => $reserva['servicioDataVuelo']['servicio']['id'],
                'preciosoles'       => $reserva['precioserviciosolesVuelo'],
                'preciodolares'     => $reserva['precioserviciodolaresVuelo'],
                'tipo'              => $reserva['idavuelta'] ? 1 : 0,
            ];

            if ($reserva['idavuelta']) {
                $detallePaqueteData['descripcion'] = '(' . $reserva['desde'] . ' / ' . $reserva['hasta'] . ')' . ' - ' . '(' . $reserva['desdevuelta'] . ' / ' . $reserva['hastavuelta'] . ')';
            } else {
                $detallePaqueteData['descripcion'] = '(' . $reserva['desde'] . ' / ' . $reserva['hasta'] . ')';
            }
            $detallePaquete = DetallePaquete::create($detallePaqueteData);


            if (!empty($reserva['incluyeserviceVuelo'])) {
                foreach ($reserva['incluyeserviceVuelo'] as $incluyeService) {
                    DetallePaqueteIncluye::create([
                        'detalle_paquete_id' => $detallePaquete->id,
                        'servicio_incluido_id' => $incluyeService['id'],
                    ]);
                }
            }
            if (!empty($reserva['noincluyeserviceVuelo'])) {
                foreach ($reserva['noincluyeserviceVuelo'] as $noIncluyeService) {
                    DetallePaqueteNoIncluye::create([
                        'detalle_paquete_id' => $detallePaquete->id,
                        'servicio_no_incluido_id' => $noIncluyeService['id'],
                    ]);
                }
            }
        }
        return redirect()->route('paquete.index')
            ->with('success', 'Paquete Agregado Correctamente.');
    }
    protected $listeners = ['openModal', 'openModalHotel', 'openModalVuelo'];
    public function openModal()
    {
        if ($this->editingIndex !== null) {
            $data = $this->reservaData[$this->editingIndex];
            $this->servicio = $data['servicioData']['servicio']['id'];
            $this->privado = $data['tipo'];
            $this->diaservicio = $data['dia_servicio'];
            $this->adulto = $data["adulto"] ? true : false;
            $this->precioserviciosoles = $data['precioserviciosoles'];
            $this->precioserviciodolares = $data['precioserviciodolares'];
            $this->incluyeservice = $data['incluyeservice'];
            $this->noincluyeservice = $data['noincluyeservice'];
            $this->dispatchBrowserEvent('openModal');
        }
    }
    public function openModalHotel()
    {
        if ($this->editingIndexHotel !== null) {
            $data = $this->reservaDataHotel[$this->editingIndexHotel];
            $this->servicioHotel            = $data['servicioDataHotel']['servicio']['id'];
            $this->incluyeserviceHotel          = $data['incluyeserviceHotel'];
            $this->noincluyeserviceHotel        = $data['noincluyeserviceHotel'];
            $this->precioserviciosolesHotel     = $data['precioserviciosolesHotel'];
            $this->precioserviciodolaresHotel   = $data['precioserviciodolaresHotel'];
            $this->dispatchBrowserEvent('openModalHotel');
        }
    }
    public function openModalVuelo()
    {
        if ($this->editingIndexVuelo !== null) {
            $data = $this->reservaDataVuelo[$this->editingIndexVuelo];
            $this->servicioVuelo                = $data['servicioDataVuelo']['servicio']['id'];
            $this->incluyeserviceVuelo          = $data['incluyeserviceVuelo'];
            $this->noincluyeserviceVuelo        = $data['noincluyeserviceVuelo'];
            $this->precioserviciosolesVuelo     = $data['precioserviciosolesVuelo'];
            $this->precioserviciodolaresVuelo   = $data['precioserviciodolaresVuelo'];
            $this->idavuelta                    = $data['idavuelta'];
            $this->desde                        = $data['desde'];
            $this->hasta                        = $data['hasta'];
            $this->desdevuelta                  = $data['desdevuelta'];
            $this->hastavuelta                  = $data['hastavuelta'];
            $this->dispatchBrowserEvent('openModalVuelo');
        }
    }
}
