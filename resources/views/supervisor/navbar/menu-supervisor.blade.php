{{-- Menú de navegación --}}
<div class="menu-navegacion">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid nav-color color-borde-plh">
      <a class="navbar-brand item-nav elemento-navegacion-plh" href="{{ url('/supervisor.home') }}">
        <img src="{{URL::asset('/img/logo.png')}}" alt="Logo" 
            height="30" class="d-inline-block align-text-top">
                PLH
    </a>
    {{-- Botón de desplazamiento --}}
    <div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    {{-- ---------------------------------------------------------------------------------------------------------------------- --}}
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active elemento-navegacion-plh" aria-current="page" href="{{ url('/supervisor.home') }}">
                  Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link elemento-navegacion-plh" href="{{ url('/supervisor.visualizar_solicitud') }}">
                  Visualizar Solicitudes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link elemento-navegacion-plh" href="{{ url('/supervisor.visualizar_reporte') }}">
                  Visualizar Reporte
                </a>
            </li>
            {{--  --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
              data-bs-toggle="dropdown" aria-expanded="false">
                  Ayuda
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{URL::asset('/pdfs/README.pdf')}}">Guías Y Manuales</a></li>
                <li><a class="dropdown-item" href="{{ url('/preguntas_frecuentes') }}" target="_blank">Preguntas Frecuentes</a></li>
                <li><a class="dropdown-item" href="mailto:contact.josesandoval@gmail.com">Contacto</a></li>
              </ul>
            </li>
            {{--  --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/supervisor.perfil') }}">Perfil</a></li>
                    <li>
                      <a class="dropdown-item">
                        <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <button type="submit" class="boton-salir">Salir</button>
                        </form>
                      </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
  </nav>
</div>
