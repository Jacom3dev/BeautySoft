<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class detalle_cita_servicios extends Model
{
    public $tabla="detalle_cita_servicios";
  
    public $fillable=[
        "id",
        "servis_id",
        "schedule_id",
        "price",

    ];
    public $timestamps = false;
}
