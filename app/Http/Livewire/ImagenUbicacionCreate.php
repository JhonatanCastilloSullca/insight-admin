<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImagenUbicacionCreate extends Component
{

    use WithFileUploads;
    public $imagen;
    public function render()
    {
        return view('livewire.imagen-ubicacion-create');
    }
}
