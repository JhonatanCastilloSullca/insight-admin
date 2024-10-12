<?php

namespace App\Http\Livewire;

use App\Models\Reserva;
use Livewire\Component;
use DB;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class PrecioHotel extends Component
{
    use WithFileUploads;

    public $reserva;
    public $operar;
    public $detalles = [];
    public $precio = [];
    public $fecha = [];
    public $moneda = [];
    public $imagen = [];

    public function mount(Reserva $reserva)
    {
        $this->operar = $reserva->operarHotel;
        $this->reserva = $reserva;
        foreach($this->operar->operarHotelsPrecio as $i => $detalle){
            $this->precio[$i] = 0;
            $this->moneda[$i] = 2;
            $this->fecha[$i] = '';
            $this->imagen[$i] = '';
        }
    }

    public function cambiarTipoMoneda($i)
    {
        $this->moneda[$i] = $this->moneda[$i] == 1 ? 2:1;
    }

    public function register()
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
    
            $precioSoles = $this->operar->precioSoles;
            $precioDolares = $this->operar->precioDolares;

            foreach($this->operar->operarHotelsPrecio as $i => $detalle)
            {
                if($this->precio[$i] != '' && $this->precio[$i] > 0){
                    if($this->imagen[$i]){
                        $nombreimg=$detalle->id.'.'.$this->imagen[$i]->getClientOriginalExtension();
                        $ruta=$this->imagen[$i]->storeAs('img/confiramacionHotel',$nombreimg);
                    }else{
                        $nombreimg='';
                    }
                    $detalle->precio = $this->precio[$i];
                    $detalle->moneda_id = $this->moneda[$i];
                    $detalle->fechaPago = $this->fecha[$i] ?? $mytime->toDateString();
                    $detalle->acuenta = 0;
                    $detalle->saldo = $this->precio[$i];
                    $detalle->imagen = $nombreimg;
                    $detalle->save();

                    $detalle->detalleReserva->confirmado = 2;
                    $detalle->detalleReserva->save();
                    
                    $precios = $this->moneda[$i] == 2 ? 0 : $this->precio[$i];
                    $preciosd = $this->moneda[$i] == 2 ? $this->precio[$i] : 0;

                    $precioSoles = $precioSoles + $precios;
                    $precioDolares = $precioDolares + $preciosd;
                }
            }

            $this->operar->precioSoles = $precioSoles;
            $this->operar->precioDolares = $precioDolares;
            $this->operar->save();

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->route('calendario.hotel')->with('success', 'Precios agregados exitosamente.');
    }

    public function render()
    {
        return view('livewire.precio-hotel');
    }
}
