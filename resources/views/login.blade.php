<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PLH: Proyect Large heart</title>
  <link rel="stylesheet" href="{{ asset('/css/login/style.css')}}">
  <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
  <div class="container text-center">

    <div class="row contenido-general">

      <div class="col-lg-4 col-md-5 col-sm-12 order-md-2 login-plh">
        <div>
          <img src="{{URL::asset('/img/logo-plh.png')}}" alt="Logo"  height="80" class="d-inline-block align-text-top">
        </div>
      
          <div class="instrucciones">
            <h4>PLH</h4>
            <p>"¡PLH apoya con becas alimenticias para estudiantes universitarios!
              Consigue el apoyo que necesitas para tu bienestar mientras estudias."
            </p>
          </div>

          <div>

            {{-- @include('auth.login') --}}

          </div>
        <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <form method="POST" action="{{ route('login') }}">
            @csrf

        <div class="input-login">
          <div>
            <x-input-label for="email" :value="__('Email')" />
          </div>
          
          <div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
                          :value="old('email')" required autofocus autocomplete="username" />
          </div>
          
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div class="input-login">
          <x-input-label for="password" :value="__('Password')" />
          <br>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

              
        </div>

        <div>
          <a class="dropdown-item text-decoration-none text-blue-dark" href="{{URL::asset('/registro')}}">Registrarse</a>
        </div>
        

        <div class="boton-login">
          <button type="submit">
            {{ __('Iniciar sesión') }}
          </button>
        </div>

        <div>
          <a class="dropdown-item text-decoration-none text-blue-dark" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        </div>
        
        </form>
      </div>

      <div class="col-lg-8 col-md-7 col-sm-12 order-md-1 contenido-bienvenida">

        <div class="nombre-proyecto color">
          <h4>Proyect Large Heart</h4>
        </div>

        <div class="bienvenida-titulo color">
          <h1>Bienvenido</h1>
        </div>

        <div class="bienvenida-parrafo color">
          <h5>
            En que consiste la beca Alimenticia: <br>
          </h5>
          <li>Se otorga a alumnos de muy escasos recursos.</li>
          <li>Es un apoyo alimenticio que se imparte en la cafetería de la institución; solo puede ser utilizado para consumir alimentos (ni golosinas ni refrescos).</li>
          <li>Esta se tramita en la Coordinación Institucional del Programa de Tutorías.</li>
        </div>

      </div>
    </div>
      
  </div>

  {{-- CDN'S de Bootstrap Js --}}
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
          integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
          crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
          integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
          crossorigin="anonymous">
  </script>
</body>
</html>