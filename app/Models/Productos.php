<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    public $tabla="productos";
  
    public $fillable=[
        "name",
        "img",
        "amount",
        "price",
        "state",

    ];
    
    public $timestamps = false;
}
