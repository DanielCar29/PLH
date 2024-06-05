<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\registrar_supervisor;
use App\Http\Controllers\Administrador\perfil;
use App\Http\Controllers\Administrador\habilitar_convocatoria;




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

    // Rutas de accion habilitar convocatoria
    // |_______________________________________________________________________________________________________________

        // Route::get('/administrador.habilitar', function () {
        //     return view('/administrador/habilitarConvocatoria');
        // });

        Route::get('/administrador.habilitar',[habilitar_convocatoria::class,'index'])
                    ->name('administrador.habilitarConvocatoria');

        Route::Post('/administrador.activaConvocatoria',[habilitar_convocatoria::class,'habilitarConvocatoria'])
                ->name('administrador.activaConvocatoria');


    // |________________________________________________________________________________________________________________

    Route::get('/administrador.lista', function () {
        return view('/administrador/listaSolicitudes');
    });


    // Rutas de accion perfil
    // |________________________________________________________________________________________________________________

        Route::get('/administrador.perfil',[perfil::class,'index'])
                    ->name('administrador.perfil');

        Route::post('/administrador.ActualizaPerfil',[perfil::class,'actualizarPerfil'])
                    ->name('actualizarPerfil');

    // |________________________________________________________________________________________________________________

    Route::get('/administrador.ver', function () {
        return view('/administrador/verSolicitudAlumno');
    });


});