<?php

namespace App\Models;

use App\DatesTraslator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory, DatesTraslator;
    public $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'state'
    ];
    public $timestamps = false;
}
