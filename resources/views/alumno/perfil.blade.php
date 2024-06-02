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
                                <h5>{{ $user->name }}</h5> <!-- Mostrar nombre del usuario -->
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
                                    <input type="text" value="{{ $user->name }}" placeholder="Jose Alberto">
                                </div>
                                <div>
                                    <span>Apellido Paterno:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{ $user->apellido_paterno }}" placeholder="Sandoval">
                                </div>
                                <div>
                                    <span>Apellido Materno:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{ $user->apellido_materno }}" placeholder="Vazquez">
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
                                    <input type="text" value="{{ $user->email }}" placeholder="212310628@gmail.com">
                                </div>
                                <div>
                                    <span>Número de Control:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{ $alumno->numero_de_control }}" placeholder="Número de Control">
                                </div>
                                <div>
                                    <span>Semestre:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{ $alumno->semestre }}" placeholder="Semestre">
                                </div>
                                <div>
                                    <span>Carrera:</span>
                                </div>
                                <div>
                                    <input type="text" value="{{ $user->carrera }}" placeholder="Informática">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="boton_perfil">
                        <div class="boton_perfil-guardar">
                            <a href="">Guardar cambios</a>
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
