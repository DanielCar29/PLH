<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Grafica</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
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

    {{-- Menú --}}
<div class="menu-navegacion">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid nav-color color-borde-plh">
        <a class="navbar-brand item-nav elemento-navegacion-plh" href="{{ url('/supervisor.visualizar_reporte') }}">
          <img src="{{URL::asset('/img/icons/regresar.png')}}" alt="Logo" 
              width="40" height="40" class="d-inline-block align-text-top">
                  Regresar
        </a>
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
                <h5>{{$alumno->Nombre}} {{$alumno->Apellido_Paterno}} {{$alumno->Apellido_Materno}}</h1>
            </div>
    
            <div class="carrera_alumno">
                <h5>{{$alumno->Carrera}}</h1>
            </div>
    
            <div class="numero-control_alumno">
                <h5>{{$alumno->Numero_de_control}}</h1>
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
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
    
            // Datos desde Laravel
            var usos_beca = @json($usos_beca);
    
            // Extraer meses y veces de uso
            var labels = usos_beca.map(item => item.mes);
            var data = usos_beca.map(item => item.veces_uso_beca);
    
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
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
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Asegura que solo se muestren números enteros
                                color: 'rgba(255, 255, 255, 1)' // Color de los números del eje Y
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 1)' // Color de la cuadrícula del eje Y
                            }
                        },
                        x: {
                            ticks: {
                                color: 'rgba(255, 255, 255, 1)' // Color de los números del eje X
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 1)' // Color de la cuadrícula del eje X
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Oculta la leyenda
                        },
                        title: {
                            display: true,
                            text: 'Días de uso del alumno',
                            color: 'rgba(255, 255, 255, 1)',
                            font: {
                                size: 34
                            }
                        }
                    }
                }
            });
        });
    </script>


    
</body>
</html>