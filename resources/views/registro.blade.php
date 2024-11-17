<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('/css/registro/style.css')}}">
  {{-- CDN de Boostrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card contenido">
          <div class="card-body">
            <div class="d-flex justify-content-center">
              <img src="{{URL::asset('/img/logo-plh.png')}}" alt="Logo" height="80" class="d-inline-block align-text-top">
          </div>
          
            <h1 class="text-center bienvenida-titulo">Registro</h1>
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="form-group input-login">
                <label for="name" class="color">Nombre</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="apellido_paterno" class="color">Apellido Paterno</label>
                <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
                @error('apellido_paterno')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="apellido_materno" class="color">Apellido Materno</label>
                <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
                @error('apellido_materno')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="email" class="color">Correo Electrónico</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="numero_de_control" class="color">Número de Control</label>
                <input id="numero_de_control" type="text" class="form-control" name="numero_de_control" value="{{ old('numero_de_control') }}" required>
                @error('numero_de_control')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="password" class="color">Contraseña</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="password_confirmation" class="color">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                @error('password_confirmation')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group input-login">
                <label for="carrera" class="color">Carrera</label>
                <select id="carrera" class="form-control" name="carrera" required>
                  <option value="" disabled selected>Selecciona tu carrera</option>
                  @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                  @endforeach
                </select>
              
              </div>
    @error('carrera')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              <div class="form-group input-login">
                <label for="semestre" class="color">Semestre</label>
                <select id="semestre" class="form-control" name="semestre" required>
                  <option value="" disabled selected>Selecciona tu semestre</option>
                  @for ($i = 1; $i <= 9; $i++)
                    <option value="{{ $i }}" {{ old('semestre') == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
                @error('semestre')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary boton-login">
                  {{ __('Registro') }}
                </button>
              </div>
            </form>
          </div>
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
  </script>
</body>
</html>
