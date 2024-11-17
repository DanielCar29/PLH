<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(auth()->user()->role == 'supervisor'){
            return redirect()->intended(RouteServiceProvider::HOME_SUPERVISOR);
        }
        elseif(auth()->user()->role == 'alumno'){
            return redirect()->intended(RouteServiceProvider::HOME_ALUMNO);
        }
        elseif(auth()->user()->role == 'administrador'){
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
        }
        else{
            echo 'Uy no';
        }

        // Buscar cómo determinar la logica para saber qué usuarioa se ha logeado
        // return redirect()->intended(RouteServiceProvider::HOME_SUPERVISOR);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
