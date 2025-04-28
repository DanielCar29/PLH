{{-- Menú de navegación --}}
<div class="menu-navegacion">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid nav-color color-borde-plh">
      <a class="navbar-brand item-nav elemento-navegacion-plh" href="{{ url('/alumno.home') }}">
        <img src="{{URL::asset('/img/logo.png')}}" alt="Logo" 
            height="30" class="d-inline-block align-text-top">
                PLH
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link active elemento-navegacion-plh" aria-current="page" href="{{ url('/alumno.home') }}">Home</a>
              </li>
              <li class="nav-item" id="solicitar-beca-item" style="display: none;">
                  <a class="nav-link elemento-navegacion-plh" href="{{ url('/alumno.solicitar_beca') }}">
                     Solicitar beca
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link elemento-navegacion-plh" href="{{ url('/alumno.beca') }}">Información de tu beca</a>
              </li>
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
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle elemento-navegacion-plh" href="#" role="button" 
                      data-bs-toggle="dropdown" aria-expanded="false">
                          {{ Auth::user()->name }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}
                  </a>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item"href="{{URL::asset('/alumno.perfil')}}">Perfil</a></li>
                      <li>  <a class="dropdown-item">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('{{ route("convocatoria.activa") }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta de la API');
                }
                return response.json();
            })
            .then(data => {
                if (data.activa) {
                    document.getElementById('solicitar-beca-item').style.display = 'block';
                } else {
                    console.warn('No hay una convocatoria activa.');
                }
            })
            .catch(error => {
                console.error('Error al verificar la convocatoria:', error);
            });
    });
</script>
