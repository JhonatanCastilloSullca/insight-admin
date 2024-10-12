<?php

namespace App\Http\Controllers;

use App\Exports\PasajerosExports;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContabilidadController extends Controller
{
    public function lista(Request $request)
    {
        $reserva_id = $request->searchReserva;
        $reservaDetallada = Reserva::find($reserva_id);
        $reservas = Reserva::all();
        $i=0;
        return view('pages.contabilidad.lista',compact('i','reservaDetallada','reserva_id','reservas'));
    }

    public function pasajerosexports(Request $request)
    {
        $reserva = Reserva::find($request->id);
        return Excel::download(new PasajerosExports($reserva), 'plantilla-'.$reserva->numero.'-'.date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)).'.xlsx');
    }

    public function utilidad(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $reservas = [];
        }else{
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            $reservas = $reservas->get();
        }
        $i = 0;
        return view('pages.contabilidad.utilidad', compact('reservas', 'i','fechaInicio2','fechaFin2'));
    }
}
