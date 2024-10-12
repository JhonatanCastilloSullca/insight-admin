<?php

namespace App\Http\Controllers;

use App\Models\Operar;
use Illuminate\Http\Request;

class MachupicchuController extends Controller
{
    public function operacionmachupicchu(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;

        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }
        $operaciones = Operar::whereHas('servicio', function ($query) {
            $query->where('categoria_id', 5);
        })->orderBy('created_at','desc')->where('machupicchu',1)->whereBetween('fecha', [$fechaInicio2, $fechaFin2]);
        $operaciones = $operaciones->get();
        $i = 0;
        return view('pages.operar.machupicchu.index', compact('operaciones', 'i','fechaInicio2','fechaFin2'));
    }

    public function createmachupicchu()
    {
        return view('pages.operar.machupicchu.create');
    }

    public function showmachupicchu($operacion)
    {
        $operacion = Operar::find($operacion);
        return view('pages.operar.machupicchu.show',compact('operacion'));
    }

    public function machupicchupdf($operacion)
    {
        $operacion = Operar::find($operacion);
        $pdf = \PDF::loadView('pages.pdf.machupicchu', compact('operacion'))->setPaper('a4', 'landscape');
        return $pdf->download('Operacion '. $operacion->servicio->titulo .' - '.date("d-m-Y",strtotime($operacion->fecha)).'.pdf');
    }

    public function whatsappoperacionmachupicchu(Request $request)
    {
        $operar = Operar::find($request->operacion_id);
        $fecha = date("d-m-Y",strtotime($operar->fecha));
        $mensaje = "Tour: *{$operar->servicio->titulo} - {$fecha}*\n\n";

        foreach ($operar->operarServicios as $detalle) {
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
}
