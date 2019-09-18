<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Tarea;

class UsuarioController extends Controller
{    
    
    //añade un usuario a la base de datos.
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
                'username'      => 'required|unique:usuario|max:150',
                'password'      => 'max:150',
                'codigo'        => 'required|unique:usuario|max:150',
                'nombre'        => 'required|max:150',
                'apellidos'     => 'max:150',
                'id_rol'        => 'required|numeric',
                'telefono'      => 'max:150'
  
            ]);
            
            if($validate->fails()){        
                $data = array (
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se ha creado.',
                    'errors' => $validate->errors()
                );            
            } else {
                //Crear el usuario
                $user = new Usuario();
                $user->username = $params_array['username'];
                $user->password = $params_array['password'];
                $user->codigo = $params_array['codigo'];
                $user->nombre = $params_array['nombre'];
                $user->apellidos = $params_array['apellidos'];
                $user->telefono = $params_array['telefono'];
                $user->direccion = $params_array['direccion'];
                $user->id_rol = $params_array['id_rol'];
                $user->fechainicio = today();

                //Guardar el usuario. Esto es un 'insert into' en BBDD.
                $user->save();
            
            
                $data = array (
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario  se ha creado correctamente.',
                    'user' => $user
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
    
    //Elmiinamos un usuario
    public function eliminar(Request $request){   
        $json = $request -> input('json', null);      
        $params_array = json_decode($json,true);
        
        //Eliminamos el usuario
        $usuario = Usuario::find($params_array['Id_Usuario']);
        
        $usuarioBorrado = Usuario::where('id',$params_array['Id_Usuario'])->delete();
        if($usuarioBorrado > 0){
            return "Usuario con el id ".$params_array['Id_Usuario']." ha sido borrado.";
        }     
        else {
            return "No se ha encontrado el usuario.";
        } 
    }
    
    //Devuelve un listado de usuarios
    public function listado(){   
        return response()->json(Usuario::get()->where('Id_Estado', '!=', '9'), 200);
    }
    
    //Devuelve el listado de tareas asociadas al usuario y a un proyecto.
    public function tareas(Request $request){   
        $json = $request -> input('json', null);      
        $params_array = json_decode($json,true);
        
        //Obtener el usuario
        $usuario = Usuario::find($params_array['Id_Usuario']);

        return $usuario ->tareasPorProyecto($params_array['Id_Proyecto'])->get();
        
    }
}
