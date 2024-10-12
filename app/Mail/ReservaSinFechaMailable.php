<?php

namespace App\Mail;

use App\Models\PdfDatos;
use App\Services\PdfCompression;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ReservaSinFechaMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $reserva;
    public $pasajero;

    public function __construct($reserva,$pasajero)
    {
        $this->reserva = $reserva;
        $this->pasajero = $pasajero;
    }

    public function build()
    {
        $pdfdato = PdfDatos::first(); 
        $pdf = \PDF::loadView('pages.pdf.pdfvoucher', ['reserva' => $this->reserva,'pdfdato' => $pdfdato])->setPaper('a4');
        $pdfPath = 'temp/' . $this->reserva->pasajeroprincipal()->nombreCompleto . '-' . date("d-m-Y", strtotime($this->reserva->fecha)) . '.pdf';
        Storage::put($pdfPath, $pdf->output());

        $customPaper = [0, 0, 297, 167];
        $pdf2 = \PDF::loadView('pages.pdf.pdfitinerario', ['reser' => $this->reserva])->setPaper($customPaper);
        $pdfPath2 = 'temp/ITINERARIO-RESERVA-N-' . $this->reserva->numero . '.pdf';
        Storage::put($pdfPath2, $pdf2->output());

        // Comprimir los PDFs usando el servicio PdfCompression
        $compressedPdfPath = 'temp/compressed_' . basename($pdfPath);
        $compressedPdfPath2 = 'temp/compressed_' . basename($pdfPath2);

        $compressionService = new PdfCompression();
        $compressionService->compressPdf(Storage::path($pdfPath), Storage::path($compressedPdfPath));
        $compressionService->compressPdf(Storage::path($pdfPath2), Storage::path($compressedPdfPath2));

        return $this->subject('Confirmación de Reserva - Cuzco Travel')
            ->with([
                'reserva' => $this->reserva,
                'compressedPdfPath' => $compressedPdfPath,
                'compressedPdfPath2' => $compressedPdfPath2,
                'pdfPath' => $pdfPath,
                'pdfPath2' => $pdfPath2,
                'notificacion' => true,
            ])
            ->attachFromStorage($compressedPdfPath)
            ->attachFromStorage($compressedPdfPath2)
            ->markdown('pages.mails.vouchersinfecha', [
                'reserva' => $this->reserva,
                'pasajero' => $this->pasajero,
            ]);
    }
}
