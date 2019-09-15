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
}
