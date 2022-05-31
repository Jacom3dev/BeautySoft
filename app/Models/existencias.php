<?php

namespace App\models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Model;

class existencias extends Model
{
    use DatesTraslator;
    public $tabla="existencias";
  
    public $fillable=[
        "name",
        "amount",
        "price",
        "state",

    ];
    
    public $timestamps = false;
}
