<?php

namespace App\Http\Controllers;

use App\Models\PdfDatos;
use App\Models\Medio;
use App\Models\Reserva;
use App\Models\DetalleReserva;
use App\Models\Operar;
use App\Models\OperarServicio;
use App\Models\Pago;
use App\Models\Servicio;
use App\Models\User;
use App\Services\PdfCompression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $counter = $request->searchCounter;
        if($request->search){
            $reservas = Reserva::query();
            if (strpos($request->search, '-') !== false) {
                // Intentar dividir la búsqueda en día, mes y año
                $fechaParts = explode('-', $request->search);

                if (count($fechaParts) === 4) {
                    list($numero, $dia, $mes, $anio) = $fechaParts;
                
                    // Crear la fecha completa en formato Y-m-d
                    $fechaCompleta = Carbon::createFromFormat('Y-m-d', "$anio-$mes-$dia")->format('Y-m-d');
                
                    // Búsqueda por número y fecha
                    $reservas->where('numero', $numero)
                        ->where('confirmado', 1)
                        ->whereHas('detallestours', function ($query) use ($fechaCompleta) {
                            $query->whereDate('fecha_viaje', $fechaCompleta);
                        })
                        ->where(function ($query) use ($fechaCompleta) {
                            $query->whereRaw("
                                (SELECT MIN(fecha_viaje) 
                                FROM detalle_reservas 
                                WHERE detalle_reservas.reserva_id = reservas.id) = ?", 
                                [$fechaCompleta]
                            );
                        });
                }
            }
    
            // Búsqueda por nombre completo
            $nombreCompleto = strtoupper($request->search);
    
            $reservas->orWhereHas('pasajeros', function ($query) use ($nombreCompleto) {
                $query->whereRaw("UPPER(REPLACE(CONCAT(nombres, ' ', apellidoPaterno, ' ', apellidoMaterno), '  ', ' ')) LIKE ?", ["%$nombreCompleto%"]);
            });
    
            // Búsqueda por email
            if (!empty($request->search)) {
                $reservas->orWhereHas('pasajeros', function ($query) use ($request) {
                    $query->where('email', $request->search);
                });
            }
        }else{
            if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchCounter){
                $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1)->whereDate('fecha',now());
                $fechaInicio2 = now()->format('Y-m-d');
                $fechaFin2 = now()->format('Y-m-d');
            }else{
                $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 1);
                if ($request->filled('searchFechaInicio')) {
                    $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                    $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
                }
                if ($request->filled('searchCounter')) {
                    $reservas = $reservas->where('user_id', $request->searchCounter);
                }
            }
        }
        if (\Auth::user()->roles[0]->id == 2) {
            $reservas = $reservas->where('user_id', \Auth::user()->id);
        }
        $reservas = $reservas->get();
        $i = 0;
        $users = User::all();
        return view('pages.reservas.index', compact('reservas', 'i','users','fechaInicio2','fechaFin2','counter'));
    }

    public function sinconfirmar(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $counter = $request->searchCounter;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchCounter){
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 0)->whereDate('fecha',now());
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }else{
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 0);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCounter')) {
                $reservas = $reservas->where('user_id', $request->searchCounter);
            }
        }
        if (\Auth::user()->roles[0]->id != 1) {
            $reservas = $reservas->where('user_id', \Auth::user()->id);
        }
        $reservas = $reservas->get();
        $i = 0;
        $users = User::all();
        return view('pages.reservas.sincofirmar', compact('reservas', 'i','users','fechaInicio2','fechaFin2','counter'));
    }

    public function sinfecha(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $counter = $request->searchCounter;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchCounter){
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 2)->whereDate('fecha',now());
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }else{
            $reservas = Reserva::orderBy('fecha', 'desc')->where('confirmado', 2);
            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $reservas = $reservas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCounter')) {
                $reservas = $reservas->where('user_id', $request->searchCounter);
            }
        }
        if (\Auth::user()->roles[0]->id != 1) {
            $reservas = $reservas->where('user_id', \Auth::user()->id);
        }
        $reservas = $reservas->get();
        $i = 0;
        $users = User::all();
        return view('pages.reservas.sinfecha', compact('reservas', 'i','users','fechaInicio2','fechaFin2','counter'));
    }

    public function create()
    {
        return view('pages.reservas.create');
    }

    public function createcotizacion()
    {
        return view('pages.reservas.createcotizacion');
    }

    public function createsinfecha()
    {
        return view('pages.reservas.createsinfecha');
    }

    public function pdfvoucher(Reserva $reserva)
    {
        $pdfdato = PdfDatos::first(); 
        $pdf = \PDF::loadView('pages.pdf.pdfvoucher', ['reserva' => $reserva,'pdfdato' => $pdfdato]);
        $pdf->setPaper('a4');
        return $pdf->stream('Voucher Nº ' . $reserva->numero .'-'.date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)). '.pdf');
    }

    public function proforma(Reserva $reserva)
    {
        $pdf = \PDF::loadView('pages.pdf.proforma', ['reserva' => $reserva]);
        $pdf->setPaper('a4');
        return $pdf->stream('Proforma.pdf');
    }

    public function pdfvoucheroficina(Reserva $reserva)
    {
        $pdf = \PDF::loadView('pages.pdf.pdfvoucheroficina', ['reserva' => $reserva]);
        $pdf->setPaper('a4');
        return $pdf->stream('Voucher Nº ' . $reserva->numero .'-'.date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)). '.pdf');
    }
    
    public function voucheroficina(Reserva $reserva)
    {
        return view('pages.reservas.voucheroficina', compact('reserva'));
    }

    public function edit(Reserva $reserva)
    {
        return view('pages.reservas.edit', compact('reserva'));
    }

    public function devolucion(Reserva $reserva, $tipo)
    {
        return view('pages.reservas.devolucion', compact('reserva','tipo'));
    }

    public function editcotizacion(Reserva $reserva)
    {
        return view('pages.reservas.editcotizacion', compact('reserva'));
    }

    public function editsinfecha(Reserva $reserva)
    {
        return view('pages.reservas.editsinfecha', compact('reserva'));
    }

    public function biblia()
    {
        $reservas = Reserva::all();
        $detallesReserva = DetalleReserva::all();
        $i = 0;
        return view('pages.reservas.biblia', compact('reservas', 'detallesReserva', 'i'));
    }

    public function overview(Request $request)
    {
        $detalle = DetalleReserva::find($request->id);
        $plantilla = $detalle->detallesoperar->operar->servicio->plantillaOverview;
        $horaRecojo = $detalle->detallesoperar->recojo;
        $horaRecojoCarbon = $horaRecojo ? Carbon::parse($horaRecojo) : null;
        $incluyetext = '';
        $noincluyetext = '';
        foreach($detalle->itinerarios as $itinerario){
            foreach($itinerario->incluyes as $incluye){
                $incluyetext .= $incluye->titulo.', ';
            }
            foreach($itinerario->noincluyes as $noincluye){
                $noincluyetext .= $noincluye->titulo.', ';
            }
        }
        $reemplazos = [
            '{hora_recojo}' => $horaRecojoCarbon ? $horaRecojoCarbon->format('h:i a').' a '.$horaRecojoCarbon->addMinutes(10)->format('h:i a') : null,
            '{incluyes}' => $incluyetext,
            '{noincluyes}' => $noincluyetext,
        ];

        $mensaje = str_replace(array_keys($reemplazos), array_values($reemplazos), $plantilla);
        $mensajeCodificado = urlencode($mensaje);
        $numero = preg_replace('/[^0-9]/', '', $detalle->reserva->pasajeroprincipal()->celular);

        $link = "https://api.whatsapp.com/send/?phone=".$numero."&text=".$mensajeCodificado;

        $detalle->overview =1;
        $detalle->save();
        return redirect()->to($link);
    }

    public function pdfitinerario($reserva)
    {
        $reser = Reserva::where('id', $reserva)->first();

        $pdfdatos = PdfDatos::first();
        $mediossoles = Medio::where('moneda_id', 1)->get();
        $mediosdolares = Medio::where('moneda_id', 2)->get();
        $customPaper = array(0, 0, 297, 167);
        $pdf = \PDF::loadView('pages.pdf.pdfitinerario', ['reser' => $reser, 'pdfdatos' => $pdfdatos, 'mediossoles' => $mediossoles, 'mediosdolares' => $mediosdolares]);
        $pdf->setPaper($customPaper);
        return $pdf->stream('Itinerario ' . $reser->numero . '.pdf');
    }

    public function pdfitinerariopaquete($reserva)
    {
        $reserva = Reserva::find($reserva);

        // Definir el tamaño del papel
        $customPaper = array(0, 0, 297, 167);
        $cantAdultos = round($reserva->detallestours()->where('precio_id', 1)->avg('pax'));
        $cantNiños = round($reserva->detallestours()->where('precio_id', 2)->avg('pax'));
        $totales = DetalleReserva::select('detalle_reservas.reserva_id',DB::raw('SUM(detalle_reservas.pax * detalle_reservas.precio * detalle_reservas.equipaje + detalle_reservas.adicional) as total'))
        ->join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        ->where('detalle_reservas.reserva_id',$reserva->id)
        ->where('servicios.categoria_id',2)
        ->groupBy('detalle_reservas.reserva_id')
        ->get();

        $totalesvuelos = DetalleReserva::select('detalle_reservas.reserva_id',DB::raw('SUM(detalle_reservas.pax * detalle_reservas.precio + detalle_reservas.equipaje) as total'))
        ->join('servicios','servicios.id','=','detalle_reservas.servicio_id')
        ->where('detalle_reservas.reserva_id',$reserva->id)
        ->where('servicios.categoria_id',3)
        ->groupBy('detalle_reservas.reserva_id')
        ->get();

        $totalHoteles = $totales->where('reserva_id', $reserva->id)->pluck('total')->first();
        $totalVuelos = $totalesvuelos->where('reserva_id', $reserva->id)->pluck('total')->first();

        // Generar el PDF y guardarlo temporalmente
        $pdf = \PDF::loadView('pages.pdf.pdfitinerariopaquete', compact('reserva','cantAdultos','cantNiños','totalHoteles','totalVuelos'));
        $pdf->setPaper($customPaper);

        $filename = 'Itinerario_' . $reserva->id . '.pdf';
        $filePath = storage_path('app/public/temp/' . $filename);

        // Guardar el PDF sin comprimir en la carpeta de almacenamiento
        $pdf->save($filePath);

        // Comprimir el PDF usando Ghostscript
        $compressedFilename = 'Itinerario_' . $reserva->id . '_compressed.pdf';
        $compressedFilePath = storage_path('app/public/temp/' . $compressedFilename);

        // Llamar al servicio de compresión de PDF
        $pdfCompressionService = new PdfCompression();
        $compressionSuccessful = $pdfCompressionService->compressPdf($filePath, $compressedFilePath);

        // Eliminar el archivo original
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Si la compresión fue exitosa, descargar el archivo comprimido
        if ($compressionSuccessful) {

            // Descargar el archivo comprimido
            return response()->download($compressedFilePath)->deleteFileAfterSend(true);
        } else {
            // Si la compresión falla, descargar el archivo original
            return response()->download($filePath)->deleteFileAfterSend(true);
        }
    }


    public function bibliaoperar(Request $request)
    {
        $detallesReserva = DetalleReserva::whereIn('id', $request->ids)->get();
        $resultado = null;
        $primerServicioId = null;
        $primerFechaViaje = null;
        $primerCategoriaServicio = null;
        if ($detallesReserva->isNotEmpty()) {
            $primerDetalle = $detallesReserva->first();
            $primerServicioId = $primerDetalle->servicio_id;
            $primerCategoriaServicio = $primerDetalle->servicio->categoria_id;
            $primerFechaViaje = $primerDetalle->fecha_viaje;
            $resultado = $detallesReserva->every(function ($detalle) use ($primerServicioId, $primerFechaViaje) {
                if ($detalle->fecha_viaje === null || $primerFechaViaje === null) {
                    return false;
                }
                return $detalle->servicio_id === $primerServicioId && $detalle->fecha_viaje == $primerFechaViaje;
            }) ? 1 : 2;
        }
        if ($resultado == 1) {
            return redirect()->route('operacion.createtours', ['servicio' => $primerServicioId, 'fecha' => $primerFechaViaje]);
        } else {
            return redirect()->back()->with('error', 'Revise Fechas y Servicios iguales');
        }
    }

    public function destroy(Request $request)
    {
        $reserva = Reserva::find($request->id_reserva_2);
        try {
            DB::beginTransaction();
            foreach($reserva->detalles as $detalle){
                foreach($detalle->itinerarios as $itinerario){
                    $itinerario->incluyes()->detach();
                    $itinerario->noincluyes()->detach();
                    $itinerario->delete();
                }
                $detalle->delete();
            }
            $reserva->pasajeros()->detach();
            $reserva->totales()->delete();
            $reserva->cuotas()->delete();
            $reserva->pagos()->delete();
            $reserva->delete();
            DB::commit();
            return redirect()->route('reserva.index')
                ->with('success', 'Reserva eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('reserva.index')
                ->with('success', 'Error al eliminar el reserva: ' . $e->getMessage());
        }
    }

    public function contabilizarpago(Pago $pago)
    {
        $pago->contabilidad = 1;
        $pago->save();

        $reserva = $pago->reserva;
        $aux = 1;
        foreach($reserva->pagos as $pago){
            if($pago->contabilidad == 0){
                $aux = 0;
            }
        }

        if($aux == 1 && $reserva->pagado == 1){
            $reserva->contabilidad = 1;
            $reserva->save();
        }

        return redirect()->back();
    }

    public function ingresomachupicchu(Request $request)
    {
        $servicio = Servicio::find($request->servicioId);
        $reserva = Reserva::find($request->reservaId);
        return view('pages.operar.otros.compraingreso',compact('servicio','reserva'));
    }

    public function guardaringresomachupicchu(Request $request)
    {
        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $detalle = DetalleReserva::find($request->detalleId);
            $servicio = Servicio::find($request->servicioId);

            $operar = Operar::create([
                'fecha' => $detalle->fecha_viaje,
                'observacion' => $request->observacion,
                'cantidad_pax' => $detalle->pax,
                'ingresos' => 0,
                'precioSoles' => $request->precio,
                'precioDolares' => 0,
                'user_id' => \Auth::user()->id,
                'servicio_id' => $request->servicioId,
                'estado' => 1,
                'tipo' => 0,
                'operado' => 1,
            ]);

            OperarServicio::create([
                'operar_id' => $operar->id,
                'servicio_id' => $request->servicioId,
                'proveedor_id' => $servicio->proveedor_id,
                'precio' => $request->precio,
                'moneda_id' => 1,
                'cantidad' => $detalle->pax,
                'tipo' => 0,
                'estado' => 1
            ]);

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
        return redirect()->route('reserva.voucheroficina', $detalle->reserva);
    }
}
