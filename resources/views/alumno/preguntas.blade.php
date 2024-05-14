<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/supervisor/style.css')}}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
            crossorigin="anonymous">
            <style>
             div.menu-navegacion nav {
            background-color: #003785 !important;
            position: sticky; /* Cambiado a sticky */
            top: 0; /* Se fija en la parte superior */
            z-index: 1000; /* Ajustamos el z-index para que el menú de navegación se superponga sobre el contenido */
        }
        .nav-color-custom {
            background-color: #003785; /* Azul oscuro */
        }
        .contenido {
            margin-top: 80px; /* Ajusta el valor según el tamaño de la barra de navegación */

            
        }
         
              @media (max-width: 991.98px) {
                  .navbar-expand-lg .navbar-nav .nav-link {
                      padding-right: 0.5rem;
                      padding-left: 0.5rem;
                  }
                  .navbar {
        width: 100%; /* o cualquier otro valor fijo deseado */
    }
              }
          </style>

</head>
<body>
    {{-- Menú de navegación --}}
    <div class="menu-navegacion">
    <div>
      <nav class="navbar navbar-expand-lg bg-primary" style="padding: 0">
        <div class="container-fluid nav-color-custom">
          <a class="navbar-brand item-nav elemento-navegacion-plh" href="#">
            <img src="{{URL::asset('/img/logo_ejemplo.png')}}" alt="Logo" 
                width="40" height="40" class="d-inline-block align-text-top">
                    PLH
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active elemento-navegacion-plh" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link elemento-navegacion-plh" href="#">Solicitar becas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link elemento-navegacion-plh" href="#">Ver beca</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                  data-bs-toggle="dropdown" aria-expanded="false">
                      Ayuda
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Guías Y Manuales</a></li>
                    <li><a class="dropdown-item" href="#">Preguntas Frecuentes</a></li>
                    <li><a class="dropdown-item" href="#">Contacto</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                            Nombre Supervisor
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><a class="dropdown-item" href="#">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
      </nav>
    </div>
    </div>
    
    {{-- Formulario de Solicitud de Beca Alimenticia --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">Formulario de Solicitud de Beca Alimenticia</h2>
                    <div class="card-body">
                        <form action="/submit_form" method="post">
                        <div class="mb-3">
                            <label for="reason" class="form-label">¿Cuál es la razón principal que te lleva a solicitar urgentemente una beca alimenticia?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="income_loss" value="income_loss">
                                <label class="form-check-label" for="income_loss">Pérdida repentina de ingresos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="unexpected_expenses" value="unexpected_expenses">
                                <label class="form-check-label" for="unexpected_expenses">Gastos inesperados</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="other" value="other">
                                <label class="form-check-label" for="other">Otros (especificar)</label>
                            </div>
                            <textarea class="form-control mt-2" name="other_reason" rows="3"></textarea>
                        </div>
    
                        <div class="mb-3">
                            <label for="current_financial_situation" class="form-label">Proporciona detalles sobre tu situación financiera actual y por qué te encuentras en una situación tan crítica en términos de acceso a alimentos</label>
                            <textarea class="form-control" name="current_financial_situation" rows="3"></textarea>
                        </div>
    
                        <div class="mb-3">
                            <label for="meals_per_day" class="form-label">¿Cuántas comidas al día tienes actualmente? ¿Experimentas días sin suficiente comida?</label>
                            <input type="text" class="form-control" name="meals_per_day">
                        </div>
    
                        <div class="mb-3">
                            <label for="dependents" class="form-label">¿Tienes dependientes, como hijos o familiares ancianos, que también enfrentan inseguridad alimentaria?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dependents" id="yes" value="yes">
                                <label class="form-check-label" for="yes">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dependents" id="no" value="no">
                                <label class="form-check-label" for="no">No</label>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="assistance_received" class="form-label">¿Has buscado o recibido asistencia alimentaria de otras organizaciones o programas gubernamentales? Si es así, ¿en qué medida?</label>
                            <textarea class="form-control" name="assistance_received" rows="3"></textarea>
                        </div>
    
                        <div class="mb-3">
                            <label for="medical_condition" class="form-label">¿Tienes alguna condición médica que requiera una dieta especial o restricciones alimentarias?</label>
                            <textarea class="form-control" name="medical_condition" rows="3"></textarea>
                        </div>
    
                        <div class="mb-3">
                            <label for="documentation" class="form-label">¿Estás dispuesto a proporcionar documentación que respalde tu situación financiera actual, como extractos bancarios, cartas de desempleo u otros documentos relevantes?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="documentation" id="yes_doc" value="yes">
                                <label class="form-check-label" for="yes_doc">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="documentation" id="no_doc" value="no">
                                <label class="form-check-label" for="no_doc">No</label>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="difference" class="form-label">¿Cómo crees que recibir esta beca alimenticia podría marcar una diferencia significativa en tu situación?</label>
                            <textarea class="form-control" name="difference" rows="3"></textarea>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
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
