<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_cita extends Model
{
    use HasFactory;
    public $table = 'estado_cita';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

}
