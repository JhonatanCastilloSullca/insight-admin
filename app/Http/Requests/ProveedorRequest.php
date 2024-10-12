<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            $tipo = 'required|max:50|unique:proveedors,nombre,' . $this->id;
        } else {
            $tipo = 'required|max:50|unique:proveedors';
        }
        return [
            'nombre' => $tipo,
            'celular' => 'nullable|max:20',
            'email' => 'nullable|email',
            'direccion' => 'nullable|max:250',
            'categoria_id' => 'required|exists:categorias,id'
        ];
    }
}
