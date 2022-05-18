<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class existencias extends Model
{
    public $tabla="existencias";
  
    public $fillable=[
        "name",
        "amount",
        "price",
        "state",

    ];
    
    public $timestamps = false;
}
