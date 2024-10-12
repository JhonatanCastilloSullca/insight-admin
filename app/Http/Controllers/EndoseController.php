<?php

namespace App\Http\Controllers;

use App\Models\Operar;
use Illuminate\Http\Request;

class EndoseController extends Controller
{
    public function index(Request $request)
    {
        $i = 0;
        $endoses = Operar::where('endose',1)->orderBy('fecha','desc')->get();
        return view('pages.endose.index',compact('endoses','i'));
    }

    public function create()
    {
        return view('pages.endose.create');
    }

    public function editar($endose)
    {
        $endose = Operar::find($endose);
        return view('pages.endose.editar',compact('endose'));
    }

    public function ver($endose)
    {
        $operar = Operar::find($endose);
        $agencia = $operar->operarServicios->first();
        return view('pages.endose.ver',compact('operar','agencia'));
    }

    public function pdf($endose)
    {
        $operar = Operar::find($endose);
        $agencia = $operar->operarServicios->first();
        $pdf = \PDF::loadView('pages.pdf.endose', compact('operar','agencia'))->setPaper('a4', 'landscape');
        return $pdf->download('Endose ' . $agencia->proveedor->nombre . '.pdf');
    }

    public function whatsapp(Request $request)
    {
        $operar = Operar::find($request->endose);
        $fecha = date("d-m-Y",strtotime($operar->fecha));
        $mensaje = "🌍Tour: 🌄 *{$operar->servicio->titulo}* 🌄 \n";
        $mensaje .= "📅Fecha: *{$fecha}*\n\n";

        foreach ($operar->detalles as $detalle) {
            $nombreCompleto = $detalle->detalleReserva?->reserva?->pasajeroprincipal()->nombreCompleto ?? '';
            $pais = $detalle->detalleReserva?->reserva?->pasajeroprincipal()->pais->nombre ?? '';
            $hotel = $detalle->detalleReserva?->hotel?->nombre.' '.$detalle->detalleReserva?->hotel?->direccion ?? '';
            $celular = $detalle->detalleReserva?->reserva?->pasajeroprincipal()->celular ?? '';
            $totalpax = $detalle->detalleReserva?->pax ?? 0;
            $hora = $detalle->recojo ? date("h:i a",strtotime($detalle->recojo)) : null;

            $mensaje .= "👤*Pax:* {$nombreCompleto} (x{$totalpax})\n";
            $mensaje .= "🇺🇸*Pais:* {$pais}\n";
            $mensaje .= "📱*Celular:* {$celular}\n";
            $mensaje .= "🏨*Hotel:* {$hotel}\n";
            $mensaje .= "💰*Ingresos:* {$detalle->ingresos}\n";
            $mensaje .= "🕒*Hora:* {$hora}\n";
            $mensaje .= "📝*Observacion:* {$detalle->observacion}\n\n";
        }

        $mensajeCodificado = urlencode($mensaje);

        // Construcción del enlace de WhatsApp
        $urlWhatsapp = "https://api.whatsapp.com/send/?text={$mensajeCodificado}";

        return redirect()->to($urlWhatsapp);
    }
}
