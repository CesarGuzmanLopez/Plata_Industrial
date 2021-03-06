<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

*/

Auth::routes();
Route::get('/index', "HomeController@index")->name("/index");
Route::get('/',  function () {
    return view('home2');
})->name("/");

Route::group(['middleware' =>"auth", 'prefix' => 'Temas', 'as' => 'Temas'], function (){
    $path="Test\TemasController";
    Route::get  ('/', "$path@index")->name("/");
    Route::post('/addTemas', "$path@addTemas")->name("/addTemas");
    Route::post('/addCurso', "$path@addCurso")->name("/addCurso");
    Route::post('/addGrado', "$path@addGrado")->name("/addGrado");
    Route::get('/EditTemas/{id}', "$path@EditTemas")->name("/EditTemas");
    Route::post('/EditTemas/{id}', "$path@EditTemasP")->name("/EditTemasP");
    Route::post('/AddSubtema/{id}', "$path@AddSubtema")->name("/AddSubtema");
    Route::post('/AddTemaCurso/{id}', "$path@AddTemaCurso")->name("/AddTemaCurso");
    Route::post('/ElminarTema/{id}', "$path@ElminarTema")->name("/ElminarTema");
    Route::post('/ElminarCurso/{id}', "$path@ElminarCurso")->name("/ElminarCurso");
    Route::post('/ElminarGrado/{id}', "$path@ElminarGrado")->name("/ElminarGrado");
    Route::get('/EditGrados/{id}', "$path@EditGrados")->name("/EditGrados");
    Route::post('/EditGrados/{id}', "$path@EditGradosP")->name("/EditGradosP");
    Route::get('/EditCursos/{id}', "$path@EditCursos")->name("/EditCursos");
    Route::post('/EditCursos/{id}', "$path@EditCursosP")->name("/EditCursosP");
});
Route::group(['middleware' =>"auth", 'prefix' => 'CrearCurso', 'as' => 'CrearCurso'], function (){
    $path  ="Cursos";
    Route::post('/AddTemasACurso/{id}', "$path@TemasToCurso")->name("/AddTemasACursoPOST");
    Route::get('/AddTemasACurso/{id}', "$path@AddTemasACursoid")->name("/AddTemasACursoid");
    Route::get('/GetTemas', "$path@GetTemas")->name("GetTemas");
    Route::put('/AddTemaS', "$path@AddTemaS")->name("AddTemaS");
    Route::post('/addCurso', "$path@addCurso")->name("/addCurso");
    Route::get  ('/', "$path@index")->name("/");
});

Route::group(['middleware' =>"auth", 'prefix' => 'Reactivos', 'as' => 'Reactivos'], function (){
    $path="Test\ReactivosController";
    Route::get  ('/', "$path@index")->name("/");
    Route::post('/uploadImagen', "$path@uploadImagen")->name("/subirImagen");
    Route::get('/AdminReactivos', "$path@AdminReactivos")->name("/AdminReactivos");
    Route::get('/editarReactivo/{id}', "$path@editarReactivo")->name("/editarReactivo");
    Route::post('/editarReactivo/{id}', "$path@editReactivo")->name("/editarReactivopost");
    Route::get('/AdminRetroalmientacion',"$path@AdminRetroalmientacion")->name("/AdminRetroalmientacion");
    Route::post('/AgregaRetroalimentacion',"$path@AgregaRetroalimentacion")->name("/AgregaRetroalimentacion");
    Route::post('/EliminarRetroalimentacion/{id}',"$path@EliminarRetroalimentacion")->name('/EliminarRetroalimentacion');
    Route::get('/editarRetro/{id}',"$path@editarRetro")->name('/editarRetro');
    Route::post('/editarRetro/{id}',"$path@editarRetroPost")->name('/editarRetroPost');
    Route::get('/AdminOpciones', "$path@AdminOpciones")->name("/AdminOpciones");
    Route::post('/AddOpciones', "$path@AddOpciones")->name("/AddOpciones");
    Route::post('/EliminarOpciones/{id}', "$path@EliminarOpciones")->name("/EliminarOpciones");
    Route::get('/EditarOpciones/{id}', "$path@EditarOpciones")->name("/EditarOpciones");
    Route::post('EditarOpcionesPost/{id}', "$path@EditarOpcionesPost")->name("/EditarOpcionesPost");    
    Route::post('/AddReactivo', "$path@AddReactivo")->name("/AddReactivo");
    Route::post('/EliminarReactivo/{id}',"$path@EliminarReactivo")->name('/EliminarReactivo');
    Route::get('/CrearReactivo',"$path@CrearReactivo")->name('/CrearReactivo');
    Route::get('/CrearReactivo',"$path@CrearReactivo")->name('/CrearReactivo');
    Route::get('/getTemasCurso/{id}',"$path@getTemasCurso")->name('/getTemasCurso');
    Route::get('/getGrado/{id}',"$path@getGrado")->name('/getGrado');
    
    Route::get('/Listas',"$path@Listas")->name('/Listas');
    Route::get('/getReactivos',"$path@getReactivos")->name('/getReactivos');
    Route::post('/AddListaReactivo',"$path@AddListaReactivo")->name('/AddListaReactivo');

    
});
