<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tarea;

class Usuario extends Model
{
    protected  $table = 'usuario';
    
    //Devuelve todos los elementos de tipo Tarea que estén relacionados con el usuario.
    //Relación de uno a muchos.
    public function tareas(){       
        return $this->hasMany('App\Tarea', 'Id_Usuario', 'Id')->where('tarea.Id_Proyecto', '1');
    }
    
    public function tareasPorProyecto($id_proyecto){       
        return $this->hasMany('App\Tarea', 'Id_Usuario', 'Id')->where('tarea.Id_Proyecto', $id_proyecto);
    }
}

