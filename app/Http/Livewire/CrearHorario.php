<?php

namespace App\Http\Livewire;

use App\Models\Horario;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class CrearHorario extends Component
{
    public $cont=0;
    public $hora_ingreso;
    public $hora_salida;
    public $dias_horarios;

    public function mount($horarios = null)
    {
        if($horarios != null){
            $this->cont = count($horarios);
            foreach($horarios as $i => $horario)
            {
                $this->hora_ingreso[$i] = $horario->hora_ingreso;
                $this->hora_salida[$i] = $horario->hora_salida;
                $this->dias_horarios[$i] = json_decode($horario->descripcion, true);
            }
        }
    }

    public function agregar()
    {
        $this->emit('EncontrarServicio',$this->cont);
        $this->hora_ingreso[$this->cont]="";
        $this->hora_salida[$this->cont]="";
        $this->dias_horarios[$this->cont]=[];
        $this->cont++;
    }

    public function disminuir($i)
    {
        unset($this->hora_ingreso[$i]);
        unset($this->hora_salida[$i]);
        unset($this->dias_horarios[$i]);
        $this->cont--;
        if($this->cont > 0){
            $this->hora_ingreso = array_values($this->hora_ingreso);
            $this->hora_salida = array_values($this->hora_salida);
            $this->dias_horarios = array_values($this->dias_horarios);
        }
        $this->emit('Actualizar',$this->dias_horarios);
    }

    public function render()
    {
        return view('livewire.crear-horario');
    }
}
