<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_ventas_productos extends Model
{
    
    use DatesTraslator;
    
    public $table = 'detalle_ventas_productos';

    protected $primaryKey = 'id';

    public $fillable = ['id', 'sale_id', 'product_id', 'price', 'amount']; 


    public static $rules = [
        'sale_id'=>'required|exists:ventas,id',
        'product_id'=>'required|exists:Productos,id',
        'amount'=>'required|min:0|max:100000'
    ];

    public $timestamps = false;

    public function productos(){
        return $this->belongsTo('App\Models\Productos', 'product_id', 'id');
    }
}
