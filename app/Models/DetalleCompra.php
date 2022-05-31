<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use DatesTraslator;

    public $table = 'detalle_compra';
    protected $primaryKey = 'id';

    public $fillable =['buys_id','product_id','price','amount'];

    public static $rules = [
        
        'buys_id'  =>'required|exists:compras,id',
        'product_id'  =>'required|exists:productos,id',
        'price'=>'required|min:0|max:100000',
        'amount'=>'required|min:0|max:100000'
    ];
    
    public $timestamps = false;

    // public function proveedores(){
    //     return $this->hasOne('App\Models\Proveedor', 'NIT', 'id_supplier');
    // }
}
