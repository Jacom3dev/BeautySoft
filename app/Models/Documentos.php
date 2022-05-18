<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;
    public $table = 'tipo_documentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

}
