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
            @foreach($alumno as $alumno)
            <div class="nombre_alumno-formulario">
                <h5>{{$alumno->Nombre}} {{$alumno->Apellido_Materno}} {{$alumno->Apellido_Paterno}}</h1>
            </div>
    
            <div class="carrera_alumno-formulario">
                <h5>{{$alumno->Carrera}}</h1>
            </div>
    
            <div class="numero-control_alumno-formulario">
                <h5>{{$alumno->Numero_de_control}}</h1>
            </div>
            @endforeach  
        </div>

        

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 formulario-contestado">
                    <div class="card">
                        <h2 class="card-header">Formulario de Solicitud de Beca Alimenticia</h2>
                        <div class="card-body">
                    
                    @foreach($preguntas_alumno as $preguntas_alumno)
                                <div class="mb-4">
                                    
                                    <label for="scholarship_type" class="form-label"><strong>{{$preguntas_alumno->pregunta}}</strong></label>

                                        <div>
                                            <p><strong>R.-</strong> {{$preguntas_alumno->respuesta}}</p>
                                        </div>
                                    
                                </div>
                    @endforeach
        
                    <div class="contenido_botones-solicitud">
                        <form method="POST" action="{{route('administrador.aceptarSolicitud',[$alumno->alumno_id])}}">
                            @csrf
                            
                                <div class="botones_solicitud">

                                    <button type="submit">

                                        <img src="{{URL::asset('/img/icons/acept.png')}}" alt="" height="50">

                                    </button>
                                        

                                </div>

                        </form>

                        <form method="POST" action="{{route('administrador.rechazarSolicitud',[$alumno->alumno_id])}}">
                            @csrf
                            <div class="botones_solicitud">

                                <button type="submit">

                                    <img src="{{URL::asset('/img/icons/cancel.png')}}" alt="" height="50">

                                </button>
                                    
                                

                            </div class="botones_solicitud">

                        </form>
                            
                        <form method="POST" action="{{route('administrador.esperaSolicitud',[$alumno->alumno_id])}}">

                            @csrf
                            <div class="botones_solicitud">

                                <button type="submit">

                                    <img src="{{URL::asset('/img/icons/pending.png')}}" alt="" height="50">

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