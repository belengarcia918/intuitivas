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
                <li><a class="dropdown-item" href="{{ route('productos.index') }}">Todos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('productos.categoria', 'cinto') }}">Cinto</a></li>
                <li><a class="dropdown-item" href="{{ route('productos.categoria', 'cartera') }}">Cartera</a></li>
              </ul>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="{{route('comercializacion') }}">Comercialización</a>
            </li>
          </ul>

          <!-- DERECHA -->
          <ul class="navbar-nav">
            

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                <img src="{{ asset('images/iconos/cuenta.png') }}" class="icono-user me-2">Cuenta
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Crear cuenta</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Iniciar sesión</a></li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">
                <img src="{{ asset('images/iconos/carrito.png') }}" class="icono-carrito me-2">Carrito
              </a>
            </li>
          </ul>

        </div>

      </div>

    </div>
  </nav>
</header>