<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarea;

class TareaController extends Controller
{
    //Devuelve un listado de usuarios
    public function listado(){   
        return response()->json(Tarea::get(), 200);
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
                'id_usuario'        => 'numeric',
                'codigo'            => 'required|alpha_num|unique:proyecto|max:150',
                'nombre'            => 'required|max:150',
                'fechainicio'       => 'date',
                'id_proyecto'       => 'required|numeric',
                'id_estado'         => 'required|numeric',
                'id_tipotarea'      => 'required|numeric',
            ]);
            
            if($validate->fails()){        
                $data = array (
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'La tarea no se ha creado.',
                    'errors' => $validate->errors()
                );            
            } else {
                //Crear el usuario
                $tarea = new Tarea();
                $tarea->descripcion = $params_array['descripcion'];
                $tarea->id_usuario = $params_array['id_usuario'];
                $tarea->codigo = $params_array['codigo'];
                $tarea->nombre = $params_array['nombre'];
                $tarea->fechainicio = $params_array['fechainicio'];
                $tarea->id_proyecto = $params_array['id_proyecto'];
                $tarea->id_estado = $params_array['id_estado'];
                $tarea->id_tipotarea = $params_array['id_tipotarea'];

                //Guardar el usuario. Esto es un 'insert into' en BBDD.
                $tarea->save();
            
            
                $data = array (
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'La tarea se ha creado correctamente.',
                    'tarea' => $tarea
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
}
