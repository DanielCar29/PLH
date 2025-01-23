<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function showSupervisorMenu()
    {
        $user = Auth::user();
        return view('supervisor.navbar.menu-supervisor', compact('user'));
    }

    public function showAlumnoMenu()
    {
        $user = Auth::user();
        return view('alumno.nav.menu_alumno', compact('user'));
    }

    public function showAdministradorMenu()
    {
        $user = Auth::user();
        return view('administrador.navbar.menu', compact('user'));
    }
}
