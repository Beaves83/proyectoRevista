<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;

class ProyectoController extends Controller
{
    //Devuelve un listado de usuarios
    public function listado(){   
        return response()->json(Proyecto::get(), 200);
    }
    
    //Devuelve el listado de tareas asociadas al proyecto.
    public function tareas(Request $request){   
        $json = $request -> input('json', null);
        
        $params = json_decode($json);
        $params_array = json_decode($json,true);
        
        //Obtener el usuario
        $proyecto = new Proyecto();
        $proyecto = Proyecto::find($params_array['Id_Proyecto']);
        //return $params_array['Id_Proyecto'];
        return $proyecto ->tareas;
    }
}
