<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLH: Perfil</title>
    <link rel="shortcut icon" href="{{ URL::asset('/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/alumno/style.css') }}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
    {{-- Menú de navegación --}}
    @include('/alumno/nav/menu_alumno')
    
    {{-- Perfil --}}
    <div class="contenido-general-perfil">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="row flex-sm-row flex-column foto-datos_usuario">
                        <div class="col-12 foto-perfil">
                            <div>
                                <img src="{{ URL::asset('/img/perfil_usuario.png') }}" alt="">
                            </div>
                            <div>
            @foreach($alumno as $data)
                                <h5>{{$data->nombre}} {{$data->apellido_paterno}} {{$data->apellido_materno}}</h5> <!-- Mostrar nombre del usuario -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 datos-correo_usuario">
                    <form method="POST" action="{{route('alumno.actualizaPerfil',['id'=> $data->alumno_id])}}">
                        
                        @csrf
                    <div class="col-12 datos-perfil">
                        <div>
                            <h3>DATOS DE USUARIO</h3>
                        </div>
                        <div class="contenido-datos-perfil">


                                <div>
                                    <span>Nombre:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->nombre}}" placeholder="" name="nombre">
                                </div>
                                <div>
                                    <span>Apellido Paterno:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->apellido_paterno}}" placeholder="" name="apellido_paterno">
                                </div>
                                <div>
                                    <span>Apellido Materno:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->apellido_materno}}" placeholder="" name="apellido_materno">
                                </div>

                        </div>
                    </div>
                    
                    <div class="datos-correo_usuario-interno">
                        <div>
                            <h3>DATOS INSTITUCIONALES</h3>
                        </div>
                        <div class="contenido-datos-institucionales">

                                <div>
                                    <span>Correo Electronico:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->email}}" placeholder="" name="correo">
                                </div>
                                <div>
                                    <span>Número de Control:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->numero_de_control}}" placeholder="" name="numero_control">
                                </div>
                                <div>
                                    <span>Semestre:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->semestre}}" placeholder="" name="semestre">
                                </div>
                                <div>
                                    <span>Carrera:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{$data->carrera}}" placeholder="" name="carrera" disabled>
                                </div>

                                <span>Contraseña:</span>
                            </div>
                            <div>
                                <input type="password" value="" placeholder="" name="pass">
                            </div>
            @endforeach
                        </div>
                    </div>
                    <div class="boton_perfil">

                        <button type="submit" class="btn btn-dark">Guardar cambios</button>

                    </div>
                </form>
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
