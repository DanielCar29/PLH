<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista De Supervisores</title>
    @include('administrador/estilos/estilos') <!-- Incluye tus estilos personalizados -->
</head>
<body>
    {{-- Menú de navegación --}}
    @include('administrador.navbar.menu') <!-- Asegúrate de tener este archivo de menú -->

    <div class="container mt-5">
        <h2>Lista de Supervisores</h2>

        <!-- Botón para agregar supervisor -->
        <a href="{{ route('administrador.registrarSupervisor') }}" class="btn btn-primary mb-3">
            Agregar Supervisor
        </a>

        <!-- Usamos la nueva clase personalizada para la tabla -->
        <table class="tabla-info-supervisor">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Carrera</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supervisores as $supervisor)
                <tr>
                    <td>{{ $supervisor->id }}</td>
                    <td>{{ $supervisor->usuario->name }}</td>
                    <td>{{ $supervisor->usuario->apellido_paterno }}</td>
                    <td>{{ $supervisor->usuario->apellido_materno }}</td>
                    <td>{{ $supervisor->usuario->email }}</td>
                    <td>
                        @foreach ($supervisor->carreras as $carrera)
                            <span>{{ $carrera->carrera }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('administrador.eliminarSupervisor', $supervisor->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- CDN's de Bootstrap Js --}}
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
