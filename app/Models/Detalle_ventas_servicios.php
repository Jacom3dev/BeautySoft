<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_ventas_servicios extends Model
{
    use DatesTraslator;

    public $table = 'detalle_ventas_servicios';

    protected $primaryKey = 'id';

    public $fillable = ['id', 'sale_id', 'servis_id', 'price',]; 


    public static $rules = [
        'sale_id'=>'required|exists:Ventas,id',
        'servis_id'=>'required|exists:Productos,id',
    ];

    public $timestamps = false;


    public function servicios(){
        return $this->belongsTo('App\Models\Servicios', 'servis_id', 'id');
    }
}
