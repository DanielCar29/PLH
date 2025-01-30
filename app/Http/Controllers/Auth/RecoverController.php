<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RecoverController extends Controller
{
    public function showRecoverForm()
    {
        return view('recover');
    }

    public function recover(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Almacenar el email en la sesión y redirigir a la vista para restablecer la contraseña
            $request->session()->put('email', $request->email);
            return redirect()->route('reset.password.form');
        } else {
            return back()->withErrors(['email' => 'El correo electrónico no está registrado.']);
        }
    }

    public function showResetPasswordForm(Request $request)
    {
        $email = $request->session()->get('email');
        return view('reset_password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed',
        ]);

        $user = User::where('email', $request->session()->get('email'))->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('status', 'Contraseña restablecida con éxito.');
        } else {
            return back()->withErrors(['password' => 'Hubo un problema al restablecer la contraseña.']);
        }
    }
}
