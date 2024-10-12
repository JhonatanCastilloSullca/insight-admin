<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedioRequest extends FormRequest
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
        return [
            'nombre' => 'required|max:150',
            'numero' => 'nullable|max:100',
            'porcentaje' => 'required|max:100',
            'banco' => 'nullable|max:100',
            'cci' => 'nullable|max:100',
            'descripcion' => 'nullable|max:250',
            'moneda_id'  => 'required|exists:medios,id',
        ];
    }
}
