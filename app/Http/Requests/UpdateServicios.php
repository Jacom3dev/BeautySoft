<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicios extends FormRequest
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
            'name' => ['required', 'string','min:2' ,'max:100'],
            'price'=>['required','min:3','numeric'],
            'description'=>['nullable','max:200','string'],
            
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'price' => 'precio',
            'description'=>'descripcion',
            
        ];
    }
}
