<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/404', function () {
    return view('/errors/404');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/preguntas_frecuentes', function () {
    return view('preguntas_frecuentes');
});

// ---------------------

// Vistas de supervisor

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

    Route::get('/supervisor.visualizar_solicitud', function () {
        return view('/supervisor/visualizar_solicitud');
    });

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

// Vistas Alumno

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

    Route::get('/alumno.beca', function () {
        return view('/alumno/ver_beca');
    });

    Route::get('/alumno.perfil', function () {
        return view('/alumno/perfil');
    });

});


// Rutas de administrador
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


});