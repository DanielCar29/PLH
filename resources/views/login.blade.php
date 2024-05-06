<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <!-- Estilos de Materialize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col s12 m6 offset-m3">
        <div class="card blue lighten-3">
          <div class="card-content white-text">
            <span class="card-title center-align">Iniciar Sesión</span>
            <div class="input-field">
              <input id="usuario" type="text" class="validate white-text">
              <label for="usuario" class="white-text">Usuario</label>
            </div>
            <div class="input-field">
              <input id="contraseña" type="password" class="validate white-text">
              <label for="contraseña" class="white-text">Contraseña</label>
            </div>
            <div class="center-align">
              <button class="btn waves-effect waves-light blue darken-2" type="submit" name="action">Iniciar Sesión</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts de Materialize CSS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
