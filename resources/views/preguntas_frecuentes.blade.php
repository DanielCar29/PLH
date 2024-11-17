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

        <div class="titulo-general">
            <h3>Categorias de ayuda</h3>
        </div>

        <div class="container">
            <div class="row contenido-parte-uno">
                <div class="col caja-ayuda">
                    
                    {{-- Primer acordeón --}}

                    <div class="subtitulo-caja-ayuda">
                        <div class="icono">
                            <img src="{{URL::asset('/img/icons/supervisor.png')}}" alt="" height="30">
                        </div>
                        <h5>Supervisor</h5>
                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#supervisor-ayuda-uno" 
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="supervisor-ayuda-uno" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#supervisor-ayuda-dos" 
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="supervisor-ayuda-dos" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being 
                                filled with some actual content.
                            </div>
                        </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#supervisor-ayuda-tres" 
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="supervisor-ayuda-tres" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting 
                                happening here in terms of content, but just filling up the space to make it look, at least at first 
                                glance, a bit more representative of how this would look in a real-world application.
                            </div>
                        </div>
                    </div>
                </div>
                </div>
{{-- ------------------------------------------------------------------------------------------------------------------------------------------ --}}
            
                <div class="col caja-ayuda">
                    
                    {{-- Segundo acordeón --}}

                    <div class="subtitulo-caja-ayuda">
                        <div class="icono">
                            <img src="{{URL::asset('/img/icons/alumno.png')}}" alt="" height="30">
                        </div>
                        <h5>Alumno</h5>
                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#alumno-ayuda-uno" 
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="alumno-ayuda-uno" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#alumno-ayuda-dos" 
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="alumno-ayuda-dos" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being 
                                filled with some actual content.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#alumno-ayuda-tres" 
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="alumno-ayuda-tres" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting 
                                happening here in terms of content, but just filling up the space to make it look, at least at first 
                                glance, a bit more representative of how this would look in a real-world application.
                            </div>
                          </div>
                        </div>
                      </div>

                </div>
{{-- ----------------------------------------------------------------------------------------------------------------------------------------------- --}}

                <div class="col caja-ayuda">
                    
                    {{-- Tercer acordeón --}}

                    <div class="subtitulo-caja-ayuda">
                        <div class="icono">
                            <img src="{{URL::asset('/img/icons/admin.png')}}" alt="" height="30">
                        </div>
                        <h5>Administrador</h5>
                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#admin-ayuda-uno" 
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="admin-ayuda-uno" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the first item's accordion body.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#admin-ayuda-dos" 
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="admin-ayuda-dos" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being 
                                filled with some actual content.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#admin-ayuda-tres" 
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="admin-ayuda-tres" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting 
                                happening here in terms of content, but just filling up the space to make it look, at least at first 
                                glance, a bit more representative of how this would look in a real-world application.
                            </div>
                          </div>
                        </div>
                      </div>

                </div>
            </div>
{{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}
            <div class="row contenido-parte-dos">
                <div class="col caja-ayuda">
                    
                    {{-- Primer acordeón --}}

                    <div class="subtitulo-caja-ayuda">
                        <div class="icono">
                            <img src="{{URL::asset('/img/icons/soporte.png')}}" alt="" height="30">
                        </div>
                        <h5>Soporte Técnico</h5>
                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#soporte-ayuda-uno" 
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="soporte-ayuda-uno" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the first item's accordion body.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#soporte-ayuda-dos" 
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="soporte-ayuda-dos" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this 
                                being filled with some actual content.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#soporte-ayuda-tres"
                                     aria-expanded="false" aria-controls="flush-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="soporte-ayuda-tres" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting 
                                happening here in terms of content, but just filling up the space to make it look, at least at first 
                                glance, a bit more representative of how this would look in a real-world application.
                            </div>
                          </div>
                        </div>
                      </div>

                </div>

{{-- ------------------------------------------------------------------------------------------------------------------------------------------ --}}
                <div class="col caja-ayuda">
                    
                    {{-- Segundo acordeón --}}
                    
                    <div class="subtitulo-caja-ayuda">
                        <div class="icono">
                            <img src="{{URL::asset('/img/icons/beca.png')}}" alt="" height="30">
                        </div>
                        <h5>Beca alimenticia</h5>
                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#beca-ayuda-uno" 
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="beca-ayuda-uno" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the first item's accordion body.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#beca-ayuda-dos" 
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="beca-ayuda-dos" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this 
                                being filled with some actual content.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#beca-ayuda-tres" 
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="beca-ayuda-tres" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting
                                 happening here in terms of content, but just filling up the space to make it look, at least at first 
                                 glance, a bit more representative of how this would look in a real-world application.
                            </div>
                          </div>
                        </div>
                      </div>

                </div>

{{-- ----------------------------------------------------------------------------------------------------------------------------------- --}}
                <div class="col caja-ayuda">
                    
                    {{-- Tercer acordeón --}}

                    <div class="subtitulo-caja-ayuda">
                        <div class="icono">
                            <img src="{{URL::asset('/img/icons/cafeteria.png')}}" alt="" height="30">
                        </div>
                        <h5>Cafeteria</h5>
                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cafe-ayuda-uno" 
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                              Accordion Item #1
                            </button>
                          </h2>
                          <div id="cafe-ayuda-uno" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the first item's accordion body.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cafe-ayuda-dos" 
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                              Accordion Item #2
                            </button>
                          </h2>
                          <div id="cafe-ayuda-dos" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this 
                                being filled with some actual content.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cafe-ayuda-tres"
                                     aria-expanded="false" aria-controls="flush-collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="cafe-ayuda-tres" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Placeholder content for this accordion, which is intended to demonstrate the 
                                <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting 
                                happening here in terms of content, but just filling up the space to make it look, at least at first 
                                glance, a bit more representative of how this would look in a real-world application.
                            </div>
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