<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tarea;
use App\Usuario;
use App\Proyecto;

class Tarea extends Model
{
    protected  $table = 'tarea';
    
    public $timestamps = true;
    
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'fechainicio', 'id_usuario', 'id_proyecto',
        'id_tipotarea', 'id_estado'
    ];
    
    //Muchas tareas pueden estar asociadas a un usuario.
    //Relación de uno a muchos inversa ( muchos a uno).
    public function usuario(){
        return $this->belongsTo('Usuario' , 'Id_Usuario');
    }
    
    //Muchas tareas pueden estar asociadas a un proyecto.
    //Relación de uno a muchos inversa ( muchos a uno).
    public function proyecto(){
        return $this->belongsTo('Proyecto' , 'Id_Proyecto');
    }
    
}
