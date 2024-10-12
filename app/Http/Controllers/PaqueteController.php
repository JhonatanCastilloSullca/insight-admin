<?php

namespace App\Http\Controllers;

use App\Mail\ReservaMailable;
use App\Mail\ReservaSinFechaMailable;
use App\Models\DetalleReserva;
use App\Models\ItinerarioReserva;
use App\Models\Pago;
use App\Models\Paquete;
use App\Models\PdfDatos;
use App\Models\Medio;
use App\Models\Moneda;
use App\Models\Reserva;
use App\Models\Notificacion;
use App\Models\Operar;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use App\Models\Servicio;
use App\Models\Total;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PDF;
use Ilovepdf\Ilovepdf;



class PaqueteController extends Controller
{
    public function index()
    {
        $paquetes = Paquete::orderBy('id', 'desc')->get();
        $monedas = Moneda::all();
        $i = 0;
        return view('pages.paquete.index', compact('paquetes', 'i','monedas'));
    }
    public function facturacion()
    {
        $pdfdatos = PdfDatos::first();
        $customPaper = array(0, 0, 297, 167);
        $pdf = \PDF::loadView('pages.pdf.facturacion');
        $pdf->setPaper($customPaper);
        return $pdf->stream('Facturacion.pdf');
    }

    public function create()
    {
        return view('pages.paquete.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Paquete $paquete)
    {
        $datospdf = PdfDatos::first();
        $llavepublica =  '50167321:testpublickey_2eWfX0SWpBMyvhNevh03othBCbRXliCa3EakDzU08J9yZ';

        $authorizacion = base64_encode('50167321:testpassword_sK98LBjpDxPxCXqK4NICaU7ZbzW9v7phEGoetoXvSr1Bp');
        $token = Http::withHeaders([
            'Authorization' => 'Basic ' . $authorizacion,
            'Accept' => 'application/json'
        ])
            ->post('https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment', [
                'amount' => 100,
                'currency' => 'USD',
                'orderId' => 1,
                'customer' => [
                    'reference' => 124,
                    'email' => 'dmirandatarco@gmail.com',
                    'billingDetails' => [
                        'firstName' => 'DAVID MIRANDA',
                    ],
                ]
            ])->object();

        $formToken =  $token->answer->formToken;
        $moneda = 1;
        $monto = 0;
        return view('pages.paquete.show', compact('paquete', 'formToken', 'moneda', 'monto', 'llavepublica', 'datospdf'));
    }

    public function link(Request $request)
    {
        $datospdf = PdfDatos::first();
        $paquete = Paquete::find($request->id_paquete_crear);
        $auto = $request->medio_id == 1 ? '16615905:testpassword_xEAx2CWlfFehi4yckYFakihUYgvptq9VbEs0MrKxPxnUM' : '50167321:testpassword_sK98LBjpDxPxCXqK4NICaU7ZbzW9v7phEGoetoXvSr1Bp';
        // $auto='58211388:testpassword_5XaqW3unjbzaQtvQrpixbtljiUr4RtZaFGNLYaLRccCOy';
        $llavepublica =  $request->medio_id == 1 ? '16615905:testpublickey_Z9kQZGUQ5QyAg4eaCXzLObGeeVtAe3dVrojqKIVq3mAwx' : '50167321:testpublickey_2eWfX0SWpBMyvhNevh03othBCbRXliCa3EakDzU08J9yZ';
        $authorizacion = base64_encode($auto);
        $token = Http::withHeaders([
            'Authorization' => 'Basic ' . $authorizacion,
            'Accept' => 'application/json'
        ])
            ->post('https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment', [
                'amount' => $request->monto * 100,
                'currency' => $request->medio_id == 1 ? 'PEN' : 'USD',
                'orderId' => $paquete->id,
                'customer' => [
                    'reference' => $paquete->id,
                    'email' => $paquete->pasajeros[0]->email,
                    'billingDetails' => [
                        'firstName' => $paquete->pasajeros[0]->nombres,
                    ],
                ]
            ])->object();

        $formToken =  $token->answer->formToken;
        $moneda = $request->medio_id;
        $monto = $request->monto;
        return view('pages.paquete.show', compact('paquete', 'formToken', 'moneda', 'monto', 'llavepublica', 'datospdf'));
    }

    public function cotizaciones()
    {
        $reservas = Reserva::orderBy('id', 'desc')->where('confirmado',0)->where('user_id',\Auth::user()->id)->get();
        $i=0;
        return view('pages.paquetes.cotizaciones',compact('reservas','i'));
    }

    public function viewcliente(Paquete $paquete)
    {
        $datospdf = PdfDatos::first();

        $moneda = 1;
        $monto = 0;
        return view('pages.paquete.viewcliente', compact('paquete', 'moneda', 'monto', 'datospdf'));
    }
    public function edit(Paquete $paquete)
    {

        return view('pages.paquete.edit', compact('paquete'));
    }

    public function update(Request $request, Paquete $paquete)
    {
        //
    }

    public function duplicar($id)
    {
        $paqueteOriginal = Paquete::with('detalles', 'detalles.itinerarios', 'detalles.itinerarios.incluyes', 'detalles.itinerarios.noincluyes')->findOrFail($id);

        // Clonar el paquete original
        $nuevoPaquete = $paqueteOriginal->replicate();
        $nuevoPaquete->titulo = $paqueteOriginal->titulo . ' DUPLICADO'; // Ajustar el título del nuevo paquete
        $nuevoPaquete->save();

        // Clonar los detalles del paquete
        foreach ($paqueteOriginal->detalles as $detalle) {
            $nuevoDetalle = $detalle->replicate();
            $nuevoDetalle->paquete_id = $nuevoPaquete->id; // Asociar el nuevo detalle al nuevo paquete
            $nuevoDetalle->save();

            // Clonar los itinerarios del detalle
            foreach ($detalle->itinerarios as $itinerario) {
                $nuevoItinerario = $itinerario->replicate();
                $nuevoItinerario->detalle_paquete_id = $nuevoDetalle->id; // Asociar el nuevo itinerario al nuevo detalle
                $nuevoItinerario->save();

                // Clonar los elementos "incluyes" del itinerario
                foreach ($itinerario->incluyes as $incluye) {
                    $nuevoItinerario->incluyes()->attach($incluye->id); // Asociar los elementos "incluyes" duplicados
                }

                // Clonar los elementos "noincluyes" del itinerario
                foreach ($itinerario->noincluyes as $noincluye) {
                    $nuevoItinerario->noincluyes()->attach($incluye->id); // Asociar los elementos "noincluyes" duplicados
                }
            }
        }
        return redirect()->route('paquete.index')->with('success', 'Paquete duplicado correctamente');
    }

    public function pdf(Paquete $id)
    {
        $pdf = PDF::loadView('pages.pdf.paquetepdf1', ['paquete' => $id]);
        $pdf->setPaper('a4', 'landscape');
        $pdfFilePath = storage_path('app/public/tempfile.pdf');
        file_put_contents($pdfFilePath, $pdf->output());
        $ilovepdf = new Ilovepdf('project_public_d25e1a3dfab4e4fbc2ecbaa173a4f2ee_s54KC1103905230b9174b90eb9519794a872f', 'secret_key_fe7531320cfb737b3696a2e14095d1af_sOp1Bfcc2d32f91ee7b88bb9c41fec47dc1a8');
        $myTask = $ilovepdf->newTask('compress');
        $myTask->addFile($pdfFilePath);
        $myTask->execute();
        $myTask->download();
        $compressedPdfPath = public_path('tempfile.pdf');
        return response()->streamDownload(function () use ($compressedPdfPath, $pdfFilePath) {
            echo file_get_contents($compressedPdfPath);
            unlink($compressedPdfPath);
            unlink($pdfFilePath);
        }, 'paquete.pdf');
    }
    public function pdfvista(Paquete $id)
    {
        $customPaper = array(0, 0, 297, 167);
        $pdf = \PDF::loadView('pages.pdf.paquetepdf', ['paquete' => $id]);
        $pdf->setPaper($customPaper);
        return $pdf->stream($id->titulo.'.pdf');
    }

    public function pdfvistaprecio(Request $request)
    {
        $moneda = Moneda::find($request->moneda_id);
        $paquete = Paquete::find($request->id_enviar);
        $customPaper = array(0, 0, 297, 167);
        $pdf = \PDF::loadView('pages.pdf.paquetepdfprecio', compact('paquete','moneda'));
        $pdf->setPaper($customPaper);
        return $pdf->stream($paquete->titulo.'.pdf');
    }

    public function inventariospdf($proyecto2, $insumo2)
    {
        $inventarios = Almacen::when($insumo2, function ($query) use ($insumo2) {
            $query->where('insumo_id', '=', $insumo2);
        })->when($proyecto2, function ($query) use ($proyecto2) {
            $query->where('proyecto_id', '=', $proyecto2);
        })->get();

        $pdf = \PDF::loadView('pages.pdf.reportes.inventariospdf', compact('proyecto2', 'insumo2', 'inventarios'))->setPaper('a4', 'landscape');
        return $pdf->stream('Reporte Inventarios.pdf');
    }


    public function destroy(Request $request)
    {
        $paquete = Paquete::find($request->id_paquete_2);
        try {
            DB::beginTransaction();
            foreach ($paquete->images as $image) {
                Storage::delete('paquetes/' . $image->nombre);
                $image->delete();
            }
            if ($paquete->img_principal) {
                Storage::delete('public/' . $paquete->img_principal);
            }
            foreach($paquete->detalles as $detalle){
                foreach($detalle->itinerarios as $itinerario){
                    $itinerario->incluyes()->detach();
                    $itinerario->noincluyes()->detach();
                    $itinerario->delete();
                }
                $detalle->delete();
            }
            $paquete->cuotas()->delete();
            $paquete->delete();
            DB::commit();
            return redirect()->route('paquete.index')
                ->with('success', 'Paquete eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('paquete.index')
                ->with('success', 'Error al eliminar el paquete: ' . $e->getMessage());
        }
    }

    public function agradecimiento(Request $request)
    {
        $mytime = Carbon::now('America/Lima');

        if ($request->get('kr-hash-algorithm') !== 'sha256_hmac') {
            throw new \Exception('Invilid hash algorithm');
        }

        $data = json_decode($request->get('kr-answer'));
        if ($data->orderStatus == "PAID") {
            $moneda_pay = $data->orderDetails->orderCurrency == 'USD' ? 2 : 1;
            $paquete = Paquete::find($data->orderDetails->orderId);
            $reserva = new Reserva();
            $reserva->user_id = $paquete->user_id;
            $reserva->fecha = $mytime->toDateTimeString();
            $reserva->observacion = '';
            $reserva->paquete_id = $paquete->id;
            $reserva->save();

            foreach ($paquete->detallestours as $detalle) {
                if ($detalle->preciosoles > 0 && $detalle->paxservicionacional > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 1;
                    $detallereserva->fecha_viaje = $detalle->fecha_viaje;
                    $detallereserva->fecha_viajefin = $detalle->fecha_viajefin;
                    $detallereserva->pax = $detalle->paxservicionacional;
                    $detallereserva->precio = $detalle->preciosoles;
                    $detallereserva->tipo = $detalle->tipo;
                    $detallereserva->adulto = $detalle->adulto;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach ($detalle->detallesIncluidos as $incluye) {
                        $detallereserva->incluyes()->attach($incluye->id);
                    }

                    foreach ($detalle->detallesNoIncluidos as $noincluye) {
                        $detallereserva->noincluyes()->attach($noincluye->id);
                    }
                }

                if ($detalle->preciodolares > 0 && $detalle->paxservicioextranjero > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 2;
                    $detallereserva->fecha_viaje = $detalle->fecha_viaje;
                    $detallereserva->fecha_viajefin = $detalle->fecha_viajefin;
                    $detallereserva->pax = $detalle->paxservicioextranjero;
                    $detallereserva->precio = $detalle->preciodolares;
                    $detallereserva->tipo = $detalle->tipo;
                    $detallereserva->adulto = $detalle->adulto;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach ($detalle->detallesIncluidos as $incluye) {
                        $detallereserva->incluyes()->attach($incluye->id);
                    }

                    foreach ($detalle->detallesNoIncluidos as $noincluye) {
                        $detallereserva->noincluyes()->attach($noincluye->id);
                    }
                }
            }

            foreach ($paquete->detalleshoteles as $detalle) {
                if ($detalle->preciosoles > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 1;
                    $detallereserva->fecha_viaje = $detalle->fecha_viaje;
                    $detallereserva->fecha_viajefin = $detalle->fecha_viajefin;
                    $detallereserva->pax = $detalle->paxservicionacional;
                    $detallereserva->precio = $detalle->preciosoles;
                    $detallereserva->tipo = $detalle->tipo;
                    $detallereserva->adulto = $detalle->adulto;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach ($detalle->detallesIncluidos as $incluye) {
                        $detallereserva->incluyes()->attach($incluye->id);
                    }

                    foreach ($detalle->detallesNoIncluidos as $noincluye) {
                        $detallereserva->noincluyes()->attach($noincluye->id);
                    }
                }

                if ($detalle->preciodolares > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 2;
                    $detallereserva->fecha_viaje = $detalle->fecha_viaje;
                    $detallereserva->fecha_viajefin = $detalle->fecha_viajefin;
                    $detallereserva->pax = $detalle->paxservicionacional;
                    $detallereserva->precio = $detalle->preciodolares;
                    $detallereserva->tipo = $detalle->tipo;
                    $detallereserva->adulto = $detalle->adulto;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach ($detalle->detallesIncluidos as $incluye) {
                        $detallereserva->incluyes()->attach($incluye->id);
                    }

                    foreach ($detalle->detallesNoIncluidos as $noincluye) {
                        $detallereserva->noincluyes()->attach($noincluye->id);
                    }
                }
            }

            foreach ($paquete->detallesvuelos as $detalle) {
                if ($detalle->preciosoles > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 1;
                    $detallereserva->fecha_viaje = $detalle->fecha_viaje;
                    $detallereserva->fecha_viajefin = $detalle->fecha_viajefin;
                    $detallereserva->pax = $detalle->paxservicionacional;
                    $detallereserva->precio = $detalle->preciosoles;
                    $detallereserva->tipo = $detalle->tipo;
                    $detallereserva->adulto = $detalle->adulto;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach ($detalle->detallesIncluidos as $incluye) {
                        $detallereserva->incluyes()->attach($incluye->id);
                    }

                    foreach ($detalle->detallesNoIncluidos as $noincluye) {
                        $detallereserva->noincluyes()->attach($noincluye->id);
                    }
                }

                if ($detalle->preciodolares > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 2;
                    $detallereserva->fecha_viaje = $detalle->fecha_viaje;
                    $detallereserva->fecha_viajefin = $detalle->fecha_viajefin;
                    $detallereserva->pax = $detalle->paxservicionacional;
                    $detallereserva->precio = $detalle->preciodolares;
                    $detallereserva->tipo = $detalle->tipo;
                    $detallereserva->adulto = $detalle->adulto;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach ($detalle->detallesIncluidos as $incluye) {
                        $detallereserva->incluyes()->attach($incluye->id);
                    }

                    foreach ($detalle->detallesNoIncluidos as $noincluye) {
                        $detallereserva->noincluyes()->attach($noincluye->id);
                    }
                }
            }

            if ($paquete->precio_soles > 0) {
                $montopago = 0;
                if ($moneda_pay == 1) {
                    $montopago = $data->orderDetails->orderTotalAmount / 100;
                }
                $total = Total::create([
                    'reserva_id' => $reserva->id,
                    'moneda_id' => 1,
                    'acuenta' => $montopago,
                    'saldo' => $paquete->precio_soles - $montopago,
                    'total' => $paquete->precio_soles,
                    'descuento' => 0,
                ]);
            }

            if ($paquete->precio_dolares > 0) {
                $montopago = 0;
                if ($moneda_pay == 2) {
                    $montopago = $data->orderDetails->orderTotalAmount / 100;
                }
                $total = Total::create([
                    'reserva_id' => $reserva->id,
                    'moneda_id' => 2,
                    'acuenta' => $montopago,
                    'saldo' => $paquete->precio_dolares - $montopago,
                    'total' => $paquete->precio_dolares,
                    'descuento' => 0,
                ]);
            }

            foreach ($paquete->pasajeros as $pasajero) {
                $reserva->pasajeros()->attach($pasajero->id);
            }

            $medio = Medio::firstOrCreate([
                'nombre' => 'IZIPAY',
                'banco' => 'IZIPAY',
                'moneda_id' => $moneda_pay,
            ], []);

            $pago = new Pago();
            $pago->user_id = $paquete->user_id;
            $pago->moneda_id = $moneda_pay;
            $pago->medio_id = $medio->id;
            $pago->reserva_id = $reserva->id;
            $pago->num_operacion = 1;
            $pago->fecha = $data->serverDate;
            $pago->monto = $data->orderDetails->orderTotalAmount / 100;
            $pago->num_operacion = $data->orderDetails->orderId;
            $pago->save();

            Mail::to($reserva->pasajeros[0]->email)->send(new ReservaMailable($reserva,null,null,null,null,null));
        }

        return view('pages.paquete.agradecimiento', compact('data'));
    }

    public function vender(Request $request)
    {
        try {
            DB::beginTransaction();
            $mytime = Carbon::now('America/Lima');
            $paquete = Paquete::find($request->id_paquete_crear);
            $reserva = Reserva::create([
                'user_id' => \Auth::user()->id,
                'fecha' => $mytime->toDateTimeString(),
                'observacion' => $request->tituloPaquete,
                'numero' => 0,
                'paquete_id' => $paquete->id,
                'descripcion' => $paquete->descripcion,
                'confirmado' => 0,
            ]);
            $totalsoles = 0;
            $totaldolares = 0;
            if ($request->fechaPaquete ) {
                $fecha = Carbon::parse($request->fechaPaquete);
                $fecha2 = Carbon::parse($request->fechaPaquete);
            }else{
                $fecha = null;
                $fecha2 = null;
            }
            $fechanueva = $fecha;
            foreach ($paquete->detallestours as $i => $detalle) 
            {
                if ($request->pax_nacional_adulto > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 1;
                    $detallereserva->pax = $request->pax_nacional_adulto;
                    $detallereserva->precio = $detalle->preciosoles;
                    $detallereserva->fecha_viaje = $fechanueva;
                    $detallereserva->tipo = 0;
                    $detallereserva->adulto = 1;
                    $detallereserva->precio_id = 1;
                    $detallereserva->orden = $i;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach($detalle->itinerarios as $itinerario){
                        $itinerarioNuevo = new ItinerarioReserva();
                        $itinerarioNuevo->dia = $itinerario->dia;
                        $itinerarioNuevo->detalle_reserva_id = $detallereserva->id;
                        $itinerarioNuevo->save();
                        foreach ($itinerario->incluyes as $incluye) {
                            $itinerarioNuevo->incluyes()->attach($incluye->id);
                        }

                        foreach ($itinerario->noincluyes as $incluye) {
                            $itinerarioNuevo->noincluyes()->attach($incluye->id);
                        }
                    }
                    $totalsoles += $request->pax_nacional_adulto * $detalle->preciosoles;
                }
                if ($request->pax_extranjero_adulto > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 2;
                    $detallereserva->pax = $request->pax_extranjero_adulto;
                    $detallereserva->precio = $detalle->preciodolares;
                    $detallereserva->fecha_viaje = $fechanueva;
                    $detallereserva->tipo = 0;
                    $detallereserva->adulto = 1;
                    $detallereserva->precio_id = 1;
                    $detallereserva->orden = $i;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach($detalle->itinerarios as $itinerario){
                        $itinerarioNuevo = new ItinerarioReserva();
                        $itinerarioNuevo->dia = $itinerario->dia;
                        $itinerarioNuevo->detalle_reserva_id = $detallereserva->id;
                        $itinerarioNuevo->save();
                        foreach ($itinerario->incluyes as $incluye) {
                            $itinerarioNuevo->incluyes()->attach($incluye->id);
                        }

                        foreach ($itinerario->noincluyes as $incluye) {
                            $itinerarioNuevo->noincluyes()->attach($incluye->id);
                        }
                    }
                    $totaldolares += $request->pax_extranjero_adulto * $detalle->preciodolares;
                }

                if($fechanueva){
                    $fechanueva = $fechanueva->addDay($detalle->servicio->duracion);
                }
            }
            $fechanueva2 = $fecha2;
            foreach ($paquete->detalleshoteles as $detalle) {
                $hotel = Proveedor::find($detalle->servicio->proveedor_id);
                list($checkinHour, $checkinMinute, $checkinSecond) = explode(':', $hotel->checkinn);
                list($checkoutHour, $checkoutMinute, $checkoutSecond) = explode(':', $hotel->checkout);
                if ($request->pax_nacional_adulto > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 1;
                    $detallereserva->pax = 1;
                    $detallereserva->precio = $detalle->preciosoles;
                    $detallereserva->fecha_viaje = $fechanueva2 ? $fechanueva2->setTime($checkinHour,$checkinMinute,$checkinSecond) : null;
                    $detallereserva->fecha_viajefin = $fechanueva2 ? $fechanueva2->clone()->addDays($detalle->paxservicionacional)->setTime($checkoutHour,$checkoutMinute,$checkoutSecond) : null;
                    $detallereserva->tipo = 0;
                    $detallereserva->adulto = 1;
                    $detallereserva->equipaje = $detalle->paxservicionacional;
                    $detallereserva->precio_id = 1;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach($detalle->itinerarios as $itinerario){
                        $itinerarioNuevo = new ItinerarioReserva();
                        $itinerarioNuevo->dia = $itinerario->dia;
                        $itinerarioNuevo->detalle_reserva_id = $detallereserva->id;
                        $itinerarioNuevo->save();
                        foreach ($itinerario->incluyes as $incluye) {
                            $itinerarioNuevo->incluyes()->attach($incluye->id);
                        }

                        foreach ($itinerario->noincluyes as $incluye) {
                            $itinerarioNuevo->noincluyes()->attach($incluye->id);
                        }
                    }
                    $totalsoles += 1 * $detalle->preciosoles * $detalle->paxservicionacional;
                }

                if ($request->pax_extranjero_adulto > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 2;
                    $detallereserva->pax = 1;
                    $detallereserva->precio = $detalle->preciodolares;
                    $detallereserva->fecha_viaje = $fechanueva2 ? $fechanueva2->setTime($checkinHour,$checkinMinute,$checkinSecond) : null;
                    $detallereserva->fecha_viajefin = $fechanueva2 ? $fechanueva2->clone()->addDays($detalle->paxservicionacional)->setTime($checkoutHour,$checkoutMinute,$checkoutSecond) : null;
                    $detallereserva->tipo = 0;
                    $detallereserva->adulto = 1;
                    $detallereserva->equipaje = $detalle->paxservicionacional;
                    $detallereserva->precio_id = 1;
                    $detallereserva->comentarios = '';
                    $detallereserva->save();

                    foreach($detalle->itinerarios as $itinerario){
                        $itinerarioNuevo = new ItinerarioReserva();
                        $itinerarioNuevo->dia = $itinerario->dia;
                        $itinerarioNuevo->detalle_reserva_id = $detallereserva->id;
                        $itinerarioNuevo->save();
                        foreach ($itinerario->incluyes as $incluye) {
                            $itinerarioNuevo->incluyes()->attach($incluye->id);
                        }

                        foreach ($itinerario->noincluyes as $incluye) {
                            $itinerarioNuevo->noincluyes()->attach($incluye->id);
                        }
                    }
                }
                $totaldolares += 1 * $detalle->preciodolares * $detalle->paxservicionacional;

                if($fechanueva2){
                    $fechanueva2 = $fechanueva2->addDay($detalle->paxservicionacional);
                }
            }
            foreach ($paquete->detallesvuelos as $detalle) {
                if ($request->pax_nacional_adulto > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 1;
                    $detallereserva->pax = $request->pax_nacional_adulto;
                    $detallereserva->precio = $detalle->preciosoles;
                    $detallereserva->tipo = 0;
                    $detallereserva->adulto = 1;
                    $detallereserva->comentarios = '';
                    $detallereserva->descripcion = $detalle->descripcion;
                    $detallereserva->save();
                    foreach($detalle->itinerarios as $itinerario){
                        $itinerarioNuevo = new ItinerarioReserva();
                        $itinerarioNuevo->dia = $itinerario->dia;
                        $itinerarioNuevo->detalle_reserva_id = $detallereserva->id;
                        $itinerarioNuevo->save();
                        foreach ($itinerario->incluyes as $incluye) {
                            $itinerarioNuevo->incluyes()->attach($incluye->id);
                        }

                        foreach ($itinerario->noincluyes as $incluye) {
                            $itinerarioNuevo->noincluyes()->attach($incluye->id);
                        }
                    }
                    $totalsoles += $request->pax_nacional_adulto * $detalle->preciosoles;
                }
                if ($request->pax_extranjero_adulto > 0) {
                    $detallereserva = new DetalleReserva();
                    $detallereserva->reserva_id = $reserva->id;
                    $detallereserva->servicio_id = $detalle->servicio_id;
                    $detallereserva->moneda_id = 2;
                    $detallereserva->pax = $request->pax_extranjero_adulto;
                    $detallereserva->precio = $detalle->preciodolares;
                    $detallereserva->tipo = 0;
                    $detallereserva->adulto = 1;
                    $detallereserva->comentarios = '';
                    $detallereserva->descripcion = $detalle->descripcion;
                    $detallereserva->save();
                    foreach($detalle->itinerarios as $itinerario){
                        $itinerarioNuevo = new ItinerarioReserva();
                        $itinerarioNuevo->dia = $itinerario->dia;
                        $itinerarioNuevo->detalle_reserva_id = $detallereserva->id;
                        $itinerarioNuevo->save();
                        foreach ($itinerario->incluyes as $incluye) {
                            $itinerarioNuevo->incluyes()->attach($incluye->id);
                        }

                        foreach ($itinerario->noincluyes as $incluye) {
                            $itinerarioNuevo->noincluyes()->attach($incluye->id);
                        }
                    }
                    $totaldolares += $request->pax_extranjero_adulto * $detalle->preciodolares;
                }
            }
            if ($totalsoles > 0) {
                $montopago = 0;
                $total = Total::create([
                    'reserva_id' => $reserva->id,
                    'moneda_id' => 1,
                    'acuenta' => $montopago,
                    'saldo' => $totalsoles - $montopago,
                    'total' => $totalsoles,
                    'descuento' => 0,
                ]);
            }
            if ($totaldolares > 0) {
                $montopago = 0;
                $total = Total::create([
                    'reserva_id' => $reserva->id,
                    'moneda_id' => 2,
                    'acuenta' => $montopago,
                    'saldo' => $totaldolares - $montopago,
                    'total' => $totaldolares,
                    'descuento' => 0,
                ]);
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('reserva.sinconfirmar')
            ->with('success', 'Reserva Agregado Correctamente.');
    }

    public function notificar(Reserva $reserva)
    {
        // $pdf= \PDF::loadView('pages.pdf.pdfvoucher',compact('reserva'))->setPaper('a4');
        // $pdfData = $pdf->output();
        // $pdfName = $reserva->pasajeroprincipal()->nombreCompleto . '-' . date("d-m-Y", strtotime($reserva->fecha)) . '.pdf';
        // $customPaper = array(0, 0, 297, 167);
        // $pdf2= \PDF::loadView('pages.pdf.pdfitinerario', ['reser' => $reserva])->setPaper($customPaper);
        // $pdfData2 = $pdf2->output();
        // $pdfName2 = 'ITINERARIO: RESERVA Nº '.$reserva->numero. '.pdf';
        $pasajeros = $reserva->pasajeros()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->get();

        foreach ($pasajeros as $pasajero) {
            Mail::mailer('ventas')->to($pasajero->email)->queue(new ReservaMailable($reserva, $pasajero));
        }

        $reserva->correo = 1;
        $reserva->save();

        return redirect()->back()
            ->with('success', 'Correo enviandose...');
    }

    public function notificarsincofirmar(Reserva $reserva)
    {
        // $pdf= \PDF::loadView('pages.pdf.pdfvoucher',compact('reserva'))->setPaper('a4');
        // $pdfData = $pdf->output();
        // $pdfName = $reserva->pasajeroprincipal()->nombreCompleto . '-' . date("d-m-Y", strtotime($reserva->fecha)) . '.pdf';
        // $customPaper = array(0, 0, 297, 167);
        // $pdf2= \PDF::loadView('pages.pdf.pdfitinerario', ['reser' => $reserva])->setPaper($customPaper);
        // $pdfData2 = $pdf2->output();
        // $pdfName2 = 'ITINERARIO: RESERVA Nº '.$reserva->numero. '.pdf';
        $pasajeros = $reserva->pasajeros()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->get();

        foreach ($pasajeros as $pasajero) {
            Mail::mailer('ventas')->to($pasajero->email)->queue(new ReservaSinFechaMailable($reserva, $pasajero));
        }

        $reserva->correo = 1;
        $reserva->save();

        return redirect()->back()
            ->with('success', 'Correo enviandose...');
    }

    public function calendariohotel(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        // Obtiene la fecha actual
        if(!$request->searchFechaInicio){
            $fechaActual = Carbon::now();
        }else{
            $fechaActual = Carbon::parse($fechaInicio2);
        }
        
        $fechaInicio = $fechaActual->copy()->subDays(13);
        $fechaFin = $fechaActual->copy()->addDays(14);
        $fechas = [];
        $numeroDia = [
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
            'domingo' => 7,
        ];
        $numeroDiaInicio = $numeroDia[strtolower($fechaInicio->isoFormat('dddd'))] - 1;
        while ($fechaInicio->lte($fechaFin)) {
            $fecha = $fechaInicio->copy();
            $detalleReserva = DetalleReserva::join('servicios', 'servicios.id', '=', 'detalle_reservas.servicio_id')
            ->join('categorias', 'servicios.categoria_id', '=', 'categorias.id')
            ->join('reservas', 'reservas.id', '=', 'detalle_reservas.reserva_id')
            ->where('detalle_reservas.estado', 1)
            ->where('reservas.confirmado', 1)
            ->where('categorias.id', 2)
            ->whereDate('detalle_reservas.fecha_viaje', '<=',$fecha->toDateString())
            ->whereDate('detalle_reservas.fecha_viajefin', '>',$fecha->toDateString())
            ->select('detalle_reservas.*', 'reservas.confirmado as reserva_confirmado') // Seleccionar campos con alias si es necesario
            ->get();
            
            $fechas[] = [
                'fecha' => $fecha,
                'detalle' => $detalleReserva,
            ];
            $fechaInicio->addDay();
        }
        $hoteles = Proveedor::select('id', 'nombre as text')->where('categoria_id', 2)->get();
        return view('pages.paquete.calendariohotel', compact('fechaInicio', 'fechaFin', 'fechas', 'numeroDiaInicio', 'fechaActual', 'hoteles'));
    }
    public function calendariotours(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        // Obtiene la fecha actual
        if(!$request->searchFechaInicio){
            $fechaActual = Carbon::now();
        }else{
            $fechaActual = Carbon::parse($fechaInicio2);
        }
        $fechaInicio = $fechaActual->copy()->subDays(0);
        $fechaFin = $fechaActual->copy()->addDays(7);
        $fechas = [];
        $numeroDia = [
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
            'domingo' => 7,
        ];
        $numeroDiaInicio = $numeroDia[strtolower($fechaInicio->isoFormat('dddd'))] - 1;
        while ($fechaInicio->lte($fechaFin)) {
            $fecha = $fechaInicio->copy();
            $detalleReserva = DetalleReserva::select('detalle_reservas.servicio_id', DB::raw('SUM(detalle_reservas.pax) as totalPax'), 'servicios.color', 'servicios.categoria_id','servicios.titulo', 'detalle_reservas.tipo', 'detalle_reservas.operado')
                ->join('servicios', 'servicios.id', '=', 'detalle_reservas.servicio_id')
                ->join('reservas', 'reservas.id', '=', 'detalle_reservas.reserva_id')
                ->where('detalle_reservas.estado', 1)
                ->where('reservas.confirmado', 1)
                ->whereIn('servicios.categoria_id', [5, 6])
                ->whereDate('detalle_reservas.fecha_viaje', $fecha->toDateString())
                ->groupBy('detalle_reservas.servicio_id', 'servicios.color', 'servicios.titulo','servicios.categoria_id' ,'detalle_reservas.tipo','detalle_reservas.operado')
                ->get()
                ->toArray();

                foreach ($detalleReserva as $index => $detail) {
                    if ($detail['operado'] == 1) {
                        if ($detail['categoria_id'] == 5) {
                            $operar = Operar::whereDate('fecha', $fecha->toDateString())
                                ->where('operado', 1);

                            $servis = Servicio::find($detail['servicio_id']);

                            $operar = $operar->where('servicio_id',$detail['servicio_id'])->orWhere('servicio_id',$servis->servicio_id)->first();
                            $detalleReserva[$index]['operar_id'] = $operar ? $operar->id : null;
                        } elseif ($detail['categoria_id'] == 6) {
                            $operar = OperarServicio::join('operars','operars.id','=','operar_servicios.operar_id')
                            ->whereDate('operars.fecha', $fecha->toDateString())->where('operars.traslado',1)
                            ->where('operar_servicios.servicio_id', $detail['servicio_id'])->first();
                            $detalleReserva[$index]['operar_id'] = $operar ? $operar->operar->id : null;
                        }
                    }else{
                        $detalleReserva[$index]['operar_id'] = null;
                    }
                }

            $fechas[] = [
                'fecha' => $fecha,
                'detalle' => $detalleReserva,
            ];
            $fechaInicio->addDay();
        }
        return view('pages.paquete.calendariotours', compact('fechaInicio', 'fechaFin', 'fechas', 'numeroDiaInicio', 'fechaActual'));
    }
    public function calendariovuelos(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        // Obtiene la fecha actual
        if(!$request->searchFechaInicio){
            $fechaActual = Carbon::now();
        }else{
            $fechaActual = Carbon::parse($fechaInicio2);
        }
        $fechaInicio = $fechaActual->copy()->subDays(13);
        $fechaFin = $fechaActual->copy()->addDays(14);
        $fechas = [];
        $numeroDia = [
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
            'domingo' => 7,
        ];
        $numeroDiaInicio = $numeroDia[strtolower($fechaInicio->isoFormat('dddd'))] - 1;
        while ($fechaInicio->lte($fechaFin)) {
            $fecha = $fechaInicio->copy();
            $detalleReserva = DetalleReserva::select('detalle_reservas.servicio_id', DB::raw('SUM(detalle_reservas.pax) as totalPax'), 'servicios.color', 'servicios.titulo', 'detalle_reservas.tipo','detalle_reservas.confirmado','detalle_reservas.id')
                ->join('servicios', 'servicios.id', '=', 'detalle_reservas.servicio_id')
                ->join('categorias', 'servicios.categoria_id','=','categorias.id')
                ->join('reservas', 'reservas.id', '=', 'detalle_reservas.reserva_id')
                ->where('detalle_reservas.estado', 1)
                ->where('reservas.confirmado', 1)
                ->where('categorias.id', 3)
                ->whereDate('detalle_reservas.fecha_viaje', $fecha->toDateString())
                ->groupBy('detalle_reservas.servicio_id', 'servicios.color', 'servicios.titulo', 'detalle_reservas.tipo','detalle_reservas.confirmado','detalle_reservas.id')
                ->get()
                ->toArray();

            $fechas[] = [
                'fecha' => $fecha,
                'detalle' => $detalleReserva,
            ];
            $fechaInicio->addDay();
        }
        $aerolineas = Proveedor::select('id', 'nombre as text')->where('categoria_id', 3)->get();
        return view('pages.paquete.calendariovuelos', compact('aerolineas','fechaInicio', 'fechaFin', 'fechas', 'numeroDiaInicio', 'fechaActual'));
    }
}
