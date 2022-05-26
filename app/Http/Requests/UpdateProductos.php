<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductos extends FormRequest
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
            'img' => ['nullable', 'image'],
            'price_sale'=>['required','min:3','numeric'],
           
            
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'img' => 'img',
            'price_sale' => 'precio venta',
            
            
        ];
    }
}
