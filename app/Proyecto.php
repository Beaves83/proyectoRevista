<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Tarea;

class Proyecto extends Model
{
    protected  $table = 'proyecto';
    
    public $timestamps = true;
    
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'numero', 'fechainicio', 'fechafinprevista', 'id_estado'
    ];
    
    //Devuelve todos los elementos de tipo Tarea que estén relacionados con el proyecto.
    public function tareas(){
        return $this->hasMany('App\Tarea', 'Id_Proyecto', 'Id')
                
                ->select(array('Codigo', 'Nombre', 'Id_Usuario', 'Id_Proyecto', 'Id_TipoTarea','Id_Estado'))
                ->where('Id_Estado', '!=', '9');
    }
}
