<header>
  <nav class="navbar navbar-expand-lg mi-navbar">
    <div class="container-navbar flex-column px-3">

      <!-- FILA SUPERIOR -->
      <div class="d-flex w-100 justify-content-between align-items-center">
        <a class="navbar-brand" href="{{ route('principal') }}">INTUITIVAS</a>

        <form class="d-flex" role="search">
        <input class="form-control buscador" type="search" placeholder="¿Qué estás buscando?">
        <button class="btn boton-buscar" type="submit">
          <img src="{{ asset('images/iconos/lupa.png') }}" class="icono-lupa">
        </button>
      </form>
      </div>

      <!-- BOTÓN HAMBURGUESA -->
      <button class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- FILA INFERIOR -->
      <div class="collapse navbar-collapse w-100 mt-2" id="navbarScroll">

        <div class="d-flex w-100 justify-content-between">

          <!-- IZQUIERDA -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('principal') }}">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('quienes_somos') }}">Quiénes Somos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Productos
              </a>

              <ul class="dropdown-menu">
                
                <li>
                  <a class="dropdown-item" href="{{ route('productos.index') }}">
                    Todos
                  </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                @foreach ($categoriasMenu as $categoria)
                    <li>
                        <a class="dropdown-item"
                          href="{{ route('productos.categoria', $categoria->id) }}">
                            {{ $categoria->nombre }}
                        </a>
                    </li>
                @endforeach

              </ul>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="{{route('comercializacion') }}">Comercialización</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('terminos_de_uso') }}">Términos de Uso</a>
            </li>
          </ul>

          <!-- DERECHA -->
          <ul class="navbar-nav">
            

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">

                <img src="{{ asset('images/iconos/cuenta.png') }}" class="icono-user me-2">

                @auth
                    {{ Auth::user()->name }}
                @else
                    Cuenta
                @endauth

              </a>

              <ul class="dropdown-menu">

                @auth
                    <li>
                      <a class="dropdown-item" href="{{ route('cliente.dashboard') }}">
                        Mi perfil
                      </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                          Cerrar sesión
                        </button>
                      </form>
                    </li>

                @else
                    <li>
                      <a class="dropdown-item" href="{{ route('registro') }}">
                        Crear cuenta
                      </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                      <a class="dropdown-item" href="{{ route('login') }}">
                        Iniciar sesión
                      </a>
                    </li>
                @endauth

              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCarrito">
                  <img src="{{ asset('images/iconos/carrito.png') }}" class="icono-carrito me-2">
                    Carrito
                  @if($cantItems > 0)
                      <span class="badge bg-dark ms-1">
                          {{ $cantItems }}
                      </span>
                  @endif
              </a>
            </li>
          </ul>

        </div>

      </div>

    </div>
  </nav>
</header>