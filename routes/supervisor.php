<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supervisor\visualizar_solicitudes;
use App\Http\Controllers\Supervisor\visualizar_reporte;
use App\Http\Controllers\Supervisor\perfil;


// RUTAS DE SUPERVISOR

Route::group(['middleware' => ['auth','checkSupervisor']], function(){
    
    Route::get('/supervisor.home', function () {
        return view('/supervisor/home');
    });

    // Rutas de accion visualizar reporte
    // |_____________________________________________________________________________________________

        Route::get('/supervisor.visualizar_reporte',[visualizar_reporte::class,'index'])
                    ->name('supervisor.visualizar_reporte');

        Route::get('/supervisor.grafica/{id}',[visualizar_reporte::class,'verGrafica'])
                    ->name('supervisor.ver_grafica');     
    
    //Ruta para mandar correo de no uso de un alumno
        Route::post('/supervisor.correoNoUso/{nombre}/{apellidoPaterno}/{apellicoMaterno}/{email}',
        [visualizar_reporte::class,'correoNoUso'])
                    ->name('supervisor.correoNoUso');

    // |_____________________________________________________________________________________________

    // Rutas de accion visualizar solicitud
    // |_____________________________________________________________________________________________

        Route::get('/supervisor.visualizar_solicitud',[visualizar_solicitudes::class,'index'])
                    ->name('supervisor.visualizar_solicitud');

        Route::get('/supervisor.ver_solicitud/{id}',[visualizar_solicitudes::class,'verSolicitudAlumno'])
                    ->name('supervisor.ver_solicitud');

        Route::post('/aceptarSolicitud_supervisor/{id}',[visualizar_solicitudes::class,'aceptarSolicitud'])
                    ->name('supervisor.aceptarSolicitud');

        Route::post('/rechazarSolicitud_supervisor/{id}',[visualizar_solicitudes::class,'rechazarSolicitud'])
                    ->name('supervisor.rechazarSolicitud');

        //Ruta para esperar solicitud se ha omitido para esta versión
        // Route::post('/esperaSolicitud_supervisor/{id}',[visualizar_solicitudes::class,'esperaSolicitud'])
        //             ->name('supervisor.esperaSolicitud');

        Route::post('/enviarListaSolicitudes',[visualizar_solicitudes::class,'enviarListaSolicitudes'])
                    ->name('supervisor.enviarListaSolicitudes');

    // |______________________________________________________________________________________________

    // Rutas de accion perfil
    // |______________________________________________________________________________________________

        // Route::get('/supervisor.perfil', function () {
        //     return view('/supervisor/perfil');
        // });

        Route::get('/supervisor.perfil',[perfil::class,'index'])
                ->name('supervisor.perfil');

        Route::post('/supervisor.actualiza_perfil',[perfil::class,'actualizarPerfil'])
                    ->name('supervisor.actualiza_perfil');        

    //|_______________________________________________________________________________________________ 
    
    Route::get('/supervisor.ayuda', function () {
        return view('/supervisor/ayuda');
    });

    Route::get('/supervisor.grafica', function () {
        return view('/supervisor/grafica');
    });

});