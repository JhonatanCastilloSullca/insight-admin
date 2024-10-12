<?php

namespace App\Http\Controllers;

use App\Models\Operar;
use App\Models\Proveedor;
use App\Models\DetalleReserva;
use Illuminate\Http\Request;
use App\Mail\HotelMailable;
use App\Mail\VueloMailable;
use App\Models\OperarDetalleReserva;
use App\Models\OperarServicio;
use App\Models\Reserva;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PDF;
use Ilovepdf\Ilovepdf;
use Carbon\Carbon;

class OperarController extends Controller
{
    public function operaciontraslado(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $proveedor = $request->searchProveedor;

        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchProveedor){
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
            $operaciones = Operar::orderBy('fecha', 'desc')->where('traslado',1)->whereDate('fecha',$fechaInicio2);
        }else{
            $operaciones = Operar::orderBy('fecha', 'desc')->where('traslado',1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $operaciones = $operaciones->whereBetween('fecha', [$request->searchFechaInicio, $fechaFin]);
            }
            if ($request->filled('searchProveedor')) {
                $operaciones = $operaciones->whereHas('operarServicios', function ($query) use ($proveedor) {
                    $query->where('proveedor_id', $proveedor);
                });
            }
        }
        $operaciones = $operaciones->get();
        $proveedores = Proveedor::where('categoria_id',13)->orderBy('nombre','asc')->get();
        $i = 0;
        return view('pages.operar.traslados.operaciontraslado', compact('operaciones', 'i','proveedores','fechaInicio2','fechaFin2','proveedor'));
    }

    public function operacionhotel(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $proveedor = $request->searchProveedor;

        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchProveedor){
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
            $operaciones = Operar::orderBy('fecha', 'desc')->where('hotel',1)->whereDate('fecha',$fechaInicio2);
        }else{
            $operaciones = Operar::orderBy('fecha', 'desc')->where('hotel',1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $operaciones = $operaciones->whereBetween('fecha', [$request->searchFechaInicio, $fechaFin]);
            }
            if ($request->filled('searchProveedor')) {
                $operaciones = $operaciones->whereHas('operarServicios', function ($query) use ($proveedor) {
                    $query->where('proveedor_id', $proveedor);
                });
            }
        }
        $operaciones = $operaciones->get();
        $proveedores = Proveedor::whereRelation('categoria','categoria_id',2)->orderBy('nombre','asc')->get();
        $i = 0;
        return view('pages.operar.hotel.operacionhotel', compact('operaciones', 'i','fechaInicio2','fechaFin2','proveedor','proveedores'));
    }

    public function operaciontours(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;

        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
            $operaciones = Operar::whereHas('servicio', function ($query) {
                $query->where('categoria_id', 5);
            })->whereHas('operarServicios', function ($query){
                return $query->where('tipo',0);
            })->orderBy('created_at','desc')->where('operado',1)->whereDate('fecha',$fechaInicio2);
        }
        else{
            $operaciones = Operar::whereHas('servicio', function ($query) {
                $query->where('categoria_id', 5);
            })->whereHas('operarServicios', function ($query){
                return $query->where('tipo',0);
            })->orderBy('created_at','desc')->where('operado',1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $operaciones = $operaciones->whereBetween('fecha', [$request->searchFechaInicio, $fechaFin]);
            }
        }
        $operaciones = $operaciones->get();
        $i = 0;
        return view('pages.operar.operaciontours', compact('operaciones', 'i','fechaInicio2','fechaFin2'));
    }

    public function operacionvuelos()
    {
        $operaciones = Operar::whereHas('servicio', function ($query) {
            $query->where('categoria_id', 3);
        })->get();
        $i = 0;
        return view('pages.operar.operacionvuelos', compact('operaciones', 'i'));
    }

    public function operacionotros()
    {
        $operaciones = Operar::whereHas('servicio', function ($query) {
            $query->where('categoria_id', 3);
        })->get();
        $i = 0;
        return view('pages.operar.operacionvuelos', compact('operaciones', 'i'));
    }

    public function createtours($servicio = null, $fecha = null, $endose = 0)
    {
        return view('pages.operar.createtours', compact('servicio', 'fecha', 'endose'));
    }

    public function editaroperaciontours($operar)
    {
        $operar = Operar::find($operar);
        return view('pages.operar.editartours', compact('operar'));
    }

    public function createtoursendose($servicio = null, $fecha = null, $endose = 1)
    {
        //

        return view('pages.operar.createtours', compact('endose', 'servicio', 'fecha'));
    }
    
    public function createvuelos()
    {
        //
        $operaciones = DetalleReserva::whereHas('servicio', function ($query) {
            $query->where('categoria_id', 3);
        })->where('estado', 1)->get();
        $i = 0;
        return view('pages.operar.createvuelos', compact('operaciones', 'i'));
    }

    public function createhotel(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;

        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $fechaFin2 = Carbon::today()->toDateString();
            $fechaInicio2 = Carbon::today()->subDays(7)->toDateString();
            $operaciones = DetalleReserva::orderBy('fecha_viaje', 'desc')
            ->whereRelation('servicio','categoria_id',2 )->whereRelation('reserva','confirmado',1)->whereBetween('fecha_viaje',[$fechaInicio2, $fechaFin2]);
        }else{
            $operaciones = DetalleReserva::orderBy('fecha_viaje', 'desc')->whereRelation('servicio','categoria_id',2 )->whereRelation('reserva','confirmado',1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $operaciones = $operaciones->whereBetween('fecha_viaje', [$request->searchFechaInicio, $fechaFin]);
            }
        }
        $operaciones = $operaciones->get();
        $i = 0;
        return view('pages.operar.hotel.createhotel', compact('operaciones', 'i','fechaInicio2','fechaFin2'));
    }

    public function createhotelreserva(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;

        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $fechaFin2 = Carbon::today()->toDateString();
            $fechaInicio2 = Carbon::today()->subDays(7)->toDateString();
            $operaciones = DetalleReserva::join('reservas', 'detalle_reservas.reserva_id', '=', 'reservas.id')
            ->join('servicios', 'detalle_reservas.servicio_id', '=', 'servicios.id')
            ->where('servicios.categoria_id', 2)
            ->where('reservas.confirmado', 1)
            ->whereBetween('reservas.fecha', [$fechaInicio2.' 00:00:00', $fechaFin2.' 23:59:59'])
            ->orderBy('reservas.fecha', 'desc')
            ->select('detalle_reservas.*');
        }else{
            $operaciones = DetalleReserva::join('reservas', 'detalle_reservas.reserva_id', '=', 'reservas.id')
            ->join('servicios', 'detalle_reservas.servicio_id', '=', 'servicios.id')
            ->where('servicios.categoria_id', 2)
            ->where('reservas.confirmado', 1)
            ->orderBy('reservas.fecha', 'desc')
            ->select('detalle_reservas.*');
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $operaciones = $operaciones->whereHas('reserva', function ($query) use ($fechaInicio2,$fechaFin2) {
                    $query->whereBetween('fecha', [$fechaInicio2.' 00:00:00', $fechaFin2.' 23:59:59']);
                });
            }
        }
        $operaciones = $operaciones->get();
        $i = 0;
        return view('pages.operar.hotel.createhotelreserva', compact('operaciones', 'i','fechaInicio2','fechaFin2'));
    }

    public function notificarvuelo(DetalleReserva $reserva)
    {
        if ($reserva->reserva->pasajeros()->exists()) {
            Mail::to($reserva->reserva->pasajeros[0]->email)->send(new VueloMailable($reserva));
            return redirect()->route('operacion.vuelos')->with('success', 'Correo Enviado Exitosamente.');
        } else {
            return redirect()->route('operacion.vuelos')->with('success', 'No se encontró un pasajero registrado.');
        }
    }

    public function vuelonumero(Request $request)
    {
        $detalleReserva = DetalleReserva::find($request->id);
        if (!$detalleReserva) {
            return redirect()->route('operacion.vuelonumero')->with('error', 'No se encontró la reserva.');
        }
        $detalleReserva->update([
            'confirmado'      => '1',
        ]);
        $operar = Operar::create([
            'cantidad_pax'      => 1,
            'fecha'             => $detalleReserva->fecha_viaje,
            'servicio_id'       => $detalleReserva->servicio_id,
            'user_id'           => \Auth::id(),
            'precio'            => $request->precio,
            'operado'           => '1',
            'estado'            => '1',
        ]);

        OperarDetalleReserva::create([
            'operar_id' => $operar->id,
            'detalle_reserva_id' => $request->id,
            'recojo'  => '10:00:00',
            'ingresos' => 0,
        ]);

        $operacion = OperarServicio::create([
            'operar_id' => $operar->id,
            'servicio_id' => $detalleReserva->servicio_id,
            'proveedor_id' => $request->hotel_id,
            'precio' => $request->precio,
            'observacion' => '',
            'tipo' => 0,
        ]);
        return redirect()->route('calendario.vuelos')->with('success', 'Numero de Vuelo agregado.');
    }

    public function hotelnumero(Request $request)
    {
        $detalleReserva = DetalleReserva::find($request->id);
        if (!$detalleReserva) {
            return redirect()->route('operacion.hotel')->with('error', 'No se encontró la reserva.');
        }
        $detalleReserva->update([
            'confirmado'      => '1',
        ]);

        $operar = Operar::create([
            'cantidad_pax'      => $detalleReserva->pax,
            'fecha'             => $detalleReserva->fecha_viaje,
            'servicio_id'       => $detalleReserva->servicio_id,
            'user_id'           => \Auth::id(),
            'precioSoles'       => 0,
            'precioDolares'     => 0,
            'operado'           => '0',
            'estado'            => '0',
        ]);

        OperarDetalleReserva::create([
            'operar_id' => $operar->id,
            'detalle_reserva_id' => $request->id,
            'recojo'  => '10:00:00',
            'ingresos' => 0,
            'cantidad' => $detalleReserva->pax,
            'noches' => $detalleReserva->equipaje,
        ]);

        $operacion = OperarServicio::create([
            'operar_id' => $operar->id,
            'servicio_id' => $detalleReserva->servicio_id,
            'proveedor_id' => $detalleReserva->servicio->proveedor_id,
            'precio' => 0,
            'observacion' => '',
            'tipo' => 0,
        ]);

        if ($request->notificacion == 1) {
            // Preparar el mensaje para enviar por WhatsApp
            $mensaje = "Estimado equipo del " . $detalleReserva->servicio->proveedor?->nombre . ",\n\n"
            . "Reciban un cordial saludo de parte de la Agencia de Viajes Cuzco Travel. Nos dirigimos a ustedes para solicitar la reserva de las siguientes habitaciones:\n\n"
            . "Tipo de Habitación: " . $detalleReserva->servicio->titulo . "\n"
            . "Incluye:\n";

            // Agregar los elementos incluidos en los itinerarios
            foreach ($detalleReserva->servicio->itinerarios as $itinerario) {
                foreach ($itinerario->incluyes as $incluye) {
                    $mensaje .= "- " . $incluye->titulo . "\n";
                }
            }

            // Agregar detalles adicionales
            $mensaje .= "\nPasajero: " . $detalleReserva->reserva->pasajeroprincipal()?->nombreCompleto . "\n"
                . "Check-in: " . date("m-d-Y", strtotime($detalleReserva->fecha_viaje)) . "\n"
                . "Check-out: " . date("m-d-Y", strtotime($detalleReserva->fecha_viajefin)) . "\n\n"
                . "Agradecemos su atención y esperamos su confirmación a la brevedad posible.";

            // Codificar el mensaje para URL
            $mensaje = urlencode($mensaje);

            // Limpiar el número de teléfono del proveedor
            $telefono = $detalleReserva->servicio->proveedor?->celular ?? '51926561020'; // Número de prueba
            // Eliminar el signo "+" y los espacios en el número de teléfono
            $telefono = preg_replace('/[^0-9]/', '', $telefono); // Mantener solo números

            // Crear el enlace completo para WhatsApp
            $link = 'https://api.whatsapp.com/send/?phone=' . $telefono . '&text=' . $mensaje . '&type=phone_number&app_absent=0';

            // Redireccionar al usuario a la URL de WhatsApp
            return redirect()->back()->with('whatsapp_link', $link);
        }
        if($request->notificacion==2){
            // Mail::to($operacion->proveedor->email)->send(new HotelMailable($detalleReserva));
        }

        return redirect()->back()->with('success', 'Correo Enviado.');
    }

    public function hotelconfirmar(Request $request)
    {
        $detalleReserva = DetalleReserva::find($request->id_confirmar);
        if (!$detalleReserva) {
            return redirect()->route('calendario.hotel')->with('error', 'No se encontró la reserva.');
        }

        $operar = $detalleReserva->detallesoperar->operar;
        if($request->moneda_id == 1){
            $operar->precioSoles = $request->costo;
        }else{
            $operar->precioDolares = $request->costo;
        }
        $operar->save();

        $operacion = OperarServicio::where('operar_id',$detalleReserva->detallesoperar->operar->id)
        ->where('servicio_id',$detalleReserva->servicio_id)->where('proveedor_id',$detalleReserva->servicio->proveedor_id)->first();
        $operacion->moneda_id = $request->moneda_id;
        $operacion->precio = $request->costo;
        $operacion->save();
        $detalleReserva->update([
            'confirmado'      => '2',
        ]);

        return redirect()->route('calendario.hotel')->with('success', 'Hotel Confirmado.');
    }

    public function vueloconfirmar(Request $request)
    {
        $detalleReserva = DetalleReserva::find($request->id_confirmar);
        if (!$detalleReserva) {
            return redirect()->route('calendario.vuelos')->with('error', 'No se encontró la reserva.');
        }
        $detalleReserva->update([
            'confirmado'      => '2',
            'operado'      => '1',
        ]);

        return redirect()->route('calendario.vuelos')->with('success', 'Vuelo Confirmado.');
    }

    public function operarshowtour(Operar $operar)
    {
        return view('pages.operar.operarshowtour', compact('operar'));
    }

    public function pdf(Operar $operar)
    {
        $pdf = \PDF::loadView('pages.pdf.operar-tour', compact('operar'))->setPaper('a4', 'landscape');
        return $pdf->download('Operacion '. $operar->servicio->titulo .' - '.date("d-m-Y",strtotime($operar->fecha)).'.pdf');
    }

    public function pdfrestaurant(Operar $operar)
    {
        $operar = $operar->operarServicios->where('servicio.categoria_id',14)->first();
        $pdf = \PDF::loadView('pages.pdf.operar-tour-restaurant', compact('operar'))->setPaper('a4');
        return $pdf->download('Operacion '. $operar->servicio->titulo .' - '.date("d-m-Y",strtotime($operar->operar->fecha)).'.pdf');
    }

    public function crearoperacionhotel(Request $request)
    {
        $reserva = Reserva::find($request->reserva);
        return view('pages.operar.hotel.crearoperacionhotel',compact('reserva'));
    }

    public function agregarpagohotel(Request $request)
    {
        $reserva = Reserva::find($request->reserva);
        return view('pages.operar.hotel.agregarpagohotel',compact('reserva'));
    }

    public function realizarpagohotel(Request $request)
    {
        $reserva = Reserva::find($request->reserva);
        return view('pages.operar.hotel.realizarpagohotel',compact('reserva'));
    }

    public function verhotel(Request $request)
    {
        $reserva = Reserva::find($request->reserva);
        $operar = $reserva->operarHotel;
        return view('pages.operar.hotel.verhotel',compact('operar'));
    }

    public function editaroperacionhotel(Request $request)
    {
        $reserva = Reserva::find($request->reserva);
        return view('pages.operar.hotel.editaroperacionhotel',compact('reserva'));
    }

    public function crearoperaciontraslado()
    {
        return view('pages.operar.traslados.crearoperaciontraslado');
    }

    public function editaroperaciontraslado(Operar $operacion)
    {
        return view('pages.operar.traslados.editaroperaciontraslado',compact('operacion'));
    }

    public function veroperaciontraslado(Operar $operacion)
    {
        return view('pages.operar.traslados.veroperaciontraslado',compact('operacion'));
    }

    public function descargaroperaciontraslado(Operar $operacion)
    {
        $pdf = \PDF::loadView('pages.pdf.operar-traslado', compact('operacion'))->setPaper('a4', 'landscape');
        return $pdf->stream('Operacion ' . $operacion->fecha . '.pdf');
    }

    public function whatsappoperaciontraslado(Request $request)
    {
        $proveedor = Proveedor::find($request->proveedor_id);
        $servicios = OperarServicio::where('operar_id',$request->operacion_id)->where('proveedor_id',$request->proveedor_id)->get();
        $mensaje = "Estimado *{$proveedor->nombre}*\n\n";

        foreach ($servicios as $servicio) {
            $fecha = isset($servicio->detalleReserva->fecha_viaje) ? date('d-m-Y', strtotime($servicio->detalleReserva->fecha_viaje)) : '';
            $hora = isset($servicio->recojo) ? date("h:i a", strtotime($servicio->recojo)) : '';
            $nombreCompleto = $servicio->detalleReserva->reserva->pasajeroprincipal()->nombreCompleto ?? '';
            
            $hotel = $servicio->detalleReserva->hotel?->nombre ?? '';
            $telefonoPasajero = $servicio->detalleReserva->reserva->pasajeroprincipal()?->celular ?? '';
            $nacionalidad = $servicio->detalleReserva->reserva->pasajeroprincipal()?->pais->nombre ?? '';

            $mensaje .= "*Fecha:* {$fecha}\n";
            $mensaje .= "*Servicio:* {$servicio->servicio->titulo}\n";
            $mensaje .= "*Nombre y Apellido:* {$nombreCompleto}\n";
            $mensaje .= "*Cant.:* {$servicio->cantidad}\n";
            $mensaje .= "*Hotel:* {$hotel}\n";
            $mensaje .= "*Teléfono:* {$telefonoPasajero}\n";
            $mensaje .= "*Nacionalidad:* {$nacionalidad}\n";
            $mensaje .= "*Hora Recojo:* {$hora}\n";
            $mensaje .= "*Observaciones:* {$servicio->observacion}\n\n";
        }

        $mensajeCodificado = urlencode($mensaje);

        // Construcción del enlace de WhatsApp
        $urlWhatsapp = "https://api.whatsapp.com/send/?text={$mensajeCodificado}&type=phone_number";

        return redirect()->to($urlWhatsapp);
    }

    public function whatsappoperaciontour(Request $request)
    {
        $operar = Operar::find($request->operacion_id);
        $fecha = date("d-m-Y",strtotime($operar->fecha));
        $mensaje = "Tour: *{$operar->servicio->titulo} - {$fecha}*\n\n";

        foreach ($operar->detalles as $detalle) {
            $nombreCompleto = $detalle->detalleReserva?->reserva?->pasajeroprincipal()->nombreCompleto ?? '';
            $celular = $detalle->detalleReserva?->reserva?->pasajeroprincipal()->celular ?? '';
            $totalpax = count($detalle->detalleReserva?->reserva?->pasajeros) ?? 0;

            $mensaje .= "*Pax:* {$nombreCompleto} (x{$totalpax})\n";
            $mensaje .= "*Celular:* {$celular}\n\n";
        }

        $mensajeCodificado = urlencode($mensaje);

        // Construcción del enlace de WhatsApp
        $urlWhatsapp = "https://api.whatsapp.com/send/?text={$mensajeCodificado}";

        return redirect()->to($urlWhatsapp);
    }

    public function notificarpdfoperaciontraslado(Request $request)
    {
        $proveedor = Proveedor::find($request->proveedor_id);
        $servicios = OperarServicio::where('operar_id',$request->operacion_id)->where('proveedor_id',$request->proveedor_id)->get();
        $pdf = \PDF::loadView('pages.pdf.operar-traslado-individual', compact('proveedor','servicios'))->setPaper('a4', 'landscape');
        return $pdf->download('Operacion ' . $proveedor->nombre . '.pdf');
    }

    public function operaciontrasladosemaforo(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;

        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $fechaFin2 = Carbon::today()->toDateString();
            $fechaInicio2 = Carbon::today()->subDays(7)->toDateString();
            $operaciones = DetalleReserva::orderBy('fecha_viaje', 'desc')->whereRelation('servicio','categoria_id',6)->whereRelation('reserva','confirmado',1)->whereBetween('fecha_viaje',[$fechaInicio2, $fechaFin2]);
        }else{
            $operaciones = DetalleReserva::orderBy('fecha_viaje', 'desc')->whereRelation('servicio','categoria_id',6)->whereRelation('reserva','confirmado',1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $operaciones = $operaciones->whereBetween('fecha_viaje', [$request->searchFechaInicio, $fechaFin]);
            }
        }
        $operaciones = $operaciones->get();
        $i = 0;
        return view('pages.operar.traslados.operaciontrasladosemaforo', compact('operaciones', 'i','fechaInicio2','fechaFin2'));
    }

    public function trasladosoverview(Request $request)
    {
        $operar = OperarServicio::find($request->id);
        $pasajero = $operar->detalleReserva->reserva->pasajeroprincipal()->nombreCompleto;
        $fecha = date("d-m-Y",strtotime($operar->operar->fecha));
        $hora = isset($operar->recojo) ? date("h:i a", strtotime($operar->recojo)) : '';

        $mensaje = "¡Hola, _*{$pasajero}*_! 👋\n\n";
        $mensaje .= "✨ Te recordamos que estaremos esperando por ti el _*{$fecha}*_ para llevar a cabo tu _*{$operar->servicio->titulo}*_. ✈️🏨\n\n" ;
        $mensaje .= "🔔 _Por favor, mantente atento y preparado para la hora {$hora}_.\n\n" ;
        $mensaje .= "Si tienes alguna duda o necesitas más información, no dudes en contactarnos. 📞💬.\n\n" ;
        $mensaje .= "¡Te esperamos! 😊" ;

        $mensajeCodificado = urlencode($mensaje);

        $telefono = preg_replace('/[^0-9]/', '', $operar->detalleReserva->reserva->pasajeroprincipal()->celular);

        // Construcción del enlace de WhatsApp
        $urlWhatsapp = "https://api.whatsapp.com/send/?phone={$telefono}&text={$mensajeCodificado}&type=phone_number";
        
        $operar->detalleReserva->overview =1;
        $operar->detalleReserva->save();

        return redirect()->to($urlWhatsapp);
    }
}
