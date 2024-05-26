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

                        <form action="">

                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Informática</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
    
                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Sis. Computacionales</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
    
                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Ambiental</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
    
                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Industrial</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>

                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Sis. Automotrices</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>

                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Gestión Empresarial</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>

                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Electromecánica</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>

                            <div class="input-group mb-3 input-carrera">
                                <span class="input-group-text nombre-carrera-input" id="inputGroup-sizing-default">Ing. Electrónica</span>
                                <input type="number" class="form-control input-numero-carrera" aria-label="Sizing example input" 
                                        aria-describedby="inputGroup-sizing-default" disabled>
                            </div>
                            
                            <div class="botones-form">
                                <div class="boton-acuerdo">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Estoy de acuerdo
                                        </label>
                                      </div>
    
                                </div>
    
                                <div class="boton-envio">
    
                                    <button type="submit" class="btn btn-primary mb-3">Habilitar</button>
    
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
</body>
</html>