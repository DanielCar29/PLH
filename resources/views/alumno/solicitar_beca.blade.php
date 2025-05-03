<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLH: solicitar_beca</title>
    <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/alumno/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
     {{-- Menú de navegación --}}
     @include('/alumno/nav/menu_alumno')
    
    {{-- Contenido --}}
    <div class="container contenido">
        {{-- Convocatoria de beca --}}
        <div class="row justify-content-center mt-5">
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Convocatoria de Beca</h1>
                        <p class="card-text text-center">La convocatoria de beca ofrece oportunidades de financiamiento para estudiantes sobresalientes. Si cumples con los requisitos, ¡no dudes en solicitar!</p>
                        <div class="d-grid gap-2">
                            <a id="solicitar-beca-btn" href="{{ url('/alumno/formulario') }}" class="btn btn-primary disabled" title="Cargando...">Solicitar</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route("convocatoria.activa") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la API');
                    }
                    return response.json();
                })
                .then(data => {
                    const solicitarBecaBtn = document.getElementById('solicitar-beca-btn');

                    if (data.activa) {
                        if (data.puede_solicitar) {
                            solicitarBecaBtn.classList.remove('disabled');
                            solicitarBecaBtn.title = "Haz clic para solicitar la beca.";
                        } else {
                            solicitarBecaBtn.classList.add('disabled');
                            solicitarBecaBtn.title = "Ya has enviado una solicitud para esta convocatoria.";
                        }
                    } else {
                        solicitarBecaBtn.classList.add('disabled');
                        solicitarBecaBtn.title = "No hay convocatorias activas en este momento.";
                    }
                })
                .catch(error => {
                    console.error('Error al verificar la convocatoria:', error);
                });
        });
    </script>
</body>
</html>
