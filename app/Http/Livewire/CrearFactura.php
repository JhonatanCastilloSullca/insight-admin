<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Company;
use App\Models\DetalleVenta;
use App\Models\Document;
use App\Models\DocumentoSunat;
use App\Models\Venta;
use App\Services\SunatService;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use DB;
use Greenter\Report\XmlUtils;

class CrearFactura extends Component
{
    public $comprobante;

    public $pago;
    public $nombre;
    public $tipo_documento="DNI";
    public $num_documento;
    public $email;
    public $direccion;
    public $mensaje;
    public $moneda_id=1;

    public $cantidad;
    public $descripcion;
    public $precio;
    public $documento_id;
    public $documentos;

    public $total;

    public function mount($pago = null)
    {
        $this->pago = $pago;
        if($this->pago){
            $this->nombre = $pago->reserva->pasajeros[0]->nombres;
            $this->tipo_documento = $pago->reserva->pasajeros[0]->documento?->tipo_documento;
            $this->num_documento = $pago->reserva->pasajeros[0]->documento?->num_documento;
            $this->email = $pago->reserva->pasajeros[0]->email;
            $this->direccion = $pago->reserva->pasajeros[0]->pais->nombre;
            $this->cantidad =1;
            $this->moneda_id = $pago->moneda_id;
            $this->descripcion = $pago->reserva->descripcionFactura();
            $this->precio = $pago->monto;
            $this->total = $pago->monto;
        }
        $this->documentos = Document::where('nombre','!=','NOTA DE CRÉDITO')->get();
    }

    public function searchDocumento()
    {
        if ($this->tipo_documento == 'DNI') {
            $cliente = Cliente::where('num_documento', $this->num_documento)->first();
            if ($cliente) {
                $this->nombre = $cliente->nombre;
                $this->email = $cliente->email;
                $this->direccion = $cliente->direccion;
                $this->mensaje = '';
            } else {
                $this->searchDNIInAPI($this->num_documento);
                $this->mensaje = $cliente?->nombre ? '' : 'Este cliente no está registrado en nuestra base de datos DNI';
            }
        } elseif ($this->tipo_documento == 'RUC') {
            $cliente = Cliente::where('num_documento', $this->num_documento)->first();
            if ($cliente) {
                $this->nombre = $cliente->nombre;
                $this->email = $cliente->email;
                $this->direccion = $cliente->direccion;
                $this->mensaje = '';
            } else {
                $this->searchRUCInAPI($this->num_documento);
                $this->mensaje = $cliente?->nombre ? '' : 'Este cliente no está registrado en nuestra base de datos RUC';
            }
        }
    }

    public function searchInAPI($documento)
    {
        $length = strlen($documento);
        if ($length == 8) {
            $this->searchDNIInAPI($documento);
        } elseif ($length == 11) {
            $this->searchRUCInAPI($documento);
        } else {
            session()->flash('success', 'El número de documento debe tener 8 o 11 dígitos');
            $this->mensaje = '';
        }
    }

    public function searchDNIInAPI($dni)
    {
        $token = config('services.apisunat.token');
        $urldni = config('services.apisunat.urldni');
        $host = 'api.apis.net.pe';
        if (gethostbyname($host) == $host) {
            session()->flash('success', 'No hay conexión a Internet. Por favor, verifica tu conexión y vuelve a intentarlo.');
            $this->mensaje = '';
        } else {
            try {
                $response = Http::timeout(10)->withHeaders([
                    'Referer' => 'http://apis.net.pe/api-ruc',
                    'Authorization' => 'Bearer ' . $token
                ])->get($urldni . $dni);
                $persona = ($response->json());
                if (isset($persona['error']) || $persona == "") {
                    $this->num_documento = $dni;
                    if (isset($persona['error'])) {

                        session()->flash('success', 'Se necesita 8 digitos');
                        $this->nombre ="";
                        $this->direccion = '';
                        $this->mensaje ="";
                    }
                    if ($persona == "") {
                        session()->flash('success', 'No se encontro datos');
                        $this->mensaje="";
                    }
                    $this->mensaje="";
                } else {
                    $this->mensaje ="";
                    $this->nombre = $persona['nombre'];
                    $this->direccion = $persona['direccion'];
                }
            } catch (RequestException $e) {
                if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                    session()->flash('success', 'Se ha superado el límite de tiempo de la solicitud. Por favor, inténtalo de nuevo más tarde.');
                    $this->mensaje = '';
                } else {
                    session()->flash('success', 'Ocurrió un error al consumir la API:');
                    $this->mensaje = '';
                }
            }
        }
    }

    public function searchRUCInAPI($ruc)
    {
        $token = config('services.apisunat.token');
        $urlruc = config('services.apisunat.urlruc');
        $host = 'api.apis.net.pe';

        if (gethostbyname($host) == $host) {
            session()->flash('success', 'No hay conexión a Internet. Por favor, verifica tu conexión y vuelve a intentarlo.');
            $this->mensaje = '';
        } else {
            try {
                $response = Http::timeout(10)->withHeaders([
                    'Referer' => 'http://apis.net.pe/api-ruc',
                    'Authorization' => 'Bearer ' . $token
                ])->get($urlruc . $ruc);

                $persona = ($response->json());

                if ($persona == "" || isset($persona['error'])) {
                    $this->nombre = "";
                    $this->direccion = '';
                    if ($persona['error'] == "RUC invalido") {
                        session()->flash('success', 'RUC invalido');
                        $this->mensaje = '';
                    }
                    if ($persona['error'] == "RUC debe contener 11 digitos") {
                        session()->flash('success', 'RUC debe contener 11 digitos');
                        $this->mensaje = '';
                    }
                } else {
                    $this->mensaje ="";

                    $this->nombre = $persona['nombre'];
                    $this->direccion = $persona['direccion'];
                }
            } catch (RequestException $e) {
                if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                    session()->flash('success', 'Se ha superado el límite de tiempo de la solicitud. Por favor, inténtalo de nuevo más tarde.');
                    $this->mensaje = '';
                } else {
                    session()->flash('success', 'Ocurrió un error al consumir la API:');
                    $this->mensaje = '';
                }
            }
        }
    }

    public function validarventa()
    {
        $this->validate([
            'documento_id'          => 'required',
            'tipo_documento'        => 'required',
            'num_documento'         => 'required|max:15',
            'nombre'                => 'required|max:250',
            'direccion'             => 'nullable|max:250',
            'email'                 => 'nullable|email|max:250',
            'cantidad'              => 'required|numeric|min:1',
            'descripcion'           => 'required',
            'moneda_id'             => 'required|exists:monedas,id',
            'precio'                => 'required|numeric|min:1',
        ]);
    }

    public function registrarVenta()
    {
        $this->validarventa();

        try
        {
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
            $documento = Document::find($this->documento_id);
            $documento->cantidad = $documento->incremento + $documento->cantidad;
            $documento->save();
            $codSunat = $this->tipo_documento == 'DNI' ? 1 : ($this->tipo_documento == 'RUC' ? 6 : ($this->tipo_documento == 'PASAPORTE' ? 7 : 4 ));
            $cliente=Cliente::updateOrCreate([
                'nombre' => $this->nombre,
                'tipo_documento' => $this->tipo_documento,
                'num_documento' => $this->num_documento,
            ],[
                'sunat' => $codSunat,
                'email' => $this->email,
                'direccion' => $this->direccion,
            ]);
            $venta = new Venta();
            if($this->pago){
                $venta->reserva_id = $this->pago->reserva_id;
            }
            $venta->cliente_id = $cliente->id;
            $venta->user_id = \Auth::user()->id;
            $venta->medio_id = $this->moneda_id == 1 ? 1 : 2;
            $venta->document_id = $this->documento_id;
            $venta->nume_doc = $documento->cantidad;
            $venta->fecha = $mytime->toDateTimeString();
            $venta->total = $this->precio;
            $venta->nume_doc = $documento->cantidad;
            $venta->save();

            $detalle = DetalleVenta::create([
                'venta_id' => $venta->id,
                'descripcion' => $this->descripcion,
                'cantidad' => $this->cantidad,
                'precio' => $this->precio,
            ]);

            $company = Company::find(1); 
            $totales = collect([
                'MtoOperGravadas' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                'MtoIGV' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                'TotalImpuestos' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                'ValorVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                'SubTotal' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
                'MtoImpVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
            ]);

            $sunat = new SunatService();
            $see = $sunat->getSee($company);
            $invoice = $sunat->getInvoice($company,$documento,$venta,$totales);

            $result = $see->send($invoice);

            $response['xml'] = $see->getFactory()->getLastXml();
            $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
            $response['sunatResponse'] = $sunat->sunatResponse($result);
            $documentoSunat = DocumentoSunat::create([
                'xml' => $response['xml'],
                'hash' => $response['hash'],
                'respuesta' => $response['sunatResponse']['success'],
                'codeError' => $response['sunatResponse']['error']['code'] ?? null,
                'messageError' => $response['sunatResponse']['error']['message'] ?? null,
                'cdrZip' => $response['sunatResponse']['cdrZip'] ?? null,
                'codeCdr' => $response['sunatResponse']['cdrResponse']['code'] ?? null,
                'descripcionCdr' => $response['sunatResponse']['cdrResponse']['descripcion'] ?? null,
                'notesCdr' => isset($response['sunatResponse']['cdrResponse']['notes']) 
                                ? json_encode($response['sunatResponse']['cdrResponse']['notes'])
                                : null,
                'venta_id' => $venta->id,
            ]);

            if($response['sunatResponse']['success']){
                $venta->sunat = 1;
                $venta->save();
                if($this->pago){
                    $this->pago->facturado = 1;
                    $this->pago->save();
                }
            }else{
                $venta->sunat = 0;
                $venta->save();
            }

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        $this->emit('abrirVenta', $venta->id);        
        return redirect()->route('facturacion.lista')
            ->with('success', 'Guardado Correctamente.');
    }

    public function render()
    {
        return view('livewire.crear-factura');
    }
}
