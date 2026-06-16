<header>
  <nav class="navbar navbar-expand-lg mi-navbar">
    <div class="container-navbar flex-column px-3">

      <!-- FILA SUPERIOR -->
      <div class="d-flex w-100 justify-content-between align-items-center">
        <a class="navbar-brand" href="{{ route('home') }}">INTUITIVAS</a>

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
          @php
                $user = Auth::user();
            @endphp

            <ul class="navbar-nav">

                {{-- ===================== --}}
                {{-- VISITANTE / CLIENTE --}}
                {{-- ===================== --}}
                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('quienes_somos') }}">Quienes Somos</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('comercializacion') }}">Comercialización</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('terminos_de_uso') }}">Terminos de Uso</a>
                        </li>
                    </ul>

                    {{-- CARRITO --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCarrito">

                            Carrito

                            @php
                                $count = count(session('carrito', []));
                            @endphp

                            @if($count > 0)
                                <span class="badge bg-secondary">{{ $count }}</span>
                            @endif
                        </a>
                    </li>

                @endguest


                {{-- ===================== --}}
                {{-- USUARIO LOGUEADO --}}
                {{-- ===================== --}}
                @auth

                    {{-- CLIENTE --}}
                    @if($user->rol === 'cliente')

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('') }}">Productos</a>
                        </li>

                        {{-- CARRITO --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCarrito">

                                Carrito

                                @php
                                    $count = count(session('carrito', []));
                                @endphp

                                @if($count > 0)
                                    <span class="badge bg-secondary">{{ $count }}</span>
                                @endif

                            </a>
                        </li>

                    @endif


                    {{-- ADMIN --}}
                    @if($user->rol === 'admin')

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
                            <a class="nav-link" href="{{ route('gestionar_productos') }}">Gestionar productos</a>
                        </li>

                    @endif

                @endauth

            </ul>

            

        </div>
      </div>

    </div>
  </nav>
</header>