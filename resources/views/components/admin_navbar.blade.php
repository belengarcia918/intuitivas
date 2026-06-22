<header>
  <nav class="navbar navbar-expand-lg mi-navbar-admin">
    <div class="container-navbar flex-column px-3">

      <div class="d-flex w-100 justify-content-between align-items-center">
        <a class="navbar-brand-admin" href="{{ route('admin.dashboard') }}">
          INTUITIVAS ADMIN
        </a>

        <div class="d-flex align-items-center gap-3 admin-user-wrapper">
          <span class="admin-user-name">
            {{ Auth::user()->name }}
          </span>

          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button class="btn btn-sm btn-logout-admin">
              Cerrar sesión
            </button>
          </form>
        </div>
      </div>

      <button class="navbar-toggler mt-2" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarAdmin">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse w-100 mt-2" id="navbarAdmin">
        <div class="d-flex w-100 justify-content-between">

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link-admin {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                Home
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link-admin {{ Request::routeIs('admin.contactos*') ? 'active' : '' }}" href="{{ route('admin.contactos.index') }}">
                Ver contactos
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link-admin {{ Request::routeIs('admin.productos.listado') ? 'active' : '' }}" href="{{ route('admin.productos.listado') }}">
                Productos
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link-admin {{ Request::routeIs('admin.ventas') ? 'active' : '' }}" href="{{ route('admin.ventas') }}">
                Ventas
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link-admin {{ Request::routeIs('admin.productos.create') ? 'active' : '' }}" href="{{ route('admin.productos.create') }}">
                Agregar productos
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link-admin {{ Request::routeIs('admin.productos') ? 'active' : '' }}" href="{{ route('admin.productos') }}">
                Gestión de productos
              </a>
            </li>
          </ul>

        </div>
      </div>

    </div>
  </nav>
</header>