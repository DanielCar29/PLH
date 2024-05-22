<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizar Reporte</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
</head>
<body>
    {{-- Menú --}}
    @include('/supervisor/menu-supervisor')
    
    {{-- Contenido --}}
    <div class="contenido_general-visualizar_reporte">
        <div class="contenido-visualizar_reporte">
            <div class="titulo-visualizar_reporte">
                <h1>Reporte del alumnado</h1>
            </div>

            <div class="tabla-visualizar_reporte table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Numero de control</th>
                        <th>Nombre del alumno</th>
                        <th>Acciones</th>
                        <th>Última vez</th>
                    </tr>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>212310628</td>
                            <td>Jose Alberto Sandoval Vazquez</td>
                            <td>
                                <div class="icono_notificacion">
                                    <a href="">
                                        <img src="{{URL::asset('/img/icons/notificacion.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_monitoreo">
                                    <a href="{{ url('/supervisor.grafica') }}">
                                        <img src="{{URL::asset('/img/icons/monitoreo.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_pdf">
                                    <a href="">
                                        <img src="{{URL::asset('/img/icons/archivo-pdf.png')}}" alt="" height="30">
                                    </a>
                                </div>
                            </td>
                            <td>Lunes 13 de Mayo 2024</td>
                        </tr>

                        <tr>
                            <td>212310628</td>
                            <td>Jose Alberto Sandoval Vazquez</td>
                            <td>
                                <div class="icono_notificacion">
                                    <a href="">
                                        <img src="{{URL::asset('/img/icons/notificacion.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_monitoreo">
                                    <a href="{{ url('/supervisor.grafica') }}">
                                        <img src="{{URL::asset('/img/icons/monitoreo.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_pdf">
                                    <a href="">
                                        <img src="{{URL::asset('/img/icons/archivo-pdf.png')}}" alt="" height="30">
                                    </a>
                                </div>
                            </td>
                            <td>Lunes 13 de Mayo 2024</td>
                        </tr>

                        <tr>
                            <td>212310628</td>
                            <td>Jose Alberto Sandoval Vazquez</td>
                            <td>
                                <div class="icono_notificacion">
                                    <a href="">
                                        <img src="{{URL::asset('/img/icons/notificacion.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_monitoreo">
                                    <a href="{{ url('/supervisor.grafica') }}">
                                        <img src="{{URL::asset('/img/icons/monitoreo.png')}}" alt="" height="30">
                                    </a>
                                </div>

                                <div class="icono_pdf">
                                    <a href="">
                                        <img src="{{URL::asset('/img/icons/archivo-pdf.png')}}" alt="" height="30">
                                    </a>
                                </div>
                            </td>
                            <td>Lunes 13 de Mayo 2024</td>
                        </tr>
                    </tbody>
                    
                </table>
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