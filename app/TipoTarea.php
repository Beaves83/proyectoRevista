<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTarea extends Model
{
    protected  $table = 'tipotarea';
    
     protected $fillable = [
        'codigo', 'nombre', 'descripcion'
    ];
}
