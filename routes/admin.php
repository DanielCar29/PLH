<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\registrar_supervisor;
use App\Http\Controllers\Administrador\perfil;
use App\Http\Controllers\Administrador\habilitar_convocatoria;
use App\Http\Controllers\Administrador\listaSolicitudes;
use App\Http\Controllers\Administrador\SupervisorController;





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
    Route::get('/administrador.listaSupervisores', [SupervisorController::class, 'listaSupervisores'])
    ->name('administrador.listaSupervisores');

        Route::get('/administrador.registro',[registrar_supervisor::class,'index'])
                    ->name('administrador.registrarSupervisor');

        Route::post('/administrador.registro',[registrar_supervisor::class,'registrarSupervisor'])
                    ->name('registrarSupervisor');

     Route::delete('/administrador/supervisores/{id}', [SupervisorController::class, 'eliminarSupervisor'])->name('administrador.eliminarSupervisor');
    
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

    // Route::get('/administrador.lista', function () {
    //     return view('/administrador/listaSolicitudes');
    // });

        Route::get('/administrador.lista',[listaSolicitudes::class,'index'])
                    ->name('administrador.listaSolicitudes');

        Route::get('/administrador.ver_solicitud/{id}',[listaSolicitudes::class,'verSolicitudAlumno'])
                    ->name('administrador.verSolicitudAlumno');

        Route::post('/aceptarSolicitud/{id}',[listaSolicitudes::class,'aceptarSolicitud'])
                    ->name('administrador.aceptarSolicitud');

        Route::post('/rechazarSolicitud/{id}',[listaSolicitudes::class,'rechazarSolicitud'])
                    ->name('administrador.rechazarSolicitud');

        Route::post('/esperaSolicitud/{id}',[listaSolicitudes::class,'esperaSolicitud'])
                    ->name('administrador.esperaSolicitud');

     Route::post('/administrador/activarBeca', [App\Http\Controllers\Administrador\listaSolicitudes::class, 'activarBeca'])->name('administrador.activarBeca');



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