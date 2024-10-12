<?php

namespace App\Http\Livewire;

use App\Models\Horario;
use Livewire\Component;

class CrearDescanso extends Component
{
    public $cont=0;
    public $hora_inicio_descanso;
    public $hora_fin_descanso;
    public $dias_descanso;

    public function mount($horarios = null)
    {
        if($horarios != null){
            $this->cont = count($horarios);
            foreach($horarios as $i => $horario)
            {
                $this->hora_inicio_descanso[$i] = $horario->hora_ingreso;
                $this->hora_fin_descanso[$i] = $horario->hora_salida;
                $this->dias_descanso[$i] = json_decode($horario->descripcion, true);
            }
        }
    }

    public function agregar()
    {
        $this->emit('EncontrarServicio2',$this->cont);
        $this->hora_inicio_descanso[$this->cont]="";
        $this->hora_fin_descanso[$this->cont]="";
        $this->dias_descanso[$this->cont]=[];
        $this->cont++;
    }

    public function disminuir($i)
    {
        unset($this->hora_inicio_descanso[$i]);
        unset($this->hora_fin_descanso[$i]);
        unset($this->dias_descanso[$i]);
        $this->cont--;
        if($this->cont > 0){
            $this->hora_inicio_descanso = array_values($this->hora_inicio_descanso);
            $this->hora_fin_descanso = array_values($this->hora_fin_descanso);
            $this->dias_descanso = array_values($this->dias_descanso);
        }
        $this->emit('Actualizar2',$this->dias_descanso);
    }

    public function render()
    {
        return view('livewire.crear-descanso');
    }
}
