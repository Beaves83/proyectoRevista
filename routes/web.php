<?php

use App\Usuario;

//Rutas del controlador de usuario
Route::get('/usuario/listado','UsuarioController@listado');
Route::get('/usuario/añadir','UsuarioController@añadir');
Route::get('/usuario/actualizar','UsuarioController@actualizar');
Route::get('/usuario/tareas','UsuarioController@tareas');


//Rutas del controlador de tarea
Route::get('/tarea/listado','TareaController@listado');
Route::get('/tarea/añadir','TareaController@añadir');
Route::get('/tarea/actualizar','TareaController@actualizar');


//Rutas del controlador de proyecto
Route::get('/proyecto/listado','ProyectoController@listado');
Route::get('/proyecto/añadir','ProyectoController@añadir');
Route::get('/proyecto/actualizar','ProyectoController@actualizar');