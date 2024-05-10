<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\RolController;
use GuzzleHttp\Middleware;

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

/**RUTAS DE VISTAS */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*

---------------------------------- CONTROLADORES PARA EMPRESAS ------------------------------------------------------

/** Post */
Route::match(['post'], '/insertarEmpresa', [EmpresaController::class, 'store'])->name('insertarEmpresa');

/* Metodos Get */
Route::match(['get'], '/buscarEmpresaid', [EmpresaController::class, 'consultaporid'])->name('empresaxid');
Route::get('/allEmpresas', [EmpresaController::class, 'obtenertodo'])->name('empresaTodos');

/**Put */
Route::match(['put'], '/upEmpresa/{id}', [EmpresaController::class , 'update'])->name('upEmpresa');

/**Delete */
Route::match(['delete'], '/eliminar/{id}', [EmpresaController::class, 'borrar'])->name('delEmpresa');


// ---------------------------------- CONTROLADORES PARA ROLES ------------------------------------------------------ //

/**POST */
Route::match(['post'], '/insertarRol', [RolController::class, 'store'])->name('insertarRol') -> Middleware('auth');

/**GET */
Route::get('/buscarRolId/{id}', [RolController::class, 'showbyid'])->name('rolxid') -> Middleware('auth');;
Route::get('/allRoles', [RolController::class, 'show'])->name('rolesTodos');

/**PUT */
Route::match(['put'], '/upRol/{id}', [RolController::class , 'update'])->name('upRol') -> Middleware('auth');;

/**DELETE */
Route::match(['delete'], '/delRol/{id}', [RolController::class, 'delRol'])->name('delRol') -> Middleware('auth');;
