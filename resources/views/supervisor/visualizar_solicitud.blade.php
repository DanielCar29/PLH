<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar Solicitud</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
    {{-- Menú --}}
    @include('/supervisor/navbar/menu-supervisor')
    
    {{-- Contenido --}}
    <div class="contenido-plh_general">
        <div class="contenido-plh">

          <div class="container mt-1">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>  
        
            <div class="titulo">
                <h1>Solicitudes de alumnos</h1>
            </div>

            @if(empty($alumnos))
                <div class="anuncio_noSolicitudes">
                    <h2>No hay solicitudes disponibles!</h2>
                </div>
            @else
            <div class="tabla">

              <div class="d-flex justify-content-end">
                <h5 style="background-color: #fff; border-radius: 5px;">{{$carrera}}</h5>
              </div>

              <div class="d-flex justify-content-end">
                <h5 style="background-color: #fff; border-radius: 5px;">Total de solicitudes:
                  @if(empty($totalSolicitudes))
                    <span>0</span>
                  @else
                    <span>{{$totalSolicitudes}}</span>
                  @endif
                    <span>/ {{$limiteSolicitudes}}</span>
                </h5>
              </div>

                <table class="table table-hover table-striped" id="tabla">
                    
                        <tr>
                            <th>Numero de control</th>
                            <th>Alumno</th>
                            <th>Visualizar Solicitud</th>
                            <th>Día de envío</th>
                            <th>Aceptado/Rechazado</th>

                        </tr>

                    <tbody class="table-group-divider">
                        <tr>

                            @foreach($alumnos as $alumno)
                            <td>{{$alumno->numero_de_control}}</td>
                            <td>{{$alumno->name}} {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}}</td>
                            <td>
                                
                                <a title="Haz clic para ver solicitud" href="{{route('supervisor.ver_solicitud', ['id' => $alumno->alumno_id])}}">
                                <img src="{{URL::asset('/img/icons/ver.png')}}" alt="" height="30">
                                </a>

                            </td>
                            <td>
                              {{$alumno->fecha_solicitud}}
                            </td>
                            <td>
                              @if ($alumno->estado == 'aceptada')
                                <img title="El estado es aceptado" src="{{URL::asset('/img/icons/SR.png')}}" alt="" height="40">                                

                                @elseif ($alumno-> estado == 'rechazada')
                                <img title="El estado es rechazado" src="{{URL::asset('/img/icons/NR.png')}}" alt="" height="40">
                                @else
                                <img src="{{ URL::asset('/img/icons/pending.png') }}" alt="" height="40">
                                @endif
                                
                            </td>
                        </tr>
                            @endforeach
              @endif
                    </tbody>
    
                </table>
            </div>

            @if($alumnos->isEmpty())
                
                <div class="anuncio_noSolicitudes" style="text-align: center; margin-top: 20px;">
                  <h2 style="">¡No hay solicitudes pendientes!</h2>
                </div>

                <div class="botonEnviar-lista_contenido">
                  <button type="submit" id="botonEnviar-lista" class="btn btn-dark" disabled>
                    Enviar solicitudes
                  </button>
                </div>

            @else
              <form id="enviar_solicitudes" method="POST" action="{{route('supervisor.enviarListaSolicitudes')}}">
              @csrf
                <div class="botonEnviar-lista_contenido">
                  <button type="submit" id="botonEnviar-lista" class="btn btn-dark">
                  Enviar solicitudes
                  </button>
                </div>
              </form>
            @endif
              
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

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('enviar_solicitudes');
            const submitButton = document.getElementById('botonEnviar-lista');

            submitButton.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el envío del formulario inmediatamente

                const userConfirmed = confirm('¿Estás seguro que quieres mandar la lista de solicitudes?');
                if (userConfirmed) {
                    alert('Has aceptado.');
                    form.submit(); // Envía el formulario si el usuario confirma
                } else {
                    alert('Has cancelado.');
                }
            });
        });

    </script>
</body>
{{-- Contenido del Footer --}}
{{-- <footer>
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
  </footer> --}}

</html>