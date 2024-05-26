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

        <div class="titulo">
            <h2>
                Registrar 
            </h2>
        </div>

        <div class="registro">

            <form action="">

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nombre</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group">
                    <span class="input-group-text">Apellido Materno y Paterno</span>
                    <input type="text" aria-label="First name" class="form-control">
                    <input type="text" aria-label="Last name" class="form-control">
                </div>

                <div class="input-group mb-3 correo">
                    <input type="text" class="form-control" placeholder="Correo Electronico" aria-label="Username">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" placeholder="Gmail" aria-label="Server">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Nombre de usuario" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Informática</option>
                        <option value="1">Ambiental</option>
                        <option value="2">Industrial</option>
                        <option value="3">Sistemas Computacionales</option>
                    </select>
                </div>
                
                <div class="contrasena">
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"
                            placeholder="Constraseña">
                </div>

                <div>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"
                            placeholder="Verificar Constraseña">
                </div>

                <div class="boton-registro">

                    <button type="submit" class="btn btn-primary mb-3">Registrar</button>

                </div>

            </form>

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