<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notificacion;


class VistaNotificaciones extends Component
{
    public $notificaciones;

    public function mount()
    {
        $this->notificaciones = Notificacion::where('estado',0)->where('user_id',\Auth::user()->id)->get();
    }
    public function render()
    {

        return view('livewire.vista-notificaciones');
    }

    public function Leido($value)
    {
        $leido = Notificacion::find($value);
        if (!$leido) {
            return redirect()->route('operacion.vuelos')->with('error', 'No se encontró la reserva.');
        }
        $leido->update([
            'estado' => 1,
        ]);
        $this->notificaciones = Notificacion::where('estado', 0)->where('user_id',\Auth::user()->id)->get();
        $this->emit('notificacionActualizada');
    }
}

