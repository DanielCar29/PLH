<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <!-- Estilos de Materialize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col s12 m6 offset-m3">
        <div class="card blue lighten-3">
          <div class="card-content white-text">
            <span class="card-title center-align">Registro</span>
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="input-field">
                <input id="name" type="text" class="validate white-text" name="name" value="{{ old('name') }}" required autofocus>
                <label for="name" class="white-text">Nombre</label>
                @error('name')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <input id="apellido_paterno" type="text" class="validate white-text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
                <label for="apellido_paterno" class="white-text">Apellido Paterno</label>
                @error('apellido_paterno')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <input id="apellido_materno" type="text" class="validate white-text" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
                <label for="apellido_materno" class="white-text">Apellido Materno</label>
                @error('apellido_materno')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <input id="email" type="email" class="validate white-text" name="email" value="{{ old('email') }}" required>
                <label for="email" class="white-text">Correo Electrónico</label>
                @error('email')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <input id="numero_de_control" type="text" class="validate white-text" name="numero_de_control" value="{{ old('numero_de_control') }}" required>
                <label for="numero_de_control" class="white-text">Número de Control</label>
                @error('numero_de_control')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <input id="password" type="password" class="validate white-text" name="password" required>
                <label for="password" class="white-text">Password</label>
                @error('password')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <input id="password_confirmation" type="password" class="validate white-text" name="password_confirmation" required>
                <label for="password_confirmation" class="white-text">Confirmar Password</label>
                @error('password_confirmation')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <select id="carrera" name="carrera" required>
                  <option value="" disabled selected>Selecciona tu carrera</option>
                  @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                  @endforeach
                </select>
                <label class="white-text">Carrera</label>
                @error('carrera')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="input-field">
                <select id="semestre" name="semestre" required>
                  <option value="" disabled selected>Selecciona tu semestre</option>
                  @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ old('semestre') == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
                <label class="white-text">Semestre</label>
                @error('semestre')
                  <span class="red-text">{{ $message }}</span>
                @enderror
              </div>

              <div class="center-align">
                <button type="submit" class="btn waves-effect waves-light">
                  {{ __('Registro') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts de Materialize CSS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <!-- Inicialización de los select -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);
    });
  </script>
</body>
</html>
