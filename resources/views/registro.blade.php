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
            <div class="input-field">
              <input id="nombre" type="text" class="validate white-text">
              <label for="nombre" class="white-text">Nombre</label>
            </div>
            <div class="input-field">
              <input id="apellido_paterno" type="text" class="validate white-text">
              <label for="apellido_paterno" class="white-text">Apellido Paterno</label>
            </div>
            <div class="input-field">
              <input id="apellido_materno" type="text" class="validate white-text">
              <label for="apellido_materno" class="white-text">Apellido Materno</label>
            </div>
            <div class="input-field">
              <input id="correo" type="email" class="validate white-text">
              <label for="correo" class="white-text">Correo Electrónico</label>
            </div>
            <div class="input-field">
              <input id="num_control" type="text" class="validate white-text">
              <label for="num_control" class="white-text">Número de Control</label>
            </div>
            <div class="input-field">
              <select id="carrera">
                <option value="" disabled selected>Selecciona tu carrera</option>
                <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                <option value="Ingeniería Civil">Ingeniería Civil</option>
                <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                <option value="Licenciatura en Administración">Licenciatura en Administración</option>
              </select>
              <label class="white-text">Carrera</label>
            </div>
            <div class="input-field">
              <select id="semestre">
                <option value="" disabled selected>Selecciona tu semestre</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
              </select>
              <label class="white-text">Semestre</label>
            </div>
            <div class="center-align">
              <button class="btn waves-effect waves-light blue darken-2" type="submit" name="action">Registrar</button>
            </div>
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
