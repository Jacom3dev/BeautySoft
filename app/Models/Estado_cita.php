<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_cita extends Model
{
    use HasFactory, DatesTraslator;
    public $table = 'estado_cita';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

}
