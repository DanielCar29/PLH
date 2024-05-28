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

      <div class="col-8 contenido-bienvenida">

        <div class="nombre-proyecto color">
          <h4>Proyect Large Heart</h4>
        </div>

        <div class="bienvenida-texto color">
          <h4>Nice to see you again!</h4>
        </div>

        <div class="bienvenida-titulo color">
          <h1>WELCOME BACK!</h1>
        </div>

        <div class="bienvenida-parrafo color">
          <p>
            Tempor ipsum qui ea culpa nulla est exercitation anim consectetur magna.
            In aliqua exercitation eiusmod quis aliquip Lorem ad commodo ut cupidatat proident.
          </p>
        </div>

      </div>

      <div class="col-4 login-plh">
        <div>
          <img src="{{URL::asset('/img/logo-plh.png')}}" alt="Logo"  height="80" class="d-inline-block align-text-top">
        </div>
      
          <div class="instrucciones">
            <h4>Login Account</h4>
            <p>Exercitation enim adipisicing quis dolore irure reprehenderit labore consequat.</p>
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

        <!-- Remember Me -->
        <div class="block mt-4">
          <label for="remember_me" class="inline-flex items-center">
              <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
              <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
          </label>
        </div>

        <div class="flex items-center justify-end mt-4">
          @if (Route::has('password.request'))
              <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                  {{ __('Forgot your password?') }}
              </a>
          @endif
        
        <div class="boton-login">
          <button type="submit">
            {{ __('Log in') }}
          </button>
        </div>
        
        </form>
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