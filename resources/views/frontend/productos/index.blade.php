<x-layout title="{{ $categoria->nombre ?? 'Productos - Intuitivas' }}">

<div class="container py-5">

    {{-- TÍTULO --}}
    <header>
        <div class="container pt-2 pb-3">

            <h1 class="titulo-principal fw-bold mb-1">
                Categoría: {{ isset($categoria) ? $categoria->nombre : 'Todos los productos' }}
            </h1>

            <p class="texto-3 mb-2">
                {{ isset($categoria)
                    ? 'Explorá todos los productos disponibles en esta categoría.'
                    : 'Explorá todo nuestro catálogo de productos.'
                }}
            </p>

            <hr>

        </div>
    </header>

    <div class="row g-4">

        @forelse($productos as $producto)

            @php

                $imagenPrincipal =
                    $producto->imagenes->first();

                $imagen = $imagenPrincipal
                    ? asset('storage/' . $imagenPrincipal->path)
                    : asset('images/default.png');

            @endphp

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                <div class="card h-100 border-0 shadow-sm producto-card">

                    <a
                        href="{{ route('productos.show', $producto->id) }}"
                        class="text-decoration-none">

                        <img
                            src="{{ $imagen }}"
                            alt="{{ $producto->nombre }}"
                            class="card-img-top img-producto-catalogo">

                    </a>

                    <div class="card-body d-flex flex-column text-center">

                        <div class="mb-2 text-muted small">

                            {{ $producto->categoria->nombre }}

                        </div>

                        <h5 class="texto-2-n mb-3">

                            {{ $producto->nombre }}

                        </h5>

                        <div class="precio-2 mb-4">

                            ${{ number_format($producto->precio, 0, ',', '.') }}

                        </div>

                        <div class="mt-auto">

                            <a
                                href="{{ route('productos.show', $producto->id) }}"
                                class="btn boton-carrito w-100">

                                Ver producto

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="text-center py-5">

                    <i class="bi bi-bag-x fs-1 d-block mb-3"></i>

                    <h4 class="titulo">

                        No hay productos disponibles

                    </h4>

                    <p class="texto mb-0">

                        Esta categoría todavía no tiene productos cargados.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

</x-layout>