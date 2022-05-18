<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UpdateUsers extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|max:50|email',
            'cell'=>'nullable|min:8|max:13',
            'direction'=>'nullable|min:5|max:40'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'correo',
            'cell' => 'celular',
            'direction' => 'direccion'
        ];
    }
}
