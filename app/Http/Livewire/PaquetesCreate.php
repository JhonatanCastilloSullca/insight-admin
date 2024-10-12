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
use App\Models\ItinerarioPaquete;
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

    public $itinerarios = [];
    public $servicios;
    public $hoteles;
    public $vuelos;
    public $aeropuertos;

    //general
    public $titulo;
    public $mensaje_bienvenida;
    public $video;
    public $imagenprincipal;
    public $originalImagenPrincipal;
    public $imagensecundario;
    public $originalImagenSecundario;
    public $descripcion;

    //servicios
    public $serviciospaquete = [];
    public $servicioId;
    public $servicioIdEditar;
    public $incluye;
    public $noincluye;
    public $precioSoles;
    public $precioDolares;

    //hoteles
    public $hotelespaquete = [];
    public $hotelId;
    public $hotelIdEditar;
    public $noches;
    public $incluyeHotel;
    public $noincluyeHotel;
    public $precioSolesHotel;
    public $precioDolaresHotel;

    //vuelos
    public $vuelospaquete = [];
    public $vueloId;
    public $vueloIdEditar;
    public $idavuelta = 1;
    public $incluyeVuelo;
    public $noincluyeVuelo;
    public $desde;
    public $hasta;
    public $desdevuelta;
    public $hastavuelta;
    public $precioSolesVuelo;
    public $precioDolaresVuelo;

    public $paqueteIdUpdate;
    public $incluyeHoteles;
    public $incluyeVuelos;
    public $incluyeServicios;

    public $total_soles = 0;
    public $total_dolares = 0;

    public function mount($paqueteId = null)
    {
        $this->servicios = Servicio::whereIn('categoria_id', [5, 6])->orderBy('titulo', 'asc')->get();
        $this->hoteles = Servicio::where('categoria_id', 2)->where('incluye', 0)->orderBy('titulo', 'asc')->get();
        $this->vuelos = Servicio::where('categoria_id', 3)->where('incluye', 0)->orderBy('titulo', 'asc')->get();
        $this->aeropuertos = Aeropuertos::all();
        $this->incluyeServicios = Servicio::whereRelation('categoria', 'detalle', 1)->whereNotIn('categoria_id', [2, 3, 5])->orderBy('titulo', 'asc')->get();
        $this->incluyeHoteles = Servicio::where('incluye', 1)->where('categoria_id', 2)->orderBy('titulo', 'asc')->get();;
        $this->incluyeVuelos = Servicio::where('incluye', 1)->where('categoria_id', 3)->orderBy('titulo', 'asc')->get();

        //Editar
        $this->paqueteIdUpdate = $paqueteId;
        if ($this->paqueteIdUpdate) {
            $paquete = Paquete::find($paqueteId);

            $this->titulo = $paquete->titulo;
            $this->mensaje_bienvenida = $paquete->mensaje_bienvenida;
            $this->video = $paquete->video;
            $this->total_soles = $paquete->precio_soles;
            $this->total_dolares = $paquete->precio_dolares;

            $this->originalImagenPrincipal = $paquete->img_principal;
            $this->originalImagenSecundario = $paquete->img_secundario;
            $this->descripcion = $paquete->descripcion;

            foreach ($paquete->detallestours as $detalle) {
                $nuevoServicio = [
                    'id' => $detalle->servicio_id,
                    'servicio' => $detalle->servicio->titulo,
                    'precioSoles' => $detalle->preciosoles,
                    'precioDolares' => $detalle->preciodolares,
                ];
                $itinerarios = [];
                foreach ($detalle->itinerarios as $i => $itinerario) {
                    $incluyes = [];
                    $itinerari = [
                        'dia' => $i + 1,
                    ];
                    foreach ($itinerario->incluyes as $id) {
                        $servicio = Servicio::find($id->pivot->servicio_incluido_id);
                        $incluye = [
                            'id' => $servicio->id,
                            'servicio' => $servicio->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                    $noincluyes = [];
                    foreach ($itinerario->noincluyes as $id) {
                        $servicio = Servicio::find($id->pivot->servicio_no_incluido_id);
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

                $this->serviciospaquete[] = $nuevoServicio;
            }

            foreach ($paquete->detalleshoteles as $detalle) {
                $nuevoServicio = [
                    'id' => $detalle->servicio_id,
                    'servicio' => $detalle->servicio->titulo,
                    'noches' => $detalle->paxservicionacional,
                    'precioSoles' => $detalle->preciosoles,
                    'precioDolares' => $detalle->preciodolares,
                ];
                $itinerarios = [];
                foreach ($detalle->itinerarios as $i => $itinerario) {
                    $incluyes = [];
                    $itinerari = [
                        'dia' => $i + 1,
                    ];
                    foreach ($itinerario->incluyes as $id) {
                        $servicio = Servicio::find($id->pivot->servicio_incluido_id);
                        $incluye = [
                            'id' => $servicio->id,
                            'servicio' => $servicio->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                    $noincluyes = [];
                    foreach ($itinerario->noincluyes as $id) {
                        $servicio = Servicio::find($id->pivot->servicio_no_incluido_id);
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

                $this->hotelespaquete[] = $nuevoServicio;
            }

            foreach ($paquete->detallesvuelos as $detalle) {
                $cadena_sin_ida_vuelta = str_replace(['IDA', 'VUELTA'], '', $detalle->descripcion);
                $partes = explode("-", $cadena_sin_ida_vuelta);
                $parte_primera = trim($partes[0]);
                preg_match('/\((.*?)\)/', $parte_primera, $matches);
                $valores_deseados = explode('/', $matches[1]);
                if (isset($partes[1])) {
                    $parte_segunda = trim($partes[1]);
                    preg_match('/\((.*?)\)/', $parte_segunda, $matches1);
                    $valores_deseados2 = explode('/', $matches1[1]);
                }

                $nuevoServicio = [
                    'id' => $detalle->servicio_id,
                    'servicio' => $detalle->servicio->titulo,
                    'desde' => $valores_deseados[0],
                    'hasta' => $valores_deseados[1],
                    'desdevuelta' => $valores_deseados2[0] ?? null,
                    'hastavuelta' => $valores_deseados2[1] ?? null,
                    'idavuelta' => $detalle->tipo,
                    'precioSoles' => $detalle->preciosoles,
                    'precioDolares' => $detalle->preciodolares,
                ];
                $itinerarios = [];
                foreach ($detalle->itinerarios as $i => $itinerario) {
                    $incluyes = [];
                    $itinerari = [
                        'dia' => $i + 1,
                    ];
                    foreach ($itinerario->incluyes as $id) {
                        $servicio = Servicio::find($id->pivot->servicio_incluido_id);
                        $incluye = [
                            'id' => $servicio->id,
                            'servicio' => $servicio->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                    $noincluyes = [];
                    foreach ($itinerario->noincluyes as $id) {
                        $servicio = Servicio::find($id->pivot->servicio_no_incluido_id);
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

                $this->vuelospaquete[] = $nuevoServicio;
            }
        }
    }

    public function render()
    {
        return view('livewire.paquetes-create');
    }

    public function abrirServicio()
    {
        $this->servicioIdEditar = null;
        $this->servicioId = null;
        $this->incluye = [];
        $this->noincluye = [];
        $this->itinerarios = [];
        $this->precioSoles = 0;
        $this->precioDolares = 0;
        $this->emit('EncontrarServicio', $this->servicioId, null, null, null);
    }

    public function updatedservicioId($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio == "") {
            $this->servicioId = null;
            $this->incluye = [];
            $this->noincluye = [];
        } else {
            $this->servicioId = $servicio->id;
            $this->itinerarios = $servicio->itinerarios;
            $this->precioSoles = $servicio->precios()->wherePivot('moneda_id', 1)->wherePivot('precio_id', 1)->first();
            $this->precioDolares = $servicio->precios()->wherePivot('moneda_id', 2)->wherePivot('precio_id', 1)->first();
            $this->precioSoles = $this->precioSoles ? $this->precioSoles->pivot?->precio : 0;
            $this->precioDolares = $this->precioDolares ? $this->precioDolares->pivot?->precio : 0;
            foreach ($servicio->itinerarios as $i => $itinerario) {
                $this->incluye[$i] = $itinerario->incluyes->pluck('id');
                $this->noincluye[$i] = $itinerario->noincluyes->pluck('id');
                $this->emit('EncontrarServicio', $this->servicioId, $this->incluye[$i], $this->noincluye[$i], $i);
            }
        }
    }

    public function agregarServicio()
    {
        $this->validate([
            'servicioId' => 'required|exists:servicios,id',
        ]);
        $servicio = Servicio::find($this->servicioId);
        $serviciospaquete = [
            'id' => $servicio->id,
            'servicio' => $servicio->titulo,
            'precioSoles' =>  $this->precioSoles,
            'precioDolares' => $this->precioDolares,
        ];

        $itinerarios = [];
        foreach ($this->itinerarios as $i => $itinerario) {
            $incluyes = [];
            $itinerari = [
                'dia' => $i + 1,
            ];
            foreach ($this->incluye[$i] as $id) {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $incluyes[] = $incluye;
            }
            $noincluyes = [];
            foreach ($this->noincluye[$i] as $id) {
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

        $serviciospaquete['itinerarios'] = $itinerarios;

        if ($this->servicioIdEditar != '') {
            $this->serviciospaquete[$this->servicioIdEditar] = $serviciospaquete;
        } else {
            $this->serviciospaquete[] = $serviciospaquete;
        }

        $this->emit('cerrarServicio');
        $this->totales();
    }

    public function reducirServicio($i)
    {
        unset($this->serviciospaquete[$i]);
        $this->totales();
    }

    public function editarServicio($i)
    {
        $this->servicioIdEditar = $i;
        $this->servicioId = $this->serviciospaquete[$i]['id'];
        $this->itinerarios = $this->serviciospaquete[$i]['itinerarios'];
        $this->precioSoles = $this->serviciospaquete[$i]['precioSoles'];
        $this->precioDolares = $this->serviciospaquete[$i]['precioDolares'];
        foreach ($this->itinerarios as $i => $itinerario) {
            $this->incluye[$i] = collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluye[$i] = collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarServicio', $this->servicioId, $this->incluye[$i], $this->noincluye[$i], $i);
        }
    }

    public function abrirHotel()
    {
        $this->hotelIdEditar = null;
        $this->hotelId = null;
        $this->noches = 1;
        $this->incluyeHotel = [];
        $this->noincluyeHotel = [];
        $this->itinerarios = [];
        $this->precioSolesHotel = 0;
        $this->precioDolaresHotel = 0;
        $this->emit('EncontrarHotel', $this->hotelId, null, null);
    }

    public function updatedhotelId($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio == "") {
            $this->hotelId = null;
            $this->incluyeHotel = [];
            $this->noincluyeHotel = [];
        } else {
            $this->hotelId = $servicio->id;
            $this->itinerarios = $servicio->itinerarios;
            $this->precioSolesHotel = $servicio->precios()->wherePivot('moneda_id', 1)->wherePivot('precio_id', 1)->first();
            $this->precioDolaresHotel = $servicio->precios()->wherePivot('moneda_id', 2)->wherePivot('precio_id', 1)->first();
            $this->precioSolesHotel = $this->precioSolesHotel ? $this->precioSolesHotel->pivot?->precio : 0;
            $this->precioDolaresHotel = $this->precioDolaresHotel ? $this->precioDolaresHotel->pivot?->precio : 0;
            foreach ($servicio->itinerarios as $i => $itinerario) {
                $this->incluyeHotel[$i] = $itinerario->incluyes->pluck('id');
                $this->noincluyeHotel[$i] = $itinerario->noincluyes->pluck('id');
                $this->emit('EncontrarHotel', $this->hotelId, $this->incluyeHotel[$i], $this->noincluyeHotel[$i], $i);
            }
        }
    }

    public function agregarHotel()
    {
        $this->validate([
            'hotelId' => 'required|exists:servicios,id',
            'noches' => 'required|min:1',
        ]);
        $servicio = Servicio::find($this->hotelId);
        $serviciospaquete = [
            'id' => $servicio->id,
            'noches' => $this->noches,
            'servicio' => $servicio->titulo,
            'precioSoles' => $this->precioSolesHotel,
            'precioDolares' => $this->precioDolaresHotel,
        ];

        $itinerarios = [];
        foreach ($this->itinerarios as $i => $itinerario) {
            $incluyes = [];
            $itinerari = [
                'dia' => $i + 1,
            ];
            foreach ($this->incluyeHotel[$i] as $id) {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $incluyes[] = $incluye;
            }
            $noincluyes = [];
            foreach ($this->noincluyeHotel[$i] as $id) {
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

        $serviciospaquete['itinerarios'] = $itinerarios;

        if ($this->hotelIdEditar != '') {
            $this->hotelespaquete[$this->hotelIdEditar] = $serviciospaquete;
        } else {
            $this->hotelespaquete[] = $serviciospaquete;
        }

        $this->emit('cerrarHotel');
        $this->totales();
    }

    public function reducirHotel($i)
    {
        unset($this->hotelespaquete[$i]);
        $this->totales();
    }

    public function editarHotel($i)
    {
        $this->hotelIdEditar = $i;
        $this->hotelId = $this->hotelespaquete[$i]['id'];
        $this->noches = $this->hotelespaquete[$i]['noches'];
        $this->itinerarios = $this->hotelespaquete[$i]['itinerarios'];
        $this->precioSolesHotel = $this->hotelespaquete[$i]['precioSoles'];
        $this->precioDolaresHotel = $this->hotelespaquete[$i]['precioDolares'];
        foreach ($this->itinerarios as $i => $itinerario) {
            $this->incluyeHotel[$i] = collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluyeHotel[$i] = collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarHotel', $this->hotelId, $this->incluyeHotel[$i], $this->noincluyeHotel[$i], $i);
        }
    }

    public function abrirVuelo()
    {
        $this->vueloIdEditar = null;
        $this->vueloId = null;
        $this->incluyeVuelo = [];
        $this->noincluyeVuelo = [];
        $this->itinerarios = [];
        $this->idavuelta = 1;
        $this->desde = null;
        $this->hasta = null;
        $this->desdevuelta = null;
        $this->hastavuelta = null;
        $this->precioSolesVuelo = 0;
        $this->precioDolaresVuelo = 0;
        $this->emit('EncontrarVuelo', $this->vueloId, null, null, null, null, null, null);
    }

    public function updatedVueloId($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio == "") {
            $this->vueloId = null;
            $this->incluyeVuelo = [];
            $this->noincluyeVuelo = [];
        } else {
            $this->vueloId = $servicio->id;
            $this->itinerarios = $servicio->itinerarios;
            $this->precioSolesVuelo = $servicio->precios()->wherePivot('moneda_id', 1)->wherePivot('precio_id', 1)->first();
            $this->precioDolaresVuelo = $servicio->precios()->wherePivot('moneda_id', 2)->wherePivot('precio_id', 1)->first();
            $this->precioSolesVuelo = $this->precioSolesVuelo ? $this->precioSolesVuelo->pivot?->precio : 0;
            $this->precioDolaresVuelo = $this->precioDolaresVuelo ? $this->precioDolaresVuelo->pivot?->precio : 0;
            foreach ($servicio->itinerarios as $i => $itinerario) {
                $this->incluyeVuelo[$i] = $itinerario->incluyes->pluck('id');
                $this->noincluyeVuelo[$i] = $itinerario->noincluyes->pluck('id');
                $this->emit('EncontrarVuelo', $this->vueloId, $this->incluyeVuelo[$i], $this->noincluyeVuelo[$i], null, null, null, null,);
            }
        }
    }

    public function agregarVuelo()
    {
        $this->validate([
            'vueloId' => 'required|exists:servicios,id',
        ]);
        $servicio = Servicio::find($this->vueloId);
        $serviciospaquete = [
            'id' => $servicio->id,
            'servicio' => $servicio->titulo,
            'idavuelta' => $this->idavuelta,
            'desde' => $this->desde,
            'hasta' => $this->hasta,
            'desdevuelta' => $this->desdevuelta,
            'hastavuelta' => $this->hastavuelta,
            'precioSoles' => $this->precioSolesVuelo,
            'precioDolares' => $this->precioDolaresVuelo,
        ];

        $itinerarios = [];
        foreach ($this->itinerarios as $i => $itinerario) {
            $incluyes = [];
            $itinerari = [
                'dia' => $i + 1,
            ];
            foreach ($this->incluyeVuelo[$i] as $id) {
                $servicio = Servicio::find($id);
                $incluye = [
                    'id' => $servicio->id,
                    'servicio' => $servicio->titulo
                ];
                $incluyes[] = $incluye;
            }
            $noincluyes = [];
            foreach ($this->noincluyeVuelo[$i] as $id) {
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

        $serviciospaquete['itinerarios'] = $itinerarios;

        if ($this->vueloIdEditar != '') {
            $this->vuelospaquete[$this->vueloIdEditar] = $serviciospaquete;
        } else {
            $this->vuelospaquete[] = $serviciospaquete;
        }

        $this->emit('cerrarVuelo');
        $this->totales();
    }

    public function reducirVuelo($i)
    {
        unset($this->vuelospaquete[$i]);
        $this->totales();
    }

    public function editarVuelo($i)
    {
        $datainlcuye = Servicio::select('id', 'titulo as text')->where('incluye', 1)->where('categoria_id', 3)->get();
        $datainlcuye = $datainlcuye->toArray();
        $this->vueloIdEditar = $i;
        $this->vueloId = $this->vuelospaquete[$i]['id'];
        $this->itinerarios = $this->vuelospaquete[$i]['itinerarios'];
        $this->idavuelta = $this->vuelospaquete[$i]['idavuelta'];
        $this->desde = $this->vuelospaquete[$i]['desde'];
        $this->hasta = $this->vuelospaquete[$i]['hasta'];
        $this->desdevuelta = $this->vuelospaquete[$i]['desdevuelta'];
        $this->hastavuelta = $this->vuelospaquete[$i]['hastavuelta'];
        $this->precioSolesVuelo = $this->vuelospaquete[$i]['precioSoles'];
        $this->precioDolaresVuelo = $this->vuelospaquete[$i]['precioDolares'];
        foreach ($this->itinerarios as $i => $itinerario) {
            $this->incluyeVuelo[$i] = collect($itinerario['incluye'])->pluck('id')->toArray();
            $this->noincluyeVuelo[$i] = collect($itinerario['noincluye'])->pluck('id')->toArray();
            $this->emit('EncontrarVuelo', $this->vueloId, $this->incluyeVuelo[$i], $this->noincluyeVuelo[$i], $this->desde, $this->hasta, $this->desdevuelta, $this->hastavuelta);
        }
    }

    public function totales()
    {
        $totalsoles = 0;
        $totaldolares = 0;

        foreach ($this->serviciospaquete as $paquete) {
            $totalsoles += $paquete['precioSoles'];
            $totaldolares += $paquete['precioDolares'];
        }
        foreach ($this->hotelespaquete as $paquete) {
            $totalsoles += $paquete['precioSoles'] * $paquete['noches'];
            $totaldolares += $paquete['precioDolares'] * $paquete['noches'];
        }
        foreach ($this->vuelospaquete as $paquete) {
            $totalsoles += $paquete['precioSoles'];
            $totaldolares += $paquete['precioDolares'];
        }
        $this->total_soles = $totalsoles;
        $this->total_dolares = $totaldolares;
    }

    public function registrarPaquete()
    {
        $this->validate([
            'titulo'              =>    'required|max:250',
            'serviciospaquete'         =>    'required',
        ], [
            'serviciospaquete.required' => 'El paquete debe tener al menos un servicio',
        ]);

        $mytime = Carbon::now('America/Lima');
        $paquete = Paquete::find($this->paqueteIdUpdate);

        if (!$paquete) {
            $paquete = new Paquete();
            $paquete->fecha_registro        = now('America/Lima');
        }

        $paquete->titulo                =  $this->titulo;
        $paquete->mensaje_bienvenida    =  $this->mensaje_bienvenida;
        $paquete->descripcion           =  $this->descripcion;
        $paquete->precio_soles          =  $this->total_soles;
        $paquete->precio_dolares        =  $this->total_dolares;
        $ultimoPaquete = Paquete::orderBy('id', 'desc')->count();
        $ultimoid = $ultimoPaquete + 1;

        if ($this->imagenprincipal) {
            $imagen = Image::make($this->imagenprincipal->getRealPath());
            $nombreArchivo = 'paquetes/' . Str::slug('paquete-' . $ultimoid, '-') . '.' . $this->imagenprincipal->getClientOriginalExtension();
            $imagen->save(storage_path('app/public/' . $nombreArchivo));
            $paquete->img_principal = $nombreArchivo;
        } else {
            if ($this->paqueteIdUpdate) {
                list($nombre, $extension) = explode(".", $this->originalImagenPrincipal);
                $nombreArchivo = 'paquetes/' . Str::slug('paquete-' . $ultimoid, '-') . '.' . $extension;
                Storage::copy($this->originalImagenPrincipal, $nombreArchivo);
                $paquete->img_principal = $nombreArchivo;
            } else {
                $paquete->img_principal = 'paquetes/default.png';
            }
        }
        if ($this->imagensecundario) {
            $imagen = Image::make($this->imagensecundario->getRealPath());
            $nombreArchivo = 'paquetes/' . Str::slug('paquete-secundario-' . $ultimoid, '-') . '.' . $this->imagensecundario->getClientOriginalExtension();
            $imagen->save(storage_path('app/public/' . $nombreArchivo));
            $paquete->img_secundario = $nombreArchivo;
        } else {
            if ($this->paqueteIdUpdate) {
                list($nombre, $extension) = explode(".", $this->originalImagenSecundario);
                $nombreArchivo = 'paquetes/' . Str::slug('paquete-secundario-' . $ultimoid, '-') . '.' . $extension;
                Storage::copy($this->originalImagenSecundario, $nombreArchivo);
                $paquete->img_secundario = $nombreArchivo;
            } else {
                $paquete->img_secundario = 'paquetes/default-secundario.png';
            }
        }
        $paquete->video                 =  $this->video;
        $paquete->publico               =  1;
        $paquete->estado                =  1;
        $paquete->user_id               =  \Auth::user()->id;
        $paquete->save();


        foreach ($paquete->detalles as $detalle) {
            foreach ($detalle->itinerarios as $itinerario) {
                $itinerario->incluyes()->detach();
                $itinerario->noincluyes()->detach();
                $itinerario->delete();
            }
            $detalle->delete();
        }

        foreach ($this->serviciospaquete as $reserva) {
            $detallePaquete = DetallePaquete::create([
                'paquete_id'    => $paquete->id,
                'servicio_id'   => $reserva['id'],
                'dia_servicio'  => 1,
                'preciosoles'   => $reserva['precioSoles'],
                'preciodolares' => $reserva['precioDolares'],
                'tipo'          => 1,
                'adulto'        => 0,
            ]);

            foreach ($reserva['itinerarios'] as $itinerario) {
                $ite = new ItinerarioPaquete();
                $ite->dia = $itinerario['dia'];
                $ite->detalle_paquete_id = $detallePaquete->id;
                $ite->save();
                foreach ($itinerario['incluye'] as $incluye) {
                    $ite->incluyes()->attach($incluye['id']);
                }

                foreach ($itinerario['noincluye'] as $noincluye) {
                    $ite->noincluyes()->attach($noincluye['id']);
                }
            }
        }
        foreach ($this->hotelespaquete as $reserva) {
            $detallePaquete = DetallePaquete::create([
                'paquete_id'    => $paquete->id,
                'servicio_id'   => $reserva['id'],
                'preciosoles'   => $reserva['precioSoles'],
                'preciodolares' => $reserva['precioDolares'],
                'paxservicionacional'           => $reserva['noches'],
            ]);

            foreach ($reserva['itinerarios'] as $itinerario) {
                $ite = new ItinerarioPaquete();
                $ite->dia = $itinerario['dia'];
                $ite->detalle_paquete_id = $detallePaquete->id;
                $ite->save();
                foreach ($itinerario['incluye'] as $incluye) {
                    $ite->incluyes()->attach($incluye['id']);
                }

                foreach ($itinerario['noincluye'] as $noincluye) {
                    $ite->noincluyes()->attach($noincluye['id']);
                }
            }
        }
        foreach ($this->vuelospaquete as $reserva) {

            $detallePaqueteData = [
                'paquete_id'        => $paquete->id,
                'servicio_id'       => $reserva['id'],
                'preciosoles'       => $reserva['precioSoles'],
                'preciodolares'     => $reserva['precioDolares'],
                'tipo'              => $reserva['idavuelta'] ? 1 : 0,
                'descripcion'       => $reserva['idavuelta'] ? 'IDA ('.$reserva['desde'].'/'.$reserva['hasta'].') - VUELTA ('.$reserva['desdevuelta'].'/'.$reserva['hastavuelta'].') ': 'IDA ('.$reserva['desde'].'/'.$reserva['hasta'].') ',
            ];
            $detallePaquete = DetallePaquete::create($detallePaqueteData);

            foreach ($reserva['itinerarios'] as $itinerario) {
                $ite = new ItinerarioPaquete();
                $ite->dia = $itinerario['dia'];
                $ite->detalle_paquete_id = $detallePaquete->id;
                $ite->save();
                foreach ($itinerario['incluye'] as $incluye) {
                    $ite->incluyes()->attach($incluye['id']);
                }

                foreach ($itinerario['noincluye'] as $noincluye) {
                    $ite->noincluyes()->attach($noincluye['id']);
                }
            }
        }
        return redirect()->route('paquete.index')
            ->with('success', 'Paquete Agregado Correctamente.');
    }
}
