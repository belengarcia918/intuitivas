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
              <a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('ver_contactos') }}">Ver contactos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('ver_productos') }}">Productos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('ventas') }}">Ventas</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('agregar_producto') }}">Agregar productos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('gestionar_productos') }}">Gestor de productos</a>
            </li>
          </ul>

          <!-- DERECHA -->
          <ul class="navbar-nav">
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                <img src="{{ asset('images/iconos/cuenta.png') }}" class="icono-user me-2">
                {{ Auth::user()->name }} </a>
              
              <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-item-text text-muted">Modo: {{ ucfirst(Auth::user()->rol) }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; width: 100%; text-align: left; margin: 0; padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);">
                      Cerrar sesión
                    </button>
                  </form>
                </li>
              </ul>
            </li>
          </ul>

        </div>
      </div>

    </div>
  </nav>
</header>