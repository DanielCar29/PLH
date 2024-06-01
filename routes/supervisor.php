<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supervisor\visualizar_solicitudes;

// RUTAS DE SUPERVISOR

Route::group(['middleware' => ['auth','checkSupervisor']], function(){
    
    Route::get('/supervisor.home', function () {
        return view('/supervisor/home');
    });

    Route::get('/supervisor.ver_solicitud', function () {
        return view('/supervisor/ver_solicitud_alumno');
    });

    Route::get('/supervisor.visualizar_reporte', function () {
        return view('/supervisor/visualizar_reporte');
    });

    // Route::get('/supervisor.visualizar_solicitud', function () {
    //     return view('/supervisor/visualizar_solicitud');
    // });

    Route::get('/supervisor.visualizar_solicitud',[visualizar_solicitudes::class,'index'])
                ->name('supervisor.visualizar_solicitud');

    Route::get('/supervisor.ayuda', function () {
        return view('/supervisor/ayuda');
    });

    Route::get('/supervisor.perfil', function () {
        return view('/supervisor/perfil');
    });

    Route::get('/supervisor.grafica', function () {
        return view('/supervisor/grafica');
    });

});