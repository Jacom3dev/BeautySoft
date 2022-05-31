<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory, DatesTraslator;
    public $table = 'tipo_documentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

}
