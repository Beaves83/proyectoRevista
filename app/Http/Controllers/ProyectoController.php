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
    
    //añade un proyecto a la base de datos.
    public function anadir(Request $request){    
        //Recoger los datos del usuario por post
        $json = $request -> input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        
        if(!empty($params) && !empty($params_array)){
          
            //Limpiar datos
            $params_array = array_map('trim',$params_array);

            //Validar esos datos
            $validate = \Validator::make($params_array, [
                'descripcion'       => 'max:400',
                'numero'            => 'numeric|unique:proyecto',
                'codigo'            => 'required|alpha_num|unique:proyecto|max:150',
                'nombre'            => 'required|max:150',
                'fechainicio'       => 'date',
                'fechafinprevista'  => 'date',
                'id_estado'         => 'required|numeric'
            ]);
            
            if($validate->fails()){        
                $data = array (
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El proyecto no se ha creado.',
                    'errors' => $validate->errors()
                );            
            } else {
                //Crear el usuario
                $proyecto = new Proyecto();
                $proyecto->descripcion = $params_array['descripcion'];
                $proyecto->numero = $params_array['numero'];
                $proyecto->codigo = $params_array['codigo'];
                $proyecto->nombre = $params_array['nombre'];
                $proyecto->fechainicio = $params_array['fechainicio'];
                $proyecto->fechafinprevista = $params_array['fechafinprevista'];
                $proyecto->id_estado = $params_array['id_estado'];

                //Guardar el usuario. Esto es un 'insert into' en BBDD.
                $proyecto->save();
            
            
                $data = array (
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El proyecto se ha creado correctamente.',
                    'proyecto' => $proyecto
                );
            }
        } else {           
     
            $data = array (
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Los datos enviados no son correctos.'
                );
        }
        
        return $data;
        //return response() -> json($data, $data['code']);       
    }
    
    
        //Elmiinamos una tarea.
    public function eliminar(Request $request){   
        $json = $request -> input('json', null);      
        $params_array = json_decode($json,true);
        
        //Eliminamos el usuario
        $proyecto = \App\Proyecto::find($params_array['Id_Proyecto']);
        
        if(!empty($proyecto) && ($proyecto->Id_Estado != "10")){
            Proyecto::where('id', $params_array['Id_Proyecto'])
            ->update(['id_estado' => "10"]);
            return "El proyecto con el id ".$params_array['Id_Proyecto']." ha sido borrado.";
        }     
        else {
            return "No se ha encontrado el proyecto.";
        } 
    }
}
