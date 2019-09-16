<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected  $table = 'rol';
    
    protected $fillable = [
        'codigo', 'nombre', 'descripcion'
    ];
}
