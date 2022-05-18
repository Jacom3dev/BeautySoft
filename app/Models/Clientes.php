<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    public $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'document_id',
        'document',
        'cell',
        'direction',
        'email',
        'state',
    ];
    public $timestamps = true;

}
