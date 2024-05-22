<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/alumno/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
            <style>
              div.menu-navegacion nav{
                  background-color: #003785 !important;
                  position: relative; /* Añadimos esta propiedad para establecer el contexto de apilamiento */
                  z-index: 1000; /* Ajustamos el z-index para que el menú de navegación se superponga sobre el contenido */
              }
              .nav-color-custom {
                  background-color: #003785; /* Azul oscuro */
              }
              .contenido {
                  margin-top: 70px; /* Ajusta el valor según el tamaño de la barra de navegación */
              }
              .navbar {
    position: relative;
    z-index: 1000;
    /* Establecer un ancho fijo para el menú de navegación en dispositivos más grandes */
    width: 100%; /* o cualquier otro valor fijo deseado */
}

/* Media query para dispositivos con un ancho máximo de 768px (tabletas y teléfonos) */
@media (max-width: 768px) {
    /* Establecer un ancho máximo para el menú de navegación en dispositivos más pequeños */
    .navbar {
        width: 100%; /* o cualquier otro valor fijo deseado */
    }
}
          </style>

</head>
<body>
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
                    <li><a class="dropdown-item" href="{{ url('/preguntas_frecuentes') }}" target="_blank">Preguntas Frecuentes</a></li>
                    <li><a class="dropdown-item" href="mailto:contact.josesandoval@gmail.com">Contacto</a></li>
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
    
    {{-- Perfil --}}
    <div class="contenido-general-perfil">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="row flex-sm-row flex-column foto-datos_usuario">
                        <div class="col-12 foto-perfil">
                            <div>
                                <img src="{{URL::asset('/img/perfil_usuario.png')}}" alt="">
                            </div>
                            <div>
                                <h5>Nombre de Usuario</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 datos-correo_usuario">
                    <div class="col-12 datos-perfil">
                        <div>
                            <h3>DATOS DE USUARIO</h3>
                        </div>
                        <div class="contenido-datos-perfil">
                            <form action="">
                                <div>
                                    <span>Nombre:</span>
                                </div>
                                <div>
                                    <input type="text" value="" placeholder="Jose Alberto">
                                </div>
                                <div>
                                    <span>Apellido Paterno:</span>
                                </div>
                                <div>
                                    <input type="text" value="" placeholder="Sandoval">
                                </div>
                                <div>
                                    <span>Apellido Materno:</span>
                                </div>
                                <div>
                                    <input type="text" placeholder="Vazquez">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="datos-correo_usuario-interno">
                        <div>
                            <h3>DATOS INSTITUCIONALES</h3>
                        </div>
                        <div class="contenido-datos-institucionales">
                            <form action="">
                                <div>
                                    <span>Correo Electronico:</span>
                                </div>
                                <div>
                                    <input type="text" value="" placeholder="212310628@gmail.com">
                                </div>
                                <div>
                                    <span>Contraseña:</span>
                                </div>
                                <div>
                                    <input type="password" value="" placeholder="************">
                                </div>
                                <div>
                                    <span>Semestre:</span>
                                </div>
                                <div>
                                    <input type="text" placeholder="Semestre">
                                </div>
                                <div>
                                    <span>Carrera:</span>
                                </div>
                                <div>
                                    <input type="text" placeholder="Informática">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <
        
        
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
