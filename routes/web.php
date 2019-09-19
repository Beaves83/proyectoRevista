<?php

use App\Usuario;

//Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

//Rutas del controlador de usuario
Route::get('/usuario/listado','UsuarioController@listado');
Route::get('/usuario/anadir','UsuarioController@anadir');
Route::get('/usuario/eliminar','UsuarioController@eliminar');
Route::get('/usuario/actualizar','UsuarioController@actualizar');
Route::get('/usuario/tareas','UsuarioController@tareas');


//Rutas del controlador de tarea
Route::get('/tarea/listado','TareaController@listado');
Route::get('/tarea/anadir','TareaController@anadir');
Route::get('/tarea/actualizar','TareaController@actualizar');
Route::get('/tarea/eliminar','TareaController@eliminar');


//Rutas del controlador de proyecto
Route::get('/proyecto/listado','ProyectoController@listado');
Route::get('/proyecto/anadir','ProyectoController@anadir');
Route::get('/proyecto/actualizar','ProyectoController@actualizar');
Route::get('/proyecto/tareas','ProyectoController@tareas');
Route::get('/proyecto/eliminar','ProyectoController@eliminar');


//Rutas de ejemplo
Route::get('/listados/usuarios', function () {
    return view('listados/usuarios');
});
Route::get('/temporal', function () {
    return view('temporal');
});

Route::get('/temporal2', function () {
    return view('temporal2');
});

Route::get('/temporal1','UsuarioController@listado2');