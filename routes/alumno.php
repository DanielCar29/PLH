<?php

use App\Http\Controllers\Alumno\ProfileController;;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alumno\BecaController;
use App\Http\Controllers\Alumno\FormularioSolicitud;


// Vistas Alumno ---------------------------------------------------------------------------------------------------------
// | 
// |

Route::group(['middleware' => ['auth','checkAlumno']], function(){

    Route::get('/alumno.home', function () {
        return view('/alumno/home');
    });

    Route::get('/alumno.solicitar_beca', function () {
        return view('/alumno/solicitar_beca');
    })->name('alumno.solicitud');
    
// Rutas formulario
    // |__________________________________________________________________________________________________
    Route::get('/alumno.formulario', [FormularioSolicitud::class, 'show'])->name('alumno.formulario');

    Route::post('/alumno.formulario', [FormularioSolicitud::class, 'enviarFormulario'])->name('alumno.formulario');
    //* Route::get('', function () {
     //   return view('/alumno/preguntas');
    //});
// Rutas ver beca
    // |__________________________________________________________________________________________________
    Route::get('/alumno.beca', [BecaController::class, 'show'])->name('alumno.beca');

    // Rutas perfil
    // |__________________________________________________________________________________________________
        Route::get('/alumno.perfil', [ProfileController::class, 'show'])
                ->name('alumno.perfil');

        Route::post('/alumno.actualizarPerfil/{id}',[ProfileController::class,'actualizarPerfil'])
                    ->name('alumno.actualizaPerfil');

    // |__________________________________________________________________________________________________

    Route::get('/generar-pdf', [BecaController::class, 'generarPDF'])->name('generar.pdf');
    

});
