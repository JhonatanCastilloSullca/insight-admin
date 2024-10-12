<?php

namespace App\Http\Livewire;

use App\Models\Reserva;
use Livewire\Component;

class DevolucionReserva extends Component
{
    public $pasajerosreserva=[];
    public $serviciosreserva=[];
    public $hotelesreserva=[];
    public $vuelosreserva=[];
    public $reserva = null;
    
    public bool $isSaving = false;

    public function mount(Reserva $reserva = null)
    {
        $this->reserva = $reserva;
        $this->pasajerosreserva = $reserva->pasajeros;
        $this->serviciosreserva = $reserva->detallestours;
        $this->hotelesreserva = $reserva->detalleshoteles;
        $this->vuelosreserva = $reserva->detallesvuelos;
    }

    public function render()
    {
        return view('livewire.devolucion-reserva');
    }
}
