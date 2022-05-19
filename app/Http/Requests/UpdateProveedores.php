<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedores extends FormRequest
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
            'enterprise' => ['required', 'regex:/^[\pL\s\-]+$/u','min:3','max:50'],
            'supplier' =>['required','string','min:3','max:50'],
            'cell'=>['numeric','min:10'],
            'email' => ['nullable','string', 'max:50'],
            
        ];
    }

    public function attributes()
    { 
        return [
            'enterprise' => 'empresa',
            'supplier' => 'proveedor',
            'cell' => 'celular',
            'email' => 'correo electrónico'
        ];
    }
}
