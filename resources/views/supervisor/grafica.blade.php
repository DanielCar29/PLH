<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Grafica</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
    <style>
        .hola{
            width: 400px;
            height: 400px;
        }
    </style>
</head>
<body>

    {{-- Menú de navegación --}}
    <div class="menu-navegacion">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid nav-color color-borde-plh">
            <a class="navbar-brand item-nav elemento-navegacion-plh" href="#">
              <img src="{{URL::asset('/img/logo_ejemplo.png')}}" alt="Logo" 
                  width="40" height="40" class="d-inline-block align-text-top">
                      PLH
          </a>
             {{-- Botón de desplazamiento --}}
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
                        aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </div>
          {{-- ---------------------------------------------------------------------------------------------------------------------- --}}
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <ul class="navbar-nav">
                  <li class="nav-item">
                        <a class="nav-link active elemento-navegacion-plh" aria-current="page" href="{{ url('/supervisor.home') }}">
                            Home
                        </a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link elemento-navegacion-plh" href="{{ url('/supervisor.visualizar_solicitud') }}">
                            Visualizar Solicitudes
                        </a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link elemento-navegacion-plh" href="{{ url('/supervisor.visualizar_reporte') }}">
                            Visualizar Reporte
                        </a>
                  </li>
                  {{--  --}}
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
                  {{--  --}}
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                          data-bs-toggle="dropdown" aria-expanded="false">
                              Nombre Supervisor
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ url('/supervisor.perfil') }}">Perfil</a></li>
                          
                          <li><a class="dropdown-item" href="#">Salir</a></li>
                      </ul>
                  </li>
              </ul>
          </div>
          </div>
        </nav>
    </div>
{{-- Contenido --}}

<div class="container text-center">


    <div class="row">

        <div class="contenido_grafica col-8">
            
            <div class="grafica">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            
        </div>

        <div class="datos_alumno col-4">

            <div class="nombre_alumno">
                <h5>Jose Alberto Sandoval Vazquez</h1>
            </div>
    
            <div class="carrera_alumno">
                <h5>Ingeniería informática</h1>
            </div>
    
            <div class="numero-control_alumno">
                <h5>212310628</h1>
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // El tipo de gráfico que deseas crear
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'Días de uso',
                        data: [12, 13, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>