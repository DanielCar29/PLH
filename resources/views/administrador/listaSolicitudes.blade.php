<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista De Solicitudes</title>
    @include('administrador/estilos/estilos')
</head>
<body>
    {{-- Menú de navegación --}}
    @include('administrador/navbar/menu')

    <div class="contenido-lista">

        <div class="titulo">
            <h2>Lista de solicitudes</h2>
        </div>

        <div class="contenido-listas-cuerpo">

            <div class="accordion" id="accordionExample">
                @foreach($carreras as $carrera)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ empty($solicitudesPorCarrera[$carrera->id]) ? 'collapsed' : '' }} carrera-titulo" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $carrera->id }}" 
                                aria-expanded="{{ empty($solicitudesPorCarrera[$carrera->id]) ? 'false' : 'true' }}" aria-controls="collapse{{ $carrera->id }}" {{ empty($solicitudesPorCarrera[$carrera->id]) ? 'disabled' : '' }}>
                            {{ $carrera->carrera }}
                        </button>
                    </h2>
                    <div id="collapse{{ $carrera->id }}" class="accordion-collapse collapse {{ empty($solicitudesPorCarrera[$carrera->id]) ? '' : 'show' }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if(empty($solicitudesPorCarrera[$carrera->id]))
                            <div class="anuncio_noSolicitudes">
                                <h2>No hay solicitudes disponibles!</h2>
                            </div>
                            @else
                            <form method="POST" action="{{ route('administrador.activarBeca') }}">
                                @csrf
                                <div class="tabla-lista">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Numero de control</th>
                                                <th>Nombre del alumno</th>
                                                <th>Acciones</th>
                                                <th>Estado</th>
                                                <th>Seleccionar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @foreach($solicitudesPorCarrera[$carrera->id] as $alumno)
                                            @if ($alumno->solicitudesBeca->isNotEmpty() && $alumno->solicitudesBeca->first()->listaSolicitud->envio == 0)
                                            <tr>
                                                <td>{{ $alumno->numero_de_control }}</td>
                                                <td>{{ $alumno->user->name }} {{ $alumno->user->apellido_paterno }} {{ $alumno->user->apellido_materno }}</td>
                                                <td>
                                                    <div class="icono_ver">
                                                        <a href="{{ route('administrador.verSolicitudAlumno', ['id' => $alumno->id]) }}">
                                                            <img src="{{ URL::asset('/img/icons/ver.png') }}" alt="" height="30">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($alumno->solicitudesBeca->first()->listaSolicitud->estado == 'aceptada')
                                                    <img src="{{ URL::asset('/img/icons/acept.png') }}" alt="" height="40">
                                                    @elseif ($alumno->solicitudesBeca->first()->listaSolicitud->estado == 'rechazada')
                                                    <img src="{{ URL::asset('/img/icons/cancel.png') }}" alt="" height="40">
                                                    @else
                                                    <img src="{{ URL::asset('/img/icons/pending.png') }}" alt="" height="40">
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="alumnos[]" value="{{ $alumno->id }}">
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="botones_solicitud">
                                    <button type="submit" class="btn btn-primary">Activar Beca</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
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