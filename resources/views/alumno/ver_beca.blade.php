<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Beca</title>
    <link rel="shortcut icon" href="{{ URL::asset('/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/alumno/style.css') }}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
    
    {{-- Menú de navegación --}}
    @include('alumno.nav.menu_alumno')
    
    {{-- Ver la beca --}}
    <div class="contenedor_detalles">
        <div class="container contenido">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h2 class="card-header">Detalles de la Beca</h2>
                        <div class="card-body">

                            {{-- Verificar si existen los datos de fecha de autorización y estado --}}
                            @if(!empty($beca) && !empty($beca->fecha_de_autorizacion) && !empty($beca->estado))
                                <p><strong>Fecha de Autorización:</strong> {{ $beca->fecha_de_autorizacion }}</p>
                                <p><strong>Estado:</strong> {{ $beca->estado }}</p>
                            @else
                                <p><strong>Fecha de Autorización:</strong> No disponible</p>
                                <p><strong>Estado:</strong> Usted no ha llevado alguna vez la beca alimenticia o no posee esta misma.</p>
                            @endif

                            <p><strong>Descripción:</strong> <span id="description">Esta beca proporciona apoyo alimenticio mensual
                                 para estudiantes en situación de vulnerabilidad económica.</span></p>

                            {{-- Mostrar botón de descargar PDF solo si la beca está activa --}}
                            @if(!empty($beca) && $beca->estado == 'activa')
                                <a href="{{ route('alumno.beca.generarPDF') }}" class="btn btn-primary">Descargar PDF</a>
                            @endif

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
