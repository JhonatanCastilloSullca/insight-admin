<?php

namespace App\Http\Controllers;

use App\Exports\FailExport;
use App\Exports\ReservarExport;
use App\Exports\ToursExport;
use App\Models\DetalleReserva;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function reservas(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $counter = $request->searchCounter;
        $pasajero = $request->searchPasajero;
        $estado = $request->searchEstado;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchCounter && !$request->searchPasajero && !$request->searchEstado){
            $reservas = [];
        }else{
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCounter')) {
                $reservas = $reservas->where('user_id', $request->searchCounter);
            }
            if ($request->filled('searchPasajero')) {
                $nombreCompleto = strtoupper($request->searchPasajero);
    
                $reservas->whereHas('pasajeros', function ($query) use ($nombreCompleto) {
                    $query->whereRaw('UPPER(CONCAT(nombres, " ", apellidoPaterno, " ", apellidoMaterno)) LIKE ?', ["%$nombreCompleto%"]);
                });
            }
            if ($request->filled('searchEstado')) {
                $reservas = $reservas->where('estado', $request->searchEstado);
            }
            $reservas = $reservas->get();
        }
        $i = 0;
        $users = User::all();
        return view('pages.reportes.reservas', compact('reservas', 'i','users','fechaInicio2','fechaFin2','counter','pasajero','estado'));
    }

    public function reservaspdf(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $counter = $request->searchCounter;
        $pasajero = $request->searchPasajero;
        $estado = $request->searchEstado;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchCounter && !$request->searchPasajero && !$request->searchEstado){
            $reservas = [];
        }else{
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCounter')) {
                $reservas = $reservas->where('user_id', $request->searchCounter);
                $counter = User::find($request->searchCounter);
            }
            if ($request->filled('searchPasajero')) {
                $nombreCompleto = strtoupper($request->searchPasajero);
    
                $reservas->whereHas('pasajeros', function ($query) use ($nombreCompleto) {
                    $query->whereRaw('UPPER(CONCAT(nombres, " ", apellidoPaterno, " ", apellidoMaterno)) LIKE ?', ["%$nombreCompleto%"]);
                });
            }
            if ($request->filled('searchEstado')) {
                $reservas = $reservas->where('estado', $request->searchEstado);
            }
            $reservas = $reservas->get();
        }
        $i = 0;
        $pdf= \PDF::loadView('pages.pdf.reportes.reservaspdf',compact('i','reservas','fechaInicio2','fechaFin2','counter','pasajero','estado'))->setPaper('a4','landscape');
        return $pdf->download('REPORTE DE RESERVAS.pdf');
    }

    public function reservasexcel(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $counter = $request->searchCounter;
        $pasajero = $request->searchPasajero;
        $estado = $request->searchEstado;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchCounter && !$request->searchPasajero && !$request->searchEstado){
            $reservas = [];
        }else{
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCounter')) {
                $reservas = $reservas->where('user_id', $request->searchCounter);
                $counter = User::find($request->searchCounter);
            }
            if ($request->filled('searchPasajero')) {
                $nombreCompleto = strtoupper($request->searchPasajero);
                $reservas->whereHas('pasajeros', function ($query) use ($nombreCompleto) {
                    $query->whereRaw('UPPER(CONCAT(nombres, " ", apellidoPaterno, " ", apellidoMaterno)) LIKE ?', ["%$nombreCompleto%"]);
                });
            }
            if ($request->filled('searchEstado')) {
                $reservas = $reservas->where('estado', $request->searchEstado);
            }
            $reservas = $reservas->get();
        }
        return Excel::download(new ReservarExport($reservas,$fechaFin2,$fechaInicio2,$counter,$pasajero,$estado), 'reporte-reservas.xlsx');
    }

    public function tours(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $tour = $request->searchTour;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchTour){
            $reservas = [];
        }else{
            $reservas = DetalleReserva::join('reservas','reservas.id','=','detalle_reservas.reserva_id')->orderBy('detalle_reservas.fecha_viaje', 'desc')->where('reservas.confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('detalle_reservas.fecha_viaje', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchTour')) {
                $reservas = $reservas->where('detalle_reservas.servicio_id', $request->searchTour);
            }
            $reservas = $reservas->get();
        }
        $i = 0;
        $servicios = Servicio::where('incluye',0)->get();
        return view('pages.reportes.tours', compact('reservas', 'i','servicios','fechaInicio2','fechaFin2','tour'));
    }

    public function tourspdf(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $tour = $request->searchTour;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchTour){
            $reservas = [];
        }else{
            $reservas = DetalleReserva::join('reservas','reservas.id','=','detalle_reservas.reserva_id')->orderBy('detalle_reservas.fecha_viaje', 'desc')->where('reservas.confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('detalle_reservas.fecha_viaje', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchTour')) {
                $reservas = $reservas->where('detalle_reservas.servicio_id', $request->searchTour);
                $tour = Servicio::find($request->searchTour);
            }
            $reservas = $reservas->get();
        }
        $i =0 ;
        $pdf= \PDF::loadView('pages.pdf.reportes.tourspdf',compact('i','reservas','fechaInicio2','fechaFin2','tour'))->setPaper('a4','landscape');
        return $pdf->download('REPORTE DE VENTAS.pdf');
    }
    
    public function toursexcel(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $tour = $request->searchTour;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchTour){
            $reservas = [];
        }else{
            $reservas = DetalleReserva::join('reservas','reservas.id','=','detalle_reservas.reserva_id')->orderBy('detalle_reservas.fecha_viaje', 'desc')->where('reservas.confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('detalle_reservas.fecha_viaje', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchTour')) {
                $reservas = $reservas->where('detalle_reservas.servicio_id', $request->searchTour);
                $tour = Servicio::find($request->searchTour);
            }
            $reservas = $reservas->get();
        }        
        return Excel::download(new ToursExport($reservas,$fechaFin2,$fechaInicio2,$tour), 'reporte-ventas.xlsx');
    }

    public function files(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $files = [];
        }else{
            $files = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $files->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            $files = $files->get();
        }
        $i = 0;
        return view('pages.reportes.files', compact('files', 'i','fechaInicio2','fechaFin2'));
    }

    public function filespdf(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $files = [];
        }else{
            $files = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $files->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            $files = $files->get();
        }
        $i =0 ;
        $pdf= \PDF::loadView('pages.pdf.reportes.filespdf',compact('i','files','fechaInicio2','fechaFin2'))->setPaper('a4','landscape');
        return $pdf->download('REPORTE DE FILES.pdf');
    }
    
    public function filesexcel(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $files = [];
        }else{
            $files = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $files->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            $files = $files->get();
        }
        $i =0;
        return Excel::download(new FailExport($files,$fechaFin2,$fechaInicio2), 'reporte-files.xlsx');
    }
}
