<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver solicitud</title>
    @include('administrador/estilos/estilos')
</head>
<body>
    {{-- Menú de navegación --}}
    @include('administrador/navbar/menu')

    <div class="contenido_formulario">

        <div class="datos_alumno-formulario">
            <div class="nombre_alumno-formulario">
                <h5>{{ $alumno->user->name }} {{ $alumno->user->apellido_paterno }} {{ $alumno->user->apellido_materno }}</h5>
            </div>
    
            <div class="carrera_alumno-formulario">
                <h5>{{ $alumno->carreras->first()->carrera }}</h5>
            </div>
    
            <div class="numero-control_alumno-formulario">
                <h5>{{ $alumno->numero_de_control }}</h5>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 formulario-contestado">
                    <div class="card">
                        <h2 class="card-header">Formulario de Solicitud de Beca Alimenticia</h2>
                        <div class="card-body">
                    
                    @foreach($preguntas_alumno as $pregunta)
                                <div class="mb-4">
                                    
                                    <label for="scholarship_type" class="form-label"><strong>{{ $pregunta->pregunta }}</strong></label>

                                        <div>
                                            <p><strong>R.-</strong> {{ $pregunta->respuesta }}</p>
                                        </div>
                                    
                                </div>
                    @endforeach
        
                    <div class="contenido_botones-solicitud">
                        <form method="POST" action="{{ route('administrador.aceptarSolicitud', ['id' => $alumno->id]) }}">
                            @csrf
                            <div class="botones_solicitud">
                                <button type="submit">
                                    <img src="{{ URL::asset('/img/icons/acept.png') }}" alt="" height="50">
                                </button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('administrador.rechazarSolicitud', ['id' => $alumno->id]) }}">
                            @csrf
                            <div class="botones_solicitud">
                                <button type="submit">
                                    <img src="{{ URL::asset('/img/icons/cancel.png') }}" alt="" height="50">
                                </button>
                            </div>
                        </form>
                    </div>

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