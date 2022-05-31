<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use DatesTraslator;
    
    public $table = 'proveedores';

    protected $primaryKey = 'NIT';
    public $fillable = ['supplier','enterprise','cell','email','direction','state'];
    public $timestamps = false;     
} 
