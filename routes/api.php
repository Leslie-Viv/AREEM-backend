<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthGerenteController;
use App\Http\Controllers\AuthFinanzasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadNegocioController;
use App\Http\Controllers\EmpresaController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Ruta privadas hacia el administrador 
Route::middleware(['onlyadmin'])->group(function () {
    Route::controller(AuthAdminController::class)->group(function () {
        Route::post('logoutadmin', 'logoutAdmin');
        Route::get('profileadmin', 'userProfileAdmin');
        Route::put('updateinfoadmin', 'updateAdmin');


    });
    Route::controller(IngresoController::class)->group(function () {
        Route::post('nuevoingreso', 'create');
        Route::get('veringreso', 'veringreso');
        Route::patch('actualizaringreso/{id}', 'update');
        // Route::post('archivaringreso/{id}', 'archivar');

        Route::post('/ingresos/{id}/archivar', 'IngresoController@archivar')->name('ingresos.archivar');
        
    });

    Route::controller(ProductoController::class)->group(function () {
        Route::post('nuevoproducto', 'crearproducto');
        Route::get('verproducto', 'verproducto');
        Route::patch('actualizarproducto/{id}', 'editarproducto');
        
    });

    Route::controller(UnidadNegocioController::class)->group(function () {
        Route::post('nuevaunidad', 'crearunidad');
        Route::get('verunidad', 'verunidad');
        Route::patch('actualizarunidad/{id}', 'editarunidad');
        
    });
    Route::controller(EmpresaController::class)->group(function () {
        Route::post('nuevaempresa', 'crearempresa');
        Route::get('verempresa', 'verempresa');
        Route::patch('actualizarempresa/{id}', 'editarempresa');
        
    });
    Route::controller(TipoEgresoController::class)->group(function () {
        Route::post('nuevotipo', 'creartipo');
        Route::get('vertipo', 'vertipo');
        Route::patch('actualizartipo/{id}', 'editartipo');
        
    });




    
    

});

//Ruta privadas hacia el gerente
Route::middleware(['onlygerente'])->group(function () {
    Route::controller(AuthGerenteController::class)->group(function () {
        Route::post('logoutgerente', 'logoutGerente');
        Route::get('profilegerente', 'userProfileGerente');
        Route::put('updateinfogerente', 'updateGerente');
    });
    

});
//Ruta privadas hacia finanzas 
Route::middleware(['onlyfinanzas'])->group(function () {
    Route::controller(AuthFinanzasController::class)->group(function () {
        Route::post('logoutfinanzas', 'logoutFinanzas');
        Route::get('profilefinanzas', 'userProfileFinanzas');
        Route::put('updateinfofinanzas', 'updateFinanzas');
    });
    

});
//Rutas publicas
Route::post('login', [AuthController::class, 'login']);

