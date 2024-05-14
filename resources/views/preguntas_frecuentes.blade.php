<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preguntas Frecuentes</title>
    <link rel="stylesheet" href="{{URL::asset('/css/preguntas_frecuentes/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="{{URL::asset('/img/logo_ejemplo.png')}}" alt="Logo" height="35" class="d-inline-block align-text-top">
            Proyect Large Heart
          </a>
        </div>
      </nav>

      <div class="contenido-general">

        <div class="container">
            <div class="row contenido-parte-uno">
                <div class="col">
                    1 of 3
                </div>
                <div class="col">
                    2 of 3
                </div>
                <div class="col">
                    3 of 3
                </div>
            </div>

            <div class="row contenido-parte-dos">
                <div class="col">
                    1 of 3
                </div>
                <div class="col">
                    2 of 3
                </div>
                <div class="col">
                    3 of 3
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