<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            'email' => 'required|string|min:8|email|max:100',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'correo',
            'password' => 'contraseña'
        ];
    }
}
