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
            'cliente_id' => ['required'],
            'date' => ['required','date'],
            'hourI'=>['required'],
            'hourF' => ['required'],
            'description' => ['nullable','max:100'],
            'direction'=>['nullable','max:100'],
            'servicios_id'=>['required'],
            'price' => ['required']
           
        ];
    }

    public function attributes()
    { 
        return [
            'client_id' => 'cliente_id',
            'date' => 'date',
            'hourI'=>'hourI',
            'hourF' => 'hourF',
            'direction'=>'direction',
            'description' => 'description',
            'price' => 'price',
        ];
    }

}
