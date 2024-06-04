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

            <div class="titulo">
                <h1>Solicitudes de alumnos</h1>
            </div>
    
            <div class="tabla">
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
                                
                                <a href="{{route('supervisor.ver_solicitud', ['id' => $alumno->alumno_id])}}">
                                <img src="{{URL::asset('/img/icons/ver.png')}}" alt="" height="30">
                                </a>

                            </td>
                            <td>{{$alumno->fecha_solicitud}}</td>
                            <td>
                              @if ($alumno->estado == 'aceptada')
                                <img src="{{URL::asset('/img/icons/acept.png')}}" alt="" height="40">

                              @elseif ($alumno->estado == 'rechazada')
                                <img src="{{URL::asset('/img/icons/cancel.png')}}" alt="" height="40">

                              @else
                                <img src="{{URL::asset('/img/icons/pending.png')}}" alt="" height="40">
                              @endif
                                
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
    
                </table>
            </div>
            
            <form id="enviar_solicitudes" method="POST" action="">
              <div class="botonEnviar-lista_contenido">

                <button type="submit" id="botonEnviar-lista" class="botonEnviar-lista">

                  Enviar solicitudes
  
                </button>

              </div>


            </form>

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