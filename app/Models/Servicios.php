<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    public $tabla="servicios";
  
    public $fillable=[
        "name",
        "description",
        "price",
        "state"
    ];
    public $timestamps = false;
    // public static $rules = [
    //     'nombre_Servicios'=>'required|min:3|max:100|string',
    //     'descripcion'=>'nullable|string|max:300|min:5',
    //     'precio'=>'required|min:0|max:100000',
    //     'estado'=>'in:1,0'
    // ];
}
