<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Rutas de administrador -------------------------------------------------------------------------------------------------
// |
// |
// |

Route::group(['middleware' => ['auth','checkAdmin']], function(){

    Route::get('/administrador.home', function () {
        return view('/administrador/home');
    });

    Route::get('/administrador.registro', function () {
        return view('/administrador/registrarSupervisor');
    });

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