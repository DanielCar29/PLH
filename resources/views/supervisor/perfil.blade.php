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

        @if (session('password_error'))
            <div class="alert alert-danger">
                {{ session('password_error') }}
            </div>
        @endif
    </div>  

    <div class="contenido-general-perfil">

        <div class="container ">

            <div class="row">

                <div class="col-12 col-md-6">

                    <div class="flex-sm-row flex-column foto-datos_usuario">
                        <div class="col-12 foto-perfil">

                            <div>
                                <img src="{{URL::asset('/img/perfil_usuario.png')}}" alt="" >
                            </div>

                            <div>
                                <h5>{{ $supervisor->name }} {{ $supervisor->apellido_paterno }} {{ $supervisor->apellido_materno }}</h5>
                            </div>

                        </div>
                    </div>

            <form id="enviarDatosPerfil" method="POST" action="{{route('supervisor.actualiza_perfil')}}">  
                @csrf
                    <div class="boton_perfil">

                        <div class="boton_perfil-guardar">
                            
                                <button type="button" class="btn btn-dark" id="enviarDatosPerfil-boton">

                                    Guardar cambios

                                </button>

                        </div>

                    </div>

                </div>

                <div class="col-12 col-md-6 datos-correo_usuario">

                    <div class="col-12 datos-perfil">
                        <div>
                            <h3>DATOS DE USUARIO</h3>
                        </div>
                        
                        <div class="contenido-datos-perfil">

                                <div>
                                    <span>Nombre:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{ $supervisor->name }}" placeholder="" name="nombre">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Apellido Paterno:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{ $supervisor->apellido_paterno }}" placeholder="" name="apellidoPaterno">
                                    @error('apellidoPaterno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Apellido Materno:</span>
                                </div>

                                <div>
                                    <input type="text" value="{{ $supervisor->apellido_materno }}" placeholder="" name="apellidoMaterno">
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
                                    <input type="text" value="{{ $supervisor->email }}" placeholder="" name="correo">
                                    @error('correo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Nueva Contraseña:</span>
                                </div>

                                <div>
                                    <input type="password" value="" placeholder="" name="pass_nueva" minlength="8">
                                    @error('pass_nueva')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Confirmar Nueva Contraseña:</span>
                                </div>

                                <div>
                                    <input type="password" value="" placeholder="" name="pass_nueva_confirmation" minlength="8">
                                    @error('pass_nueva_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <span>Carrera:</span>
                                </div>

                                <div>
                                    @foreach ($supervisor->supervisor->carreras as $carrera)
                                        <input type="text" value="{{ $carrera->carrera }}" placeholder="" disabled>
                                    @endforeach
                                </div>

                        </div>

                    
                    </div>
                </div>
            </form>


            </div>

        </div>

      </div>

    <!-- Modal para solicitar la contraseña actual -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Confirmar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label for="pass_actual" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="pass_actual" name="pass_actual" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmPasswordButton">Confirmar</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('enviarDatosPerfil');
        const submitButton = document.getElementById('enviarDatosPerfil-boton');
        const passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
        const confirmPasswordButton = document.getElementById('confirmPasswordButton');
        const passwordForm = document.getElementById('passwordForm');
        const passActualInput = document.getElementById('pass_actual');

        submitButton.addEventListener('click', function(event) {
            event.preventDefault(); // Evita el envío del formulario inmediatamente
            passwordModal.show();
        });

        confirmPasswordButton.addEventListener('click', function() {
            if (passActualInput.value) {
                const passActualField = document.createElement('input');
                passActualField.type = 'hidden';
                passActualField.name = 'pass_actual';
                passActualField.value = passActualInput.value;
                form.appendChild(passActualField);
                form.submit(); // Envía el formulario si el usuario confirma
            } else {
                alert('Por favor, ingrese su contraseña actual.');
                passwordModal.show(); // Asegúrate de que el modal no desaparezca
            }
        });
    });
</script>
</body>
</html>