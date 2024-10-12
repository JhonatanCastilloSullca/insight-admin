<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use App\Models\Notificacion;
use App\Mail\ReservaMailable; // Asegúrate de importar el mailable específico
use Illuminate\Support\Facades\Storage;
class LogMailSent
{
    public function __construct()
    {
        //
    }

    public function handle(MessageSent $event)
    {
        // Verificar si el mailable en los datos es una instancia de ReservaMailable
        if ($event->data['notificacion'] == 1) {
            $reserva = $event->data['reserva'];
            $compressedPdfPath = $event->data['compressedPdfPath'];
            $compressedPdfPath2 = $event->data['compressedPdfPath2'];
            $pdfPath = $event->data['pdfPath'];
            $pdfPath2 = $event->data['pdfPath2'];

            // Eliminar archivos PDF temporales
            Storage::delete($pdfPath);
            Storage::delete($pdfPath2);
            Storage::delete($compressedPdfPath);
            Storage::delete($compressedPdfPath2);

            // Crear la notificación
            Notificacion::create([
                'notificacion' => 'Correo enviado de la Reserva # ' . $reserva->numero.'-'.date("d-m-Y", strtotime($reserva->primerafecha()?->fecha_viaje)),
                'user_id' => $reserva->user_id,
                'estado' => 0,
                'tipo' => 5,
            ]);
        }
    }
}
