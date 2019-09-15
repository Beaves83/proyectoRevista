<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tarea;

class Usuario extends Model
{
    protected  $table = 'usuario';
    
    //Devuelve todos los elementos de tipo Tarea que estén relacionados con el usuario.
    //Relación de uno a muchos.
    public function tareas(Request $request){
        $listadoTareas = $this->hasMany('Tarea');       
        return $listadoTareas;
    }
}
