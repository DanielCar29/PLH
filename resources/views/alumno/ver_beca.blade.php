<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLH:info:beca</title>
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
    
   {{-- Ver la beca --}}
   <div class="contenedor_detalles">
    <div class="container contenido">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <h2 class="card-header">Detalles de la Beca</h2>
                    <div class="card-body">
                        <p><strong>Fecha de Activación:</strong> <span id="activation-date">15 de mayo de 2024</span></p>
                        <p><strong>Estado de la Beca:</strong> <span id="status">Activa</span></p>
                        <p><strong>Descripción:</strong> <span id="description">Esta beca proporciona apoyo alimenticio mensual para estudiantes en situación de vulnerabilidad económica.</span></p>
                        <button class="btn btn-primary" id="recover-qr-btn">Recuperar Código QR</button>
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
