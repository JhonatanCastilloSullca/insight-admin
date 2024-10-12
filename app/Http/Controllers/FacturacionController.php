<?php

namespace App\Http\Controllers;

use App\Exports\FacturacionExport;
use App\Models\Cliente;
use App\Models\Company;
use App\Models\Document;
use App\Models\DocumentoSunat;
use App\Models\Pago;
use App\Models\Venta;
use App\Services\SunatService;
use Carbon\Carbon;
use Greenter\Report\XmlUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use Maatwebsite\Excel\Facades\Excel;

class FacturacionController extends Controller
{
    public function pagos(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $reserva_id = $request->searchReserva;
        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchReserva ){
            $pagos = Pago::where('factura', '0')->whereDate('fecha',now())->orderBy('fecha','desc')->get();
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }else{
            $pagos = Pago::where('factura',0)->where('estado',1)->orderBy('fecha','desc');

            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $pagos = $pagos->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchReserva')) {
                $pagos = $pagos->where('reserva_id', $request->searchReserva);
            }
            $pagos = $pagos->get();
        }
        $i=0;
        return view('pages.facturacion.pagos',compact('i','pagos','fechaInicio2','fechaFin2','reserva_id'));
    }

    public function create(Request $request,$id = null)
    {
        $pago = Pago::find($id);
        return view('pages.facturacion.create',compact('pago'));
    }

    public function listado(Request $request)
    {
        $ventas = collect();
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $nume_documento2 = $request->searchNroDocumento;
        $searchCliente2 = $request->searchCliente;
        $searchDocumento = $request->searchDocumento;
        $searchDocumento2 = $request->searchReserva;

        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchNroDocumento && !$request->searchCliente && !$request->searchReserva ){
            $ventas = Venta::whereDate('fecha',now())->orderBy('fecha','desc')->get();
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }else{
            $ventas = Venta::orderBy('fecha','desc');

            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $ventas = $ventas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCliente')) {
                $ventas = $ventas->where('cliente_id', $request->searchCliente);
            }
            if ($request->filled('searchDocumento')) {
                $ventas = $ventas->where('document_id', $request->searchDocumento);
            }
            if ($request->filled('searchNroDocumento')) {
                $ventas = $ventas->where('nume_doc', $request->searchNroDocumento);
            }
            if ($request->filled('searchNroDocumento')) {
                $ventas = $ventas->where('reserva_id', $request->searchReserva);
            }
            $ventas = $ventas->get();
        }

        
        $documentos = Document::get();
        $clientes = Cliente::all();
        $i=0;
        return view('pages.facturacion.listado', compact('documentos','i','ventas', 'clientes','fechaFin2','fechaInicio2','nume_documento2','searchCliente2','searchDocumento2','searchDocumento2'));
    }

    public function descargarXml($id)
    {
        $modelo = DocumentoSunat::where('venta_id',$id)->first();
        $venta=Venta::find($id);
        $contenidoXml = $modelo->xml;
        $nombre = $venta->document?->serie.'-'.$venta->nume_doc;
        $headers = [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename='.$nombre.'.xml',
        ];
        return response()->make($contenidoXml, 200, $headers);
    }

    public function destroyfactura(Request $request)
    {
        try{
            DB::beginTransaction();
            $venta= Venta::findOrFail($request->id_venta_2);
            $venta->sunat = 2;
            $venta->save();

            $mytime= Carbon::now('America/Lima');
            if($venta->document->nombre == 'FACTURA ELECTRÓNICA'){
                $documento = Document::where('nombre','NOTA DE CRÉDITO')->where('serie','LIKE','%F%')->first();
            }else{
                $documento = Document::where('nombre','NOTA DE CRÉDITO')->where('serie','LIKE','%B%')->first();
            }            $documento->cantidad = $documento->incremento + $documento->cantidad;
            $documento->save();
            $note = new Venta();
            $note->reserva_id = $venta->reserva_id;
            $note->user_id = \Auth::user()->id;
            $note->cliente_id = $venta->cliente_id;
            $note->document_id = $documento->id;
            $note->medio_id = $venta->medio->moneda_id == 1 ? 1 : 2;
            $note->nume_doc = $documento->cantidad;
            $fechaConHoraActual = Carbon::parse($request->fecha)->setTime(now()->hour, now()->minute, now()->second);
            $note->fecha = $fechaConHoraActual;
            $note->total = $venta->total;
            $note->descripcion = $request->descripcion;
            $note->code_note = $request->type_anular;
            $note->factura_id = $venta->id;
            $note->save();

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
            $invoice = $sunat->getNote($company,$documento,$venta,$totales,$note);
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
                'venta_id' => $note->id,
            ]);
            if($response['sunatResponse']['success'] && $response['sunatResponse']['cdrResponse']['code'] == 0){
                $note->sunat = 1;
                $note->save();
            }else{
                $note->sunat = 0;
                $note->save();
            }
            DB::commit();
            return back()
                ->with('success','Factura Anulado Correctamente!');

        }catch(Exception $e){
            DB::rollBack();
        }
    }
    
    public function enviarfactura(Venta $venta)
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
            $documento = Document::find($venta->document_id);

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
            $documentoSunat = DocumentoSunat::updateOrCreate([
                'venta_id' => $venta->id,
            ],[
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
            ]);
            if($response['sunatResponse']['success'] && $response['sunatResponse']['cdrResponse']['code'] == 0){
                $venta->sunat = 1;
                $venta->save();
            }else{
                $venta->sunat = 0;
                $venta->save();
            }
            DB::commit();
            return back()
                ->with('success','Factura Enviada Correctamente!');

        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function reporte(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $nume_documento2 = $request->searchNroDocumento;
        $searchCliente2 = $request->searchCliente;
        $searchDocumento = $request->searchDocumento;
        $searchDocumento2 = $request->searchReserva;

        if(!$request->searchFechaInicio && !$request->searchFechaFin && !$request->searchNroDocumento && !$request->searchCliente && !$request->searchReserva ){
            $ventas = Venta::whereDate('fecha',now())->orderBy('fecha','desc')->get();
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }else{
            $ventas = Venta::orderBy('fecha','desc');

            if ($request->filled('searchFechaInicio')) {
                $fechaFin = $request->filled('searchFechaFin') ? $request->searchFechaFin : now()->toDateString();
                $ventas = $ventas->whereBetween('fecha', [$request->searchFechaInicio.' 00:00:00', $fechaFin.' 23:59:59']);
            }
            if ($request->filled('searchCliente')) {
                $ventas = $ventas->where('cliente_id', $request->searchCliente);
            }
            if ($request->filled('searchDocumento')) {
                $ventas = $ventas->where('documento_id', $request->searchDocumento);
            }
            if ($request->filled('searchNroDocumento')) {
                $ventas = $ventas->where('nume_doc', $request->searchNroDocumento);
            }
            if ($request->filled('searchNroDocumento')) {
                $ventas = $ventas->where('reserva_id', $request->searchReserva);
            }
            $ventas = $ventas->get();
        }
        
        return Excel::download(new FacturacionExport($ventas,$fechaFin2,$fechaInicio2,$nume_documento2,$searchCliente2,$searchDocumento2,$searchDocumento), 'reporte-facturacion.xlsx');
    }

    public function ticketpdf($ventaId)
    {
        $formatear = new NumeroALetras();
        $compania = Company::find(1);
        $venta = Venta::findOrFail($ventaId);
        $igv= number_format(($venta->total /1.18) * 0.18,2);
        $fecha = date("Y-m-d",strtotime($venta->fecha));
        $mensaje = $compania->ruc.'|'.$venta->document->codSunat.'|'.$venta->document->serie.'|'.$venta->nume_doc.'|'.$igv.'|'.$venta->total.'|'.$fecha.'|'.$venta->cliente->sunat.'|'.$venta->cliente->num_documento;
        $qrcode = base64_encode(\QrCode::size(100)->generate($mensaje));
        
        $letrasnumeros = $formatear->toInvoice($venta->total,2,'SOLES');
        if($venta->document->nombre == "NOTA DE CRÉDITO"){
            $pdf = \PDF::loadView('pages.pdf.notacredito', ['venta' => $venta, 'qrcode' => $qrcode , 'letrasnumeros' => $letrasnumeros])
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0
            ]);
        }else{
            $pdf = \PDF::loadView('pages.pdf.ticketpdf', ['venta' => $venta, 'qrcode' => $qrcode , 'letrasnumeros' => $letrasnumeros])
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0
            ]);
        }
        return $pdf->stream('Ticket-' . $venta->nume_doc . '.pdf');
    }
}
