<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuiaRequest extends FormRequest
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
        if(request()->routeIs('guia.store')){
            $tipo = 'required|max:50|unique:guias';
            $pasword = 'required|max:191';
            $documentoUnique = 'required|unique:documentos,num_documento';
        } else {
            $tipo = 'required|max:50|unique:guias,usuario,' . $this->user->id;
            $pasword = 'nullable|max:191';
            $documentoUnique = 'required|unique:documentos,num_documento,' . $this->documento_id;
        }

        return [
            'nombre' => 'required|max:50',
            'celular' => 'nullable|max:15',
            'email' => 'nullable|email|max:250',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable',
            'imagen' => 'nullable',
            'num_documento' => $documentoUnique,
        ];
    }

}
