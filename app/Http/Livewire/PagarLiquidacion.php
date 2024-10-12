<?php

namespace App\Http\Livewire;

use App\Models\Liquidacion;
use Livewire\Component;

class PagarLiquidacion extends Component
{
    public $liquidacion;

    public function mount(Liquidacion $liquidacion)
    {
        $this->liquidacion = $liquidacion;
    }

    public function render()
    {
        return view('livewire.pagar-liquidacion');
    }
}
