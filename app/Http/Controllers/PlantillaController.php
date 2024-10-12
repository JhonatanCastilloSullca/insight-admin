<?php

namespace App\Http\Controllers;

use App\Exports\ConseturExport;
use App\Exports\MinisterioExport;
use App\Models\DetalleReserva;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class PlantillaController extends Controller
{
    public function ministerio(Request $request)
    {
        $reserva = Reserva::find($request->reservaId);
        return Excel::download(new MinisterioExport($reserva->pasajeros,$reserva), 'ministerio.xlsx');
    }

    public function consetur(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        return view('pages.operar.otros.consetur',compact('fechaInicio2','fechaFin2'));
    }

    public function descargarconsetur(Request $request)
    {
        $fechaInicio2 = Carbon::parse($request->searchFechaInicio);
        $fechaFin2 = Carbon::parse($request->searchFechaFin);
        $totalArchivos = 0;
        $zip = new ZipArchive;
        $zipFileName = 'consetur_archivos.zip';

        // Crear un archivo ZIP para agregar todos los archivos Excel
        if ($zip->open(storage_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            while ($fechaInicio2->lessThanOrEqualTo($fechaFin2)) {
                // Obtener los detalles para la fecha actual
                $detalles = DetalleReserva::whereRelation('servicio', 'categoria_id', 5)
                    ->whereDate('fecha_viaje', $fechaInicio2)
                    ->whereRelation('reserva', 'confirmado', 1)
                    ->whereHas('itinerarios', function($query) {
                        $query->whereHas('incluyes', function($subquery) {
                            $subquery->where('servicio_incluido_id', 8)
                                ->where('detalle_reserva_incluyes.operar', 0);
                        });
                    })
                    ->get();

                if ($detalles->isNotEmpty()) {
                    // Nombre único para cada archivo Excel basado en la fecha
                    $nombreArchivo = $fechaInicio2->format('d') . '.xlsx';
                    Excel::store(new ConseturExport($detalles), $nombreArchivo, 'local'); // Guardar temporalmente

                    // Añadir archivo Excel al ZIP
                    $zip->addFile(storage_path('app/' . $nombreArchivo), $nombreArchivo);
                    $totalArchivos++;
                }

                $fechaInicio2->addDay(); // Incrementar la fecha
            }

            $zip->close(); // Cerrar archivo ZIP
        }

        // Si se generaron archivos, descargar el archivo ZIP
        if ($totalArchivos > 0) {
            return response()->download(storage_path($zipFileName))->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'No se encontraron detalles para ninguna de las fechas seleccionadas.');
        }
    }
}
