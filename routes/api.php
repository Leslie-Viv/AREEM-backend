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
use App\Http\Controllers\TipoEgresoController;
use App\Http\Controllers\ArchivarIngresoController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\ArchivarEgresoController;
use App\Http\Controllers\OrigenEgresoController;


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
        Route::get('verusuarios', 'getAllUsers');
        Route::get('obtenerusuario/{id}', 'getUserById');
        Route::post('nuevousuario', 'createUser');
        Route::patch('actualizarusuario/{id}', 'updateUser');
        Route::get('/check-email/{email}','checkEmailAvailability');
    });

});




Route::controller(EmpresaController::class)->group(function () {
    Route::post('nuevaempresa', 'crearempresa');
    Route::get('verempresa', 'verempresa');
    Route::get('obtenerempresa/{id}', 'obtenerEmpresaPorId');
    Route::patch('actualizarempresa/{id}', 'editarempresa');
    
});

Route::controller(EgresoController::class)->group(function () {
    Route::post('nuevoegreso', 'crearegreso');
    Route::get('veregreso', 'veregreso');
    Route::patch('actualizaregreso/{id}', 'editaregreso');
    Route::post('archivaregreso/{id}', 'archivaregreso');
    Route::get('obteneregreso/{id}', 'obtenerEgresoPorId');
    
});    

Route::controller(ArchivarEgresoController::class)->group(function () {
    Route::get('verarchivadose', 'getAllArchivadosE');
    Route::post('recuperaregreso/{id}', 'recuperaregreso');

});

Route::controller(ArchivarIngresoController::class)->group(function () {
    Route::get('verarchivadosi', 'getAllArchivadosI');
    Route::post('recuperaringreso/{id}', 'recuperar');

});

Route::controller(OrigenEgresoController::class)->group(function () {
    Route::post('nuevoorigen', 'crearorigen');
    Route::get('verorigen', 'verorigen');
    Route::patch('actualizarorigen/{id}', 'editarorigen');
    Route::get('obtenerorigen/{id}', 'obtenerOrigenPorId');
    
});

Route::controller(TipoEgresoController::class)->group(function () {
    Route::post('nuevotipo', 'creartipo');
    Route::get('vertipo', 'vertipo');
    Route::patch('actualizartipo/{id}', 'editartipo');
    Route::get('obtenertipo/{id}', 'obtenerTipoPorId');
    
});


Route::controller(IngresoController::class)->group(function () {
    Route::post('nuevoingreso', 'create');
    Route::get('veringreso', 'veringreso');
    Route::patch('actualizaringreso/{id}', 'update');
    Route::post('archivaringreso/{id}', 'archivar');
    Route::get('obteneringreso/{id}', 'obtenerIngresoPorId');
    
});
Route::controller(ProductoController::class)->group(function () {
    Route::post('nuevoproducto', 'crearproducto');
    Route::get('verproducto', 'verproducto');
    Route::patch('actualizarproducto/{id}', 'editarproducto');
    Route::delete('eliminarproducto/{id}', 'eliminarproducto');
    Route::get('obtenerproducto/{id}', 'obtenerProductoPorId');
    
});
Route::controller(UnidadNegocioController::class)->group(function () {
    Route::post('nuevaunidad', 'crearunidad');
    Route::get('verunidad', 'verunidad');
    Route::patch('actualizarunidad/{id}', 'editarunidad');
    Route::get('obtenerunidad/{id}', 'obtenerUnidadPorId');
    
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
