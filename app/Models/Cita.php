<?php

namespace App\models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    
    use DatesTraslator;

    public $tabla="citas";
    
    protected $primaryKey = 'id';

    public $fillable=[
        "user_id",
        "client_id",
        "date",
        "hourI",
        "hourF",
        "direction",
        "description",
        "price",
        "state_id",
    ];
    public $timestamps = true;
    public function cliente(){
        return $this->hasOne('App\Models\Clientes', 'id', 'client_id');
    }
    public function usuario(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function servicio(){
        return $this->hasOne('App\Models\detalle_cita_servicios', 'id', 'servis_id');
    }
  
    
    use HasFactory;
}
