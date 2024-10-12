<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CuponRequest extends FormRequest
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
        if ($this->id) {
            $unique = [
                'required',
                'max:150',
                Rule::unique('cupons')->ignore($this->id)->where(function ($query) {
                    return $query->where('estado', 1);
                }),
            ];
        } else {
            $unique = [
                'required',
                'max:150',
                Rule::unique('cupons')->where(function ($query) {
                    return $query->where('estado', 1);
                }),
            ];
        }
        return [
            'cupon' => $unique,
            'descuento'  => 'required|numeric|min:1',
            'maximo'  => 'nullable|numeric|min:1',
            'fechaInicio'  => 'nullable|date',
            'fechaFin'  => 'nullable|date',
            'tipo'  => 'required',
            'finalizado'  => 'required',
        ];
    }
}
