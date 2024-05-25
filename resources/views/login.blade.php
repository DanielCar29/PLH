<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PLH: Proyect Large heart</title>
  <link rel="stylesheet" href="{{ asset('/css/login/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
  <div class="container text-center">

    <div class="row contenido-general">

      <div class="col-8 contenido-bienvenida">

        <div class="nombre-proyecto color">
          <h4>Proyect Large Heart</h4>
        </div>

        <div class="bienvenida-texto color">
          <h4>Nice to see you again!</h4>
        </div>

        <div class="bienvenida-titulo color">
          <h1>WELCOME BACK!</h1>
        </div>

        <div class="bienvenida-parrafo color">
          <p>
            Tempor ipsum qui ea culpa nulla est exercitation anim consectetur magna.
            In aliqua exercitation eiusmod quis aliquip Lorem ad commodo ut cupidatat proident.
          </p>
        </div>

      </div>

      <div class="col-4 login-plh">
        <div>
          <img src="{{URL::asset('/img/logo_ejemplo.png')}}" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
        </div>
      
          <div class="instrucciones">
            <h4>Login Account</h4>
            <p>Exercitation enim adipisicing quis dolore irure reprehenderit labore consequat.</p>
          </div>
        <form action="">
        <div class="input-login">
          <input type="email" name="" id="" placeholder="Email">
        </div>
        
        <div class="input-login">
          <input type="password" name="" id="" placeholder="Password">
        </div>
        
        <div class="boton-login">
          <button type="submit">Log in</button>
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