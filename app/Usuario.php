<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tarea;

class Usuario extends Model
{
    protected  $table = 'usuario';
    
    public $timestamps = true;
    
    protected $fillable = [
        'codigo', 'username', 'nombre', 'apellidos', 'telefono', 'id_rol', 'fechainicio', 'direccion'
    ];
    
    //Añadir un Usuario
    
    //Devuelve todos los elementos de tipo Tarea que estén relacionados con el usuario.
    public function tareas(){       
        return $this->hasMany('App\Tarea', 'Id_Usuario', 'Id')
                ->select(array('Codigo', 'Nombre', 'Id_Usuario', 'Id_Proyecto', 'Id_Estado'));
    }
    
    //Devuelve todos los elementos de tipo Tarea que estén relacionados con el usuario en un proyecto.
    public function tareasPorProyecto($id_proyecto){       
        return $this->hasMany('App\Tarea', 'Id_Usuario', 'Id')
                ->where('tarea.Id_Proyecto', $id_proyecto);
    }
}

