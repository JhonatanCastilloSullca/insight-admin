<?php

namespace App\Http\Livewire;

use App\Models\Reserva;
use App\Models\Servicio;
use Carbon\Carbon;
use Livewire\Component;
use DB;

class EditarOperarHotel extends Component
{
    public $reserva;
    public $operar;
    public $detalles = [];
    public $servicio = [];
    public $hoteles;

    public function mount(Reserva $reserva)
    {
        $this->hoteles = Servicio::where('categoria_id', 2)->where('incluye', 0)->get(); 
        $this->reserva = $reserva;
        $this->operar = $reserva->operarHotel;
        $this->detalles = $this->operar->operarEditarHotel;
        // Usa colecciones para mantener la reactividad adecuada
        foreach($this->detalles as $i => $detalle) {
            $this->servicio[$i] = $detalle->servicio_id;
        }
    }

    public function register()
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
    
            foreach($this->operar->operarEditarHotel as $i => $detalle)
            {
                $detalle->servicio_id = $this->servicio[$i];
                $detalle->save();

                $reserva = $detalle->detalleReserva->reserva;

                foreach($reserva->detallestours as $detalleTour)
                {
                    if(date("Y-m-d",strtotime($detalleTour->fecha_viaje)) >= date("Y-m-d",strtotime($detalle->detalleReserva->fecha_viaje)) && date("Y-m-d",strtotime($detalleTour->fecha_viaje)) < date("Y-m-d",strtotime($detalle->detalleReserva->fecha_viajefin))){
                        $detalleTour->update(['proveedor_id' => $detalle->detalleReserva->servicio->proveedor_id,
                        'hotelJisa' => 1]);
                    }
                }

                $detalle->detalleReserva->servicio_id = $this->servicio[$i];
                $detalle->detalleReserva->confirmado = 0;
                $detalle->detalleReserva->save();
                
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->route('operacion.hotel')->with('success', 'Operacion Editado Exitosamente.');
    }

    public function render()
    {
        return view('livewire.editar-operar-hotel');
    }
}
