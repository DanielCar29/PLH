<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Habilitar Convocatoria</title>
    @include('administrador/estilos/estilos')
</head>
<body>
    {{-- Menú de navegación --}}
    @include('administrador/navbar/menu')
    
    <div class="container mt-1">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>    
    <div class="contenido-convocatoria">

        <div class="titulo-convocatoria">
            <h2>
                Habilitar Convocatoria
            </h2>
        </div>

        <div class="habilitar-convocatoria">

            <div class="card">
                <h5 class="card-header">Numero de becas por carrera</h5>
                <div class="card-body">

                    <div class="formulario-convocatoria">

                        <form id="formulario_convocatoria" method="POST" action="{{route('administrador.activaConvocatoria')}}">

                            @csrf

                            @foreach ($carreras as $carrera)
                                <div class="input-group mb-3 input-carrera">
                                    <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">{{ $carrera->carrera }}</span>
                                    <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                            aria-describedby="inputGroup-sizing-default" name="carreras[{{ $carrera->id }}]" required>
                                </div>
                            @endforeach
                            
                            <div class="fechas_convocatoria">

                                <div class="fecha_inicio">
                                    <span>Fecha de inicio:</span>
                                    <input type="date" name="fecha_inicio" id="" required
                                            name="fecha_inicio">

                                </div>

                                <div class="fecha_cierre">
                                    <span>Fecha de cierre:</span>
                                    <input type="date" name="fecha_cierre" id="" required
                                            name="fecha_cierre">

                                </div>

                            </div>

                            <div class="botones-form">
    
                                <div class="boton-envio" id="boton_habilitar">
    
                                    <button type="submit" class="btn btn-dark">Habilitar</button>
    
                                </div>
                            </div>

                        </form>

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

    <script>

            document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formulario_convocatoria');
            const submitButton = document.getElementById('boton_habilitar');

            submitButton.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el envío del formulario inmediatamente

                const userConfirmed = confirm('¿Estás seguro que quieres habilitar con esos datos?');
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