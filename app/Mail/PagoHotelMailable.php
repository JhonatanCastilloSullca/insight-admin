<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PagoHotelMailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $pago, public $proveedor, public $user, public $fecha, public $monto, public $monedaId)
    {
    }

    public function build()
    {
        $pago = $this->pago;
        $proveedor = $this->proveedor;
        $user = $this->user;
        $fecha = $this->fecha;
        $monto = $this->monto;
        $monedaId = $this->monedaId;
        return  $this->subject('Confirmación de Pago - Agencia de Viajes Cuzco Travel')
        ->with(['notificacion' => false])
        ->from('operaciones@cuscoinsight.com', config('app.name'))
        ->markdown('pages.mails.pagohotel',[
            'pago' => $pago,
            'proveedor' => $proveedor,
            'user' => $user,
            'fecha' => $fecha,
            'monto' => $monto,
            'monedaId' => $monedaId,
        ]);
    }
}
