<?php

use App\Http\Controllers\Alumno\ProfileController;;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alumno\BecaController;


// Vistas Alumno ---------------------------------------------------------------------------------------------------------
// | 
// |

Route::group(['middleware' => ['auth','checkAlumno']], function(){

    Route::get('/alumno.home', function () {
        return view('/alumno/home');
    });

    Route::get('/alumno.solicitar_beca', function () {
        return view('/alumno/solicitar_beca');
    });

    Route::get('/alumno.formulario', function () {
        return view('/alumno/preguntas');
    });
    Route::get('/alumno.beca', [BecaController::class, 'show'])->name('alumno.beca');

    Route::get('/alumno.perfil', [ProfileController::class, 'show'])->middleware('auth');


    Route::get('/generar-pdf', [BecaController::class, 'generarPDF'])->name('generar.pdf');
    

});
