<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Visualizar Reporte</title>
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
    
    {{-- Contenido --}}
    <div class="contenido_general-visualizar_reporte">
        <div class="contenido-visualizar_reporte">
            <div class="titulo-visualizar_reporte">
                <h1>Reporte del alumnado</h1>
            </div>


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

            <div class="tabla-visualizar_reporte table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Numero de control</th>
                        <th>Nombre del alumno</th>
                        <th>Acciones</th>
                        <th>Última vez</th>
                        <th>Estado de beca</th>
                    </tr>
                    <tbody class="table-group-divider">
                        
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{$alumno->numero_de_control}}</td>
                            <td>{{$alumno->name}} {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}}</td>
                            <td>

                                <div class="icono_pdf">
                                    <form id="notification-form-{{ $alumno->id }}" method="POST" action="{{route('supervisor.correoNoUso',
                                                                [$alumno->name,
                                                                $alumno->apellido_paterno,
                                                                $alumno->apellido_materno,
                                                                $alumno->email])}}">
                                        @csrf
                                        <button title="Haz clic para enviar una notificación" 
                                                id="submit-btn-{{ $alumno->id }}" 
                                                type="button" 
                                                class="btn btn-link" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmacionModal"
                                                data-alumno-id="{{ $alumno->id }}"
                                                data-alumno-nombre="{{ $alumno->name }}"
                                                data-alumno-apellido-paterno="{{ $alumno->apellido_paterno }}"
                                                data-alumno-apellido-materno="{{ $alumno->apellido_materno }}"
                                                style="border: none; background: none; padding: 0;">
                                            <img src="{{URL::asset('/img/icons/notificacion.png')}}" alt="" height="30">
                                        </button>
                                    </form>
                                </div>

                                <div class="icono_monitoreo">
                                    <a title="Haz clic para visualizar el grafico" href="{{route('supervisor.ver_grafica', ['id' => $alumno->id])}}">
                                        <img src="{{URL::asset('/img/icons/monitoreo.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_pdf">
                                    <a title="Haz clic para generar PDF" href="{{route('supervisor.generarPDF', ['id' => $alumno->id])}}" about="_blank" target="_blank">
                                        <img src="{{URL::asset('/img/icons/archivo-pdf.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                @if($alumno->estado_beca == 'activo')
                                    <div class="icono_pdf">
                                        <a title="Haz clic para realizar un bloqueo de beca" href="" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#bloqueoModal"
                                            data-alumno-id="{{ $alumno->id }}"
                                            data-alumno-nombre="{{ $alumno->name }}"
                                            data-alumno-apellido-paterno="{{ $alumno->apellido_paterno }}"
                                            data-alumno-apellido-materno="{{ $alumno->apellido_materno }}"
                                            data-alumno-correo="{{ $alumno->email }}">
                                            <img src="{{ URL::asset('/img/icons/block.png') }}" alt="" height="30">
                                        </a>
                                    </div>
                                @else
                                    <div class="icono_pdf">
                                        <a title="Acción no disponible" class="disabled-link">
                                            <img src="{{ URL::asset('/img/icons/block.png') }}" alt="" height="30" style="opacity: 0.5;">
                                        </a>
                                    </div>
                                @endif

                                @if($alumno->estado_beca == 'inactivo')
                                    <div class="icono_pdf">
                                        <a title="Haz clic para devolver acceso a la beca" 
                                        href="" 
                                        class="desbloquear-beca" 
                                        data-id="{{ $alumno->id }}"
                                        data-nombre="{{ $alumno->name }}"
                                        data-apellido-paterno="{{ $alumno->apellido_paterno }}"
                                        data-apellido-materno="{{ $alumno->apellido_materno }}"
                                        data-correo="{{ $alumno->email }}">
                                            <img src="{{ URL::asset('/img/icons/devolver-acceso.png') }}" alt="" height="30">
                                        </a>
                                    </div>
                                @else
                                    <div class="icono_pdf">
                                        <a title="Acción no disponible" class="disabled-link">
                                            <img src="{{ URL::asset('/img/icons/devolver-acceso.png') }}" alt="" height="30" style="opacity: 0.5;">
                                        </a>
                                    </div>
                                @endif

                            </td>
                            <td>
                                @if(empty($alumno->ultima_vez_uso_beca))
                                    <strong>No hay registro</strong>
                                @else
                                {{$alumno->ultima_vez_uso_beca}}
                                @endif
                            </td>
                            <td>
                                @if($alumno->estado_beca == 'activo')
                                    <span class="badge bg-success d-flex justify-content-center">Activo</span>
                                @else
                                    <span class="badge bg-danger d-flex justify-content-center">Inactivo</span>
                                @endif
                            </td>
                        </tr>
                            {{-- Model para envio de notificacion --}}
                                <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmacionModalLabel">Confirmar Envío</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de que quieres enviar la notificación a {{ $alumno->name }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" id="confirmarEnvio" class="btn btn-primary">Confirmar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @endforeach
                    </tbody>
                    
                </table>
            </div>

            <div class="btn-generar_pdf_general d-flex justify-content-end align-items-center p-3">
                <div class="icon-pdf_general">
                    <a class="btn btn-light border shadow-sm" title="Haz clic para generar PDF general" href="{{route('supervisor.generarPDFGeneral')}}" target="_blank">
                        <img src="{{URL::asset('/img/icons/archivo-pdf.png')}}" alt="Generar PDF" class="img-fluid" style="max-height: 50px;">
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    
    {{-- Modal para bloqueo de beca --}}
    <div class="modal fade" id="bloqueoModal" tabindex="-1" aria-labelledby="bloqueoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloqueoModalLabel">Confirmar Bloqueo de Beca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bloqueoForm">
                        <input type="hidden" id="alumnoId" name="alumno_id">
                        <input type="hidden" id="correo" name="correo">
                        <input type="hidden" id="nombre" name="nombre">
                        <input type="hidden" id="apellidoPaternoInput" name="apellido_paterno">
                        <input type="hidden" id="apellidoMaternoInput" name="apellido_materno">
                        
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo del bloqueo:</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="confirmarBloqueo">Confirmar Bloqueo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para desbloqueo de beca --}}
    <div class="modal fade" id="confirmDesbloqueoModal" tabindex="-1" aria-labelledby="confirmDesbloqueoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDesbloqueoModalLabel">Confirmar Desbloqueo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas devolver el acceso a la beca a este alumno?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmDesbloqueo">Confirmar</button>
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
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
    const confirmButton = document.getElementById('confirmarEnvio');

    // Escuchar cuando un botón de notificación es clickeado
    const notificationButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#confirmacionModal"]');
    
    notificationButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            // Obtener los datos del alumno desde el botón
            const alumnoId = button.getAttribute('data-alumno-id');
            const alumnoNombre = button.getAttribute('data-alumno-nombre');
            const alumnoApellidoPaterno = button.getAttribute('data-alumno-apellido-paterno');
            const alumnoApellidoMaterno = button.getAttribute('data-alumno-apellido-materno');

            // Actualizar el texto del modal con los datos del alumno
            const modalBody = document.querySelector('#confirmacionModal .modal-body');
            modalBody.innerHTML = `¿Estás seguro(a) de que quieres enviar la notificación a ${alumnoNombre} ${alumnoApellidoPaterno} ${alumnoApellidoMaterno}?`;

            // Agregar un evento para confirmar el envío de la notificación
            confirmButton.onclick = function() {
                // Aquí se puede hacer el envío del formulario de notificación
                const form = document.getElementById(`notification-form-${alumnoId}`);
                form.submit();  // Enviar el formulario correspondiente
            };

            // Mostrar el modal
            confirmModal.show();
            });
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confirmarBloqueoButton = document.getElementById('confirmarBloqueo');
            let alumnoId, correo, nombre, apellidoPaterno, apellidoMaterno;

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(element) {
                element.addEventListener('click', function() {
                    // Obtener valores desde los atributos data
                    alumnoId = this.getAttribute('data-alumno-id');
                    correo = this.getAttribute('data-alumno-correo');
                    nombre = this.getAttribute('data-alumno-nombre');
                    apellidoPaterno = this.getAttribute('data-alumno-apellido-paterno');
                    apellidoMaterno = this.getAttribute('data-alumno-apellido-materno');

                    // Asignar valores a los inputs ocultos
                    document.getElementById('alumnoId').value = alumnoId;
                    document.getElementById('correo').value = correo;
                    document.getElementById('nombre').value = nombre;
                    document.getElementById('apellidoPaternoInput').value = apellidoPaterno;
                    document.getElementById('apellidoMaternoInput').value = apellidoMaterno;
                });
            });

            confirmarBloqueoButton.addEventListener('click', function() {
                const motivo = document.getElementById('motivo').value;

                if (!motivo) {
                    alert('Por favor, ingrese un motivo para el bloqueo.');
                    return;
                }

                // Generar la URL con los parámetros en la ruta definida en Laravel (GET)
                const url = `/supervisor.bloquearBeca/${alumnoId}?motivo=${encodeURIComponent(motivo)}&correo=${encodeURIComponent(correo)}&nombre=${encodeURIComponent(nombre)}&apellido_paterno=${encodeURIComponent(apellidoPaterno)}&apellido_materno=${encodeURIComponent(apellidoMaterno)}`;

                window.location.href = url; // Redirigir a la URL con los datos
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let alumnoData = {};

            document.querySelectorAll('.desbloquear-beca').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    
                    alumnoData = {
                        id: this.getAttribute('data-id'),
                        nombre: this.getAttribute('data-nombre'),
                        apellidoPaterno: this.getAttribute('data-apellido-paterno'),
                        apellidoMaterno: this.getAttribute('data-apellido-materno'),
                        correo: this.getAttribute('data-correo')
                    };

                    let modal = new bootstrap.Modal(document.getElementById('confirmDesbloqueoModal'));
                    modal.show();
                });
            });

            document.getElementById('confirmDesbloqueo').addEventListener('click', function() {
                if (alumnoData.id) {
                    let url = `/supervisor.desbloquearBeca/${alumnoData.id}?nombre=${encodeURIComponent(alumnoData.nombre)}&apellidoPaterno=${encodeURIComponent(alumnoData.apellidoPaterno)}&apellidoMaterno=${encodeURIComponent(alumnoData.apellidoMaterno)}&correo=${encodeURIComponent(alumnoData.correo)}`;
                    
                    window.location.href = url;
                }
            });
        });
    </script>


</body>
</html>