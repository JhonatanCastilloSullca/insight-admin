<?php

namespace App\Mail;

use App\Models\Proveedor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelMailable extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(public $detallesoperar, public $proveedor, public $operar)
    {
    }

    public function build()
    {
        $operar = $this->operar;
        $proveedor = $this->proveedor;
        $detalles=$this->detallesoperar;
        return  $this->subject('Solicitud de Reservas de Habitaciones')
        ->with(['notificacion' => false])
        ->from('operaciones@cuscoinsight.com', config('app.name'))
        ->markdown('pages.mails.voucherhotel',[
            'detalles' => $detalles,
            'proveedor' => $proveedor,
            'operar' => $operar,
        ]);
    }
}
