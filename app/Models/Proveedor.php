<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $table = 'proveedores';

    protected $primaryKey = 'NIT';
    public $fillable = ['supplier','enterprise','cell','email','direction','state'];
    public $timestamps = false;     
} 
