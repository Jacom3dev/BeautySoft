<?php

namespace App\models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use DatesTraslator;
    
    public $tabla="productos";
  
    public $fillable=[
        "name",
        "img",
        "amount",
        "price_sale",
        "price_buys",
        "state",

    ];
    
    public $timestamps = false;
}
