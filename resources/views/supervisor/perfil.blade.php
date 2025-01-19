<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
    <style>
           /* Color del error */
    .text-danger {
        color: #8B0000 !important;
        /* font-weight: bold; */
    }
    </style>
</head>
<body>

    {{-- Menú --}}
    @include('/supervisor/navbar/menu-supervisor')

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


      <div class="contenido-general-perfil">

        <div class="container ">

            <div class="row">

                <div class="col-6">

                    <div class="flex-sm-row flex-column foto-datos_usuario">
                        <div class="col-6 foto-perfil">

                            <div>
                                <img src="{{URL::asset('/img/perfil_usuario.png')}}" alt="" >
                            </div>

                            <div>
                                <h5>{{$datos->Nombre}} {{$datos->ApellidoPaterno}} {{$datos->ApellidoMaterno}}</h5>
                            </div>

                        </div>
                    </div>

            <form id="enviarDatosPerfil" method="POST" action="{{route('supervisor.actualiza_perfil')}}">  
                @csrf
                    <div class="boton_perfil">

                        <div class="boton_perfil-guardar">
                            
                                <button type="submit" class="btn btn-dark" id="enviarDatosPerfil-boton">

                                    Guardar cambios

                                </button>

                        </div>

                    </div>

                </div>

                <div class="col-6 datos-correo_usuario">

                    <div class="col-6 datos-perfil">
                        <div>
                            <h3>DATOS DE USUARIO</h3>
                        </div>
                        
                        <div class="contenido-datos-perfil">

                                <div>
                                    <span>Nombre:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{$datos->Nombre}}" placeholder="" name="nombre">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Apellido Paterno:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{$datos->ApellidoPaterno}}" placeholder="" name="apellidoPaterno">
                                    @error('apellidoPaterno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Apellido Materno:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{$datos->ApellidoMaterno}}" placeholder="" name="apellidoMaterno">
                                    @error('apellidoMaterno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                        </div>
                    </div>
                    
                    <div class="datos-correo_usuario-interno">
                        <div>
                            <h3>
                                DATOS INSTITUCIONALES
                            </h3>
                            
                        </div>
                        
                        <div class="contenido-datos-institucionales">

                                <div>
                                    <span>Correo Electronico:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{$datos->Correo}}" placeholder="" name="correo">
                                    @error('correo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Contraseña:</span>
                                </div>

                                <div>
                                    <input type="password" value="" placeholder="" name="pass" minlength="8">
                                    @error('pass')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Carrera:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{$datos->Carrera}}" placeholder="" disabled>
                                </div>

                        </div>

                    
                    </div>
                </div>
            </form>


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

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('enviarDatosPerfil');
        const submitButton = document.getElementById('enviarDatosPerfil-boton');

        submitButton.addEventListener('click', function(event) {
            event.preventDefault(); // Evita el envío del formulario inmediatamente

            const userConfirmed = confirm('¿Estás seguro que quieres hacer esos cambios?');
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
</html>