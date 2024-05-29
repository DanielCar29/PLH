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
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" 
                            aria-expanded="true" aria-controls="collapseOne">
                            Ing. Informática
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="tabla-lista">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero de control</th>
                                        <th>Nombre del alumno</th>
                                        <th>Acciones</th>
                                        <th>Aceptado/Rechazado</th>
                                    </tr>
                                </thead>

                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>212310628</td>
                                        <td>Jose Alberto Sandoval Vazquez</td>
                                        <td>
                                            <div class="icono_ver">
                                                <a href="{{ url('/administrador.ver') }}">
                                                    <img src="{{URL::asset('/img/icons/ver.png')}}" alt="" height="30">
                                                </a>
                                            </div>
            
                                        </td>
                                        <td>
                                            <div class="grupo-botones">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="option1">

                                                        <img src="{{URL::asset('/img/icons/acept.png')}}" alt="" height="30">

                                                    </label>
                                            
                                                    <input type="radio" class="btn-check" name="options" id="option2" checked autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="option2">
                                                        
                                                        <img src="{{URL::asset('/img/icons/pending.png')}}" alt="" height="30">

                                                    </label>
                                            
                                                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="option3">
                                                        
                                                        <img src="{{URL::asset('/img/icons/cancel.png')}}" alt="" height="30">

                                                    </label>
                                                </div>
                                            </div>
                                        
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>212310628</td>
                                        <td>Jose Alberto Sandoval Vazquez</td>
                                        <td>
                                            <div class="icono_ver">
                                                <a href="{{ url('/administrador.ver') }}">
                                                    <img src="{{URL::asset('/img/icons/ver.png')}}" alt="" height="30">
                                                </a>
                                            </div>
            
                                        </td>
                                        <td>
                                            <div class="grupo-botones">
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="options-" id="option1-" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="option1-">

                                                        <img src="{{URL::asset('/img/icons/acept.png')}}" alt="" height="30">

                                                    </label>
                                            
                                                    <input type="radio" class="btn-check" name="options-" id="option2-" checked autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="option2-">
                                                        
                                                        <img src="{{URL::asset('/img/icons/pending.png')}}" alt="" height="30">

                                                    </label>
                                            
                                                    <input type="radio" class="btn-check" name="options-" id="option3-" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="option3-">
                                                        
                                                        <img src="{{URL::asset('/img/icons/cancel.png')}}" alt="" height="30">

                                                    </label>
                                                </div>
                                            </div>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="boton-envio-aceptados">
                            <button type="button" class="btn btn-success">Enviar aceptados</button>
                        </div>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" 
                            aria-expanded="false" aria-controls="collapseTwo">
                      Ing. Sistemas Computacionales
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      
                        <div class="tabla-lista">
                            <table class="table table-hover table-striped">
                                <caption>Lista de solicitudes de alumnos de Informática</caption>
                                <thead>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Edad</th>
                                    <th>Correo Electrónico</th>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Juan</td>
                                        <td>Pérez</td>
                                        <td>20</td>
                                        <td>juan.perez@example.com</td>
                                    </tr>


                                    <tr>
                                        <td>Juan</td>
                                        <td>Pérez</td>
                                        <td>20</td>
                                        <td>juan.perez@example.com</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" 
                            aria-expanded="false" aria-controls="collapseThree">
                      Ing. Ambiental
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      
                        <div class="tabla-lista">
                            <table class="table table-hover table-striped">
                                <caption>Lista de solicitudes de alumnos de Informática</caption>
                                <thead>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Edad</th>
                                    <th>Correo Electrónico</th>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Juan</td>
                                        <td>Pérez</td>
                                        <td>20</td>
                                        <td>juan.perez@example.com</td>
                                    </tr>


                                    <tr>
                                        <td>Juan</td>
                                        <td>Pérez</td>
                                        <td>20</td>
                                        <td>juan.perez@example.com</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>

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