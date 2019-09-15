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
}
