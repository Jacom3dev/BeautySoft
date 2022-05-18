<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientes extends FormRequest
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
            'name' => ['required', 'string','min:2' ,'max:50'],
            'email' => ['nullable', 'string','min:8','max:50', 'email'],
            'cell'=>['nullable','min:9','max:13'],
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
            'direction' => 'dirreccion',
            'document_id' => 'tipo documento',
            'document' => 'documento'
        ];
    }
}
