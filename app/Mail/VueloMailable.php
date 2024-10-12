<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VueloMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $reserva;
    public function __construct($reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        $reserva=$this->reserva;
        return  $this->subject('Confirmación de Reserva Cuzco Travel')
        ->markdown('pages.mails.vouchervuelo',[
            'reserva' => $this->reserva
        ]);
    }
}
