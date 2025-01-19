<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class perfil extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_supervisor = auth()->user()->id;

        $datos = DB::table('users as u')
            ->leftJoin('supervisores as s', 'u.id', '=', 's.usuario_id')
            ->leftJoin('carreras_supervisor as cs', 's.id', '=', 'cs.supervisor_id')
            ->leftJoin('carreras as c', 'cs.carreras_id', '=', 'c.id')
            ->select(
                'u.name AS Nombre', 
                'u.apellido_paterno AS ApellidoPaterno', 
                'u.apellido_materno AS ApellidoMaterno', 
                'u.email AS Correo', 
                'u.password AS Contraseña', 
                'c.carrera AS Carrera', 
                'u.id AS ID'
            )
            ->where('u.id', $id_supervisor)
            ->first();

        return view('supervisor.perfil', compact('datos'));
    }

    public function actualizarPerfil(Request $request){

    // Validación de los campos
    $validator = Validator::make($request->all(), [
        'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
        'apellidoPaterno' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
        'apellidoMaterno' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
        'correo' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users', 'email')->ignore(auth()->id()),
            'regex:/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/',
        ],
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.regex' => 'El nombre solo puede contener letras y espacios, no se permiten números.',
        'apellidoPaterno.required' => 'El apellido paterno es obligatorio.',
        'apellidoPaterno.regex' => 'El apellido paterno solo puede contener letras, no se permiten números.',
        'apellidoMaterno.required' => 'El apellido materno es obligatorio.',
        'apellidoMaterno.regex' => 'El apellido materno solo puede contener letras, no se permiten números.',
        'correo.required' => 'El correo es obligatorio.',
        'correo.email' => 'El correo debe ser válido.',
        'correo.unique' => 'El correo ya está registrado.',
    ]);

    // Si falla la validación, redirige con los errores
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator) // Pasa los errores a la vista
            ->withInput(); // Mantén los datos ingresados en los campos
    }

        $id_supervisor = auth()->user()->id;
        $nombre = $request->input('nombre');
        $apellidoPaterno = $request->input('apellidoPaterno');
        $apellidoMaterno = $request->input('apellidoMaterno');
        $correo = $request->input('correo');

        if(empty($request->pass)){
            DB::select('CALL ActualizarUsuario(?,?,?,?,?,?)',[
                $id_supervisor,
                $nombre,
                $apellidoPaterno,
                $apellidoMaterno,
                $correo,
                ''
            ]);
        }
        else{
            $pass = hash::make($request->input('pass'));

            DB::select('CALL ActualizarUsuario(?,?,?,?,?,?)',[
                $id_supervisor,
                $nombre,
                $apellidoPaterno,
                $apellidoMaterno,
                $correo,
                $pass
            ]);
        }

        $datos =DB::select('CALL ObtenerDatosSupervisor(?)',[$id_supervisor]);

        return redirect()->back()->with([
            'success' => 'Se han hecho cambios correctamente!',
            'datos_supervisor' => $datos,
        ]);

    }

}
