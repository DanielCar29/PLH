<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Supervisor</title>
    @include('administrador/estilos/estilos')
</head>
<body>
    @include('administrador/navbar/menu')

    <div class="contenido">

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
            <h2>
                Registrar 
            </h2>
        </div>

        <div class="registro">

            <form method="POST" action="{{route('registrarSupervisor')}}">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nombres</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" 
                           aria-describedby="inputGroup-sizing-default" name="nombre" value="{{ old('nombre') }}">
                </div>
                
                <div class="input-group">
                    <span class="input-group-text">Apellido Paterno y Materno</span>
                    <input type="text" aria-label="First name" class="form-control" name="apellido_paterno" value="{{ old('apellido_paterno') }}">
                    <input type="text" aria-label="Last name" class="form-control" name="apellido_materno" value="{{ old('apellido_materno') }}">
                </div>
                            

                <div class="input-group mb-3 correo">
                    <input type="text" class="form-control" placeholder="Correo Electrónico" aria-label="Username" name="correoPart1" value="{{ old('correoPart1') }}">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" placeholder="gmail.com" aria-label="Server" name="correoPart2" value="{{ old('correoPart2') }}">
                </div>                
                
                @error('correoPart1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                @error('correoPart2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                

                <div>
                    <select class="form-select" aria-label="Default select example" name="carrera">
                        @foreach($carreras as $carrera)
                            <option value="{{ $carrera->id }}" {{ old('carrera') == $carrera->id ? 'selected' : '' }}>
                                {{ $carrera->carrera }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                
                
                <div class="contrasena">
                    <input type="password" id="inputPassword1" class="form-control" 
                           aria-describedby="passwordHelpBlock" placeholder="Contraseña" 
                           name="passPart1" minlength="8" required value="{{ old('passPart1') }}">
                </div>
                
                
                @error('passPart1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <div>
                    <input type="password" id="inputPassword5" class="form-control" 
                           aria-describedby="passwordHelpBlock" placeholder="Verificar Contraseña" 
                           name="passPart2" minlength="8" required value="{{ old('passPart2') }}">
                </div>
                
                @error('passPart2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                

                <div class="boton-registro">

                    <button type="submit" class="btn btn-dark">Registrar</button>

                </div>

            </form>

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