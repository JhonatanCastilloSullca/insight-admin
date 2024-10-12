<?php

namespace App\Http\Livewire;

use App\Models\Medio;
use App\Models\Pago;
use App\Models\Reserva;
use App\Models\Total;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AgregarPago extends Component
{
    public $reserva;
    public $monedaId;
    public $monto;
    public $medioId;
    public $num_operacion;
    public $comentario;
    public $isSaving=false;
    public $monto_porcentaje;

    public function mount(Reserva $reserva){
        $this->reserva = $reserva;
        $this->monto = $reserva->totalesConSaldo[0]?->saldo ?? 0;
        $this->monto_porcentaje = $reserva->totalesConSaldo[0]?->saldo ?? 0;
    }

    public function render()
    {
        return view('livewire.agregar-pago');
    }

    public function updatedmonedaId($id)
    {
        $data=Medio::select('id','nombre as text')->where('moneda_id',$id)->where('estado',1)->get();
        $data = $data->toArray();
        array_unshift($data, ['id' => '', 'text' => 'Seleccione']);
        if($data){
            $this->emit('LlenarMedio',null,$data);
        }
    }

    public function agregarPago()
    {
        if ($this->isSaving) {
            return; // Prevenir que se ejecute si ya está en proceso
        }

        $this->isSaving = true;

        try
        {
            DB::beginTransaction();

            $total = Total::where('reserva_id',$this->reserva->id)->where('moneda_id',$this->monedaId)->first();
            $pagar= $total ? $total->saldo : 0;
            $this->validate([
                'monedaId' => 'required|exists:monedas,id',
                'monto' => 'required|numeric|min:1|max:'.$pagar,
                'medioId' => 'required|exists:medios,id',
                'num_operacion' => 'nullable|max:100',
                'comentario' => 'nullable',
            ]);

            $mytime= Carbon::now('America/Lima');
            $medio = Medio::find($this->medioId);

            $pagoContabilidad = \Auth::user()->roles[0]->name == 'Administrador' ? 1 : 0;

            $pagar = Pago::create([
                'user_id' => \Auth::user()->id,
                'moneda_id' => $this->monedaId,
                'medio_id' => $this->medioId,
                'reserva_id' => $this->reserva->id,
                'fecha' => $mytime->toDateTimeString(),
                'monto' => $this->monto,
                'monto_porcentaje' =>  $this->monto_porcentaje,
                'num_operacion' => $this->num_operacion,
                'comentarios' => $this->comentario,
                'contabilidad' => $pagoContabilidad,
            ]);

            $total->saldo = $total->saldo - $this->monto;
            $total->acuenta = $total->acuenta + $this->monto;
            $total->save();

            $reserva = Reserva::find($this->reserva->id);

            if ($reserva->saldoCero) {
                $reserva->update(['pagado' => 1]);
            } else {
                $reserva->update(['pagado' => 0]);
            }

            $aux = 1;
            foreach($reserva->pagos as $pago){
                if($pago->contabilidad == 0){
                    $aux = 0;
                }
            }

            if($aux == 1 && $reserva->pagado == 1){
                $reserva->contabilidad = 1;
                $reserva->save();
            }

            DB::commit();

            return redirect()->to('reserva/voucheroficina/'.$this->reserva->id)->with("success", "Pago Agregado Correctamente.");
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }finally {
            $this->isSaving = false; // Asegurarse de que se restablezca a false
        }

    }
}
