<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\registrar_supervisor;


// Rutas de administrador -------------------------------------------------------------------------------------------------
// |
// |
// |

Route::group(['middleware' => ['auth','checkAdmin']], function(){

    Route::get('/administrador.home', function () {
        return view('/administrador/home');
    });

    // Rutas de acción Registrar supervisor
    // |_______________________________________________________________________________________________________________

    Route::get('/administrador.registro',[registrar_supervisor::class,'index'])
                ->name('administrador.registrarSupervisor');

    Route::post('/administrador.registro',[registrar_supervisor::class,'registrarSupervisor'])
                ->name('registrarSupervisor');
    
    // |_______________________________________________________________________________________________________________

    Route::get('/administrador.habilitar', function () {
        return view('/administrador/habilitarConvocatoria');
    });

    Route::get('/administrador.lista', function () {
        return view('/administrador/listaSolicitudes');
    });

    Route::get('/administrador.perfil', function () {
        return view('/administrador/perfil');
    });

    Route::get('/administrador.ver', function () {
        return view('/administrador/verSolicitudAlumno');
    });


});