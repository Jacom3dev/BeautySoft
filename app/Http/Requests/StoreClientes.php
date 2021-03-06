<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientes extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u','min:3','max:50'],
            'email' => ['nullable', 'string','min:8','max:50', 'email', 'unique:clientes'],
            'cell'=>['nullable', 'regex:/(3)[0-9]{9}/'],
            'direction'=>['nullable','max:30'],
            'document_id' => ['required'],
            'document' => ['required','min:9','max:13','unique:clientes'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'correo',
            'cell' => 'celular',
            'direction'=>'direccion',
            'document_id' => 'tipo documento',
            'document' => 'documento'
        ];
    }
}
