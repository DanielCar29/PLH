<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
    @include('administrador/estilos/estilos')
</head>
<body>
    @include('administrador/navbar/menu')

    <div class="container mt-1">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                        @foreach($admin as $data)
                            <div>
                                <h5>{{$data->name}} {{$data->apellido_paterno}} {{$data->apellido_materno}}</h5>
                            </div>

                        </div>
                    </div>
                <form method="POST" action="{{route('actualizarPerfil')}}">
                    @csrf
                    <div class="boton_perfil">
                        
                        <div class="boton_perfil-guardar">
                            <button type="submit" class="btn btn-dark">Guardar cambios</button>
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
                                    <input type="text" value="{{$data->name}}" placeholder="" name="nombre">
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
                                    <input type="text" placeholder="" value="{{$data->apellido_materno}}" name="apellido_materno">
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
                                    <input type="text" value="{{$data->email}}" placeholder="" name="correo">
                                </div>

                                <div>
                                    <span>Contraseña:</span>
                                </div>

                                <div>
                                    <input type="password" value="" placeholder="" name="pass">
                                </div>

                            @endforeach        

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
    
</body>
</html>