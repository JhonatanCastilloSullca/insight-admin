<?php

namespace App\Http\Requests;

use App\Models\Total;
use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $total = Total::where('reserva_id',$this->id_reserva)->where('moneda_id',$this->moneda_id)->first();
        return [
            'moneda_id'  => 'required|exists:medios,id',
            'monto' => 'required|numeric|max:'.$total?->saldo.'|min:1',
        ];
    }
}
