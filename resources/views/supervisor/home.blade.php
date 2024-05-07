<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">

</head>
<body>
    {{-- Menú de navegación --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 0">
        <div class="container-fluid nav-color color-borde-plh">
          <a class="navbar-brand item-nav elemento-navegacion-plh" href="#">
            <img src="{{URL::asset('/img/logo_ejemplo.png')}}" alt="Logo" 
                width="40" height="40" class="d-inline-block align-text-top">
                    PLH
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active elemento-navegacion-plh" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link elemento-navegacion-plh" href="#">Visualizar Solicitudes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link elemento-navegacion-plh" href="#">Visualizar Reporte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link elemento-navegacion-plh" href="#">Ayuda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                            Nombre Supervisor
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><a class="dropdown-item" href="#">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
    </nav>

    {{-- Contenido --}}
    <div class="row contenido-plh">
        {{-- Imagen | Video --}}
        <div class="col-7 contenido-plh-video">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{URL::asset('/img/video_ejemplo.png')}}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{URL::asset('/img/video_ejemplo.png')}}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{URL::asset('/img/video_ejemplo.png')}}" class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
        {{-- Novedades --}}
        <div class="col-4 contenido-plh-actualizacion">
            <h1>Novedades</h1>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Novedad #1
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                      <strong>This is the first item's accordion body.</strong> 
                        It is shown by default, until the collapse plugin adds 
                        the appropriate classes that we use to style each element. These 
                        classes control the overall appearance, as well as the showing and hiding 
                        via CSS transitions. You can modify any of this with custom CSS or overriding 
                        our default variables. It's also worth noting that just about any HTML can go within the 
                        <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                Novedad #2
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <strong>This is the second item's accordion body.</strong> 
                      It is hidden by default, until the collapse plugin adds the 
                      appropriate classes that we use to style each element. These 
                      classes control the overall appearance, as well as the showing 
                      and hiding via CSS transitions. You can modify any of this with 
                      custom CSS or overriding our default variables. It's also worth 
                      noting that just about any HTML can go within the <code>.accordion-body</code>, 
                      though the transition does limit overflow.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                Novedad #3
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <strong>This is the third item's accordion body.</strong>
                       It is hidden by default, until the collapse plugin adds 
                       the appropriate classes that we use to style each element. 
                       These classes control the overall appearance, as well as the 
                       showing and hiding via CSS transitions. You can modify any of 
                       this with custom CSS or overriding our default variables. It's 
                       also worth noting that just about any HTML can go within the 
                       <code>.accordion-body</code>, though the transition does limit overflow.
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
<footer>
    <div class="container pie-plh">
      <div class="row">
        <div class="col-lg-4 elemento-pie-plh">
          <h3>Enlaces</h3>
          <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li>
          </ul>
        </div>
        <div class="col-lg-4 elemento-pie-plh">
          <h3>Contacto</h3>
          <p>Correo electrónico: info@example.com</p>
          <p>Teléfono: 123-456-7890</p>
        </div>
        <div class="col-lg-4 elemento-pie-plh">
          <h3>Derechos de autor</h3>
          <p>(c) 2023 Mi Sitio Web. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  </footer>
</html>