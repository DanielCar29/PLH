<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLH:info:beca</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
            <style>
             div.menu-navegacion nav {
            background-color: #003785 !important;
            position: sticky; /* Cambiado a sticky */
            top: 0; /* Se fija en la parte superior */
            z-index: 1000; /* Ajustamos el z-index para que el menú de navegación se superponga sobre el contenido */
        }
        .nav-color-custom {
            background-color: #003785; /* Azul oscuro */
        }
        .contenido {
            margin-top: 80px; /* Ajusta el valor según el tamaño de la barra de navegación */

            
        }
         
              @media (max-width: 991.98px) {
                  .navbar-expand-lg .navbar-nav .nav-link {
                      padding-right: 0.5rem;
                      padding-left: 0.5rem;
                  }
                  .navbar {
        width: 100%; /* o cualquier otro valor fijo deseado */
    }
              }
          </style>

</head>
<body>
    {{-- Menú de navegación --}}
      {{-- Menú de navegación --}}
      <div class="menu-navegacion">
        <nav class="navbar navbar-expand-lg bg-primary" style="padding: 0">
          <div class="container-fluid nav-color-custom">
            <a class="navbar-brand item-nav elemento-navegacion-plh" href="#">
              <img src="{{URL::asset('/img/logo_ejemplo.png')}}" alt="Logo" 
                  width="40" height="40" class="d-inline-block align-text-top">
                      PLH
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link active elemento-navegacion-plh" aria-current="page" href="{{ url('/alumno.home') }}">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link elemento-navegacion-plh" href="{{ url('/alumno.solicitar_beca') }}">Solicitar becas</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link elemento-navegacion-plh" href="{{ url('/alumno.beca') }}">Ver beca</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        Ayuda
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{URL::asset('/pdfs/README.pdf')}}">Guías Y Manuales</a></li>
                      <li><a class="dropdown-item" href="#">Preguntas Frecuentes</a></li>
                      <li><a class="dropdown-item" href="#">Contacto</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                          data-bs-toggle="dropdown" aria-expanded="false">
                              Nombre Alumno
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item"href="">Perfil</a></li>
                          <li><a class="dropdown-item" href="#">Configuración</a></li>
                          <li><a class="dropdown-item" href="#">Salir</a></li>
                      </ul>
                  </li>
              </ul>
          </div>
          </div>
        </nav>
      </div>
    
   {{-- Ver la beca --}}
   <div class="container contenido">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <h2 class="card-header">Detalles de la Beca</h2>
                <div class="card-body">
                    <p><strong>Fecha de Activación:</strong> <span id="activation-date">15 de mayo de 2024</span></p>
                    <p><strong>Estado de la Beca:</strong> <span id="status">Activa</span></p>
                    <p><strong>Descripción:</strong> <span id="description">Esta beca proporciona apoyo alimenticio mensual para estudiantes en situación de vulnerabilidad económica.</span></p>
                    <button class="btn btn-primary" id="recover-qr-btn">Recuperar Código QR</button>
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
</body>
</html>
