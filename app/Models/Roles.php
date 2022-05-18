<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    public $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'state'
    ];
    public $timestamps = false;
}
