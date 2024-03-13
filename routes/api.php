<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthGerenteController;
use App\Http\Controllers\AuthFinanzasController;
use App\Http\Controllers\AuthController;

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
        Route::post('logoutt', 'logout');
        Route::get('profileagr', 'userProfileInfo');
        Route::put('updateinfoo', 'updateUser');
        Route::post('refreshh', 'refresh');
    });
    

});

//Ruta privadas hacia el gerente
Route::middleware(['onlygerente'])->group(function () {
    Route::controller(AuthGerenteController::class)->group(function () {
        Route::post('logoutt', 'logout');
        Route::get('profileagr', 'userProfileInfo');
        Route::put('updateinfoo', 'updateUser');
        Route::post('refreshh', 'refresh');
    });
    

});
//Ruta privadas hacia finanzas 
Route::middleware(['onlyfinanzas'])->group(function () {
    Route::controller(AuthFinanzasController::class)->group(function () {
        Route::post('logoutt', 'logout');
        Route::get('profileagr', 'userProfileInfo');
        Route::put('updateinfoo', 'updateUser');
        Route::post('refreshh', 'refresh');
    });
    

});
//Rutas publicas
Route::post('login', [AuthController::class, 'login']);

