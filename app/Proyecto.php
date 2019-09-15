<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Tarea;

class Proyecto extends Model
{
    protected  $table = 'proyecto';
    
    //Devuelve todos los elementos de tipo Usuario que estén relacionados con el proyecto.
    //Relación de uno a muchos.
    public function usuarios(){
        return $this->hasMany('Usuario');
    }
    
    //Devuelve todos los elementos de tipo Tarea que estén relacionados con el proyecto.
    //Relación de uno a muchos.
    public function tareas(){
        return $this->hasMany('Tarea');
    }
}
