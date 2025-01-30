<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Recuperar Cuenta</title>
  <link rel="stylesheet" href="{{ asset('/css/recover/style.css')}}">
  <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
</head>
<body>
  <div class="container text-center">
    <div class="row contenido-general">
      <div class="col-12 login-plh">
        <div>
          <img src="{{URL::asset('/img/logo-plh.png')}}" alt="Logo" height="80" class="d-inline-block align-text-top">
        </div>
        <div class="instrucciones">
          <h4>Recuperar Cuenta</h4>
          <p>Introduce tu correo electrónico para recuperar tu cuenta.</p>
        </div>
        <form method="POST" action="{{ route('recover') }}">
          @csrf
          <div class="input-login">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
          <div class="boton-login">
            <button type="submit">
              {{ __('Enviar') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
