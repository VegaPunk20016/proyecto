<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\userController;
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
Route::match(['post'], '/insertarEmpresa', [EmpresaController::class, 'store'])->name('insertarEmpresa')->middleware('admin');

/* Metodos Get */
Route::match(['get'], '/buscarEmpresaid/{id}', [EmpresaController::class, 'consultaporid'])->name('empresaxid')  ->middleware('admin');
Route::get('/allEmpresas', [EmpresaController::class, 'obtenertodo'])->name('empresaTodos')  ->middleware('admin');

/**Put */
Route::match(['put'], '/upEmpresa/{id}', [EmpresaController::class, 'update'])->name('upEmpresa')  ->middleware('admin');

/**Delete */
Route::match(['delete'], '/eliminar/{id}', [EmpresaController::class, 'borrar'])->name('delEmpresa')  ->middleware('admin');


// ---------------------------------- CONTROLADORES PARA ROLES ------------------------------------------------------ //

/**POST */
Route::match(['post'], '/insertarRol', [RolController::class, 'store'])->name('insertarRol') ->middleware('admin');

/**GET */
Route::get('/buscarRolId/{id}', [RolController::class, 'showbyid'])->name('rolxid') ->middleware('admin');
Route::get('/allRoles', [RolController::class, 'show'])->name('rolesTodos');

/**PUT */
Route::match(['put'], '/upRol/{id}', [RolController::class, 'update'])->name('upRol') ->middleware('admin');

/**DELETE */
Route::match(['delete'], '/delRol/{id}', [RolController::class, 'delRol'])->name('delRol') ->middleware('admin');


/** ------------------------------- CONTROLADORES PARA USERS DE EMPRESA  ---------------------------------------- */

Route::post('/login', [userController::class, 'login'])->name('login');

Route::post('/registro', [userController::class, 'register'])->name('registro');

Route::post('/logout',[userController::class, 'logout'])->name('logout');

Route::delete('/deleteAccount', [userController::class, 'delete'])->name('logout');




