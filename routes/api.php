<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::match(['get','post'],'/insercion1', function () {
    return view ('insercion1');
})->name('insertar');


Route::get('/exito', function () {
    return view ('exito');
})->name('exito');

Route::get('/error', function () {
    return view ('error');
}) ->name('error');



Route::get('/todosLosDatos', function () {
    return view('consultatodos');
}) ->name('consulta');



Route::get('/buscar', function () {
    return view('buscarxid');
})->name('buscarporid');


Route::get('/borrar', function () {
    return view('eliminar');
})->name('borrar');






/*

---------------------------------- CONTROLADORES  ------------------------------------------------------

*/

//definir controlador
Route::match(['post'],'/insertarEmpresa', [EmpresaController::class, 'store'])->name('insertarEmpresa');
Route::match(['post'], '/buscarid', [EmpresaController::class, 'consultaporid']) ->name('consultaxid');
Route::match(['post'], '/eliminar', [EmpresaController::class, 'borrar'])->name('eliminar');
/*
    Metodos Get
*/
Route::get('/todos', [EmpresaController::class, 'obtenertodo']) -> name('buscarTodos');





