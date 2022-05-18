<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    public $table = 'ventas';

    protected $primaryKey = 'id';

    public $fillable = ['client_id', 'user_id', 'price', 'state']; 

    public static $rules = [
        'client_id'=>'int,0',
        'user_id'=>'int,0',
        'price'=>'required|min:0|max:100000',
        'state'=>'in:1,0'
    ];

    public $timestamps = true;
    public function cliente(){
        return $this->hasOne('App\Models\Clientes', 'id', 'client_id');
    }
    public function usuario(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function producto(){
        return $this->hasOne('App\Models\Detalle_ventas_productos', 'id', 'product_id');
    }
    public function servicio(){
        return $this->hasOne('App\Models\Detalle_ventas_servicios', 'id', 'servis_id');
    }
    use HasFactory;
}
