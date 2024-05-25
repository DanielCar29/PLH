<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLH: solicitar_beca</title>
    <link rel="stylesheet" href="{{ asset('/css/alumno/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
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
                          <li><a class="dropdown-item" href="#">Salir</a></li>
                      </ul>
                  </li>
              </ul>
          </div>
          </div>
        </nav>
      </div>
    
    {{-- Contenido --}}
    <div class="container contenido">
        {{-- Convocatoria de beca --}}
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Convocatoria de Beca</h1>
                        <p class="card-text text-center">La convocatoria de beca ofrece oportunidades de financiamiento para estudiantes sobresalientes. Si cumples con los requisitos, ¡no dudes en solicitar!</p>
                        <div class="d-grid gap-2">
                            <a href="{{ url('/alumno.formulario') }}" class="btn btn-primary">Solicitar</a>
                        </div>
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
