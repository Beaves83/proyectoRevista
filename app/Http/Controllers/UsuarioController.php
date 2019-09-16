<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Tarea;

class UsuarioController extends Controller
{    
    //Devuelve un listado de usuarios
    public function listado(){   
        return response()->json(Usuario::get(), 200);
    }
    
    //Devuelve el listado de tareas asociadas al usuario en un proyecto.
    public function tareas(Request $request){   
        $json = $request -> input('json', null);
        
        $params = json_decode($json);
        $params_array = json_decode($json,true);
        
        //Obtener el usuario
        $usuario = new Usuario();
        $usuario = Usuario::find($params_array['Id_Usuario']);
        //return $params_array['Id_Proyecto'];
        return $usuario ->tareas;
    }
}
