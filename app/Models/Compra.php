<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $table = 'compras';

    protected $primaryKey = 'id';

    public $fillable = ['id_supplier','user_id','price','state']; 

    public static $rules = [
        'id_supplier'=>'required|exists:proveedores,NIT',
        'user_id'=>'required|exists:User,id',
        'price'=>'required|min:0|max:100000', 
        'state'=>'in:1,0'
    ]; 

    public $timestamps = true;
    

    public function prov(){
        return $this->hasOne('App\Models\Proveedor', 'NIT', 'id_supplier');
    }
    
    public function usuario(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function producto(){
        return $this->hasOne('App\Models\Detalle_ventas_productos', 'id', 'product_id');
    }
}
