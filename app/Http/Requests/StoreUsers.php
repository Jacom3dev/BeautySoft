<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsers extends FormRequest
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
            'rol_id'=> 'required',
            'name' => 'required|required|regex:/^[\pL\s\-]+$/u|min:3|max:50',
            'email' => 'required|string|max:50|email|unique:users',
            'cell'=>'nullable|min:8|max:13',
            'direction'=>'nullable|min:5|max:40',
            'password' => 'required|string|min:8|max:16',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'correo',
            'cell' => 'celular',
            'direction' => 'direccion',
            'password' => 'contraseña'
        ];
    }
}
