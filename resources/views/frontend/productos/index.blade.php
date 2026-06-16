<x-layout title="{{ $categoria->nombre ?? 'Productos - Intuitivas' }}">

<div class="container py-4">

    <!-- TITULO -->
    <h4 class="mb-4 fw-bold">
        Categoría: {{ $categoria->nombre ?? 'Todos' }}
    </h4>

    <div class="row">
        @forelse ($productos as $producto)

            <div class="col-12 col-sm-6 col-md-3 mb-4">

                <div class="card h-100 shadow-sm border-0">

                    <!-- IMAGEN (PRIMERA O DEFAULT) -->
                    <a href="{{ route('productos.show', $producto->id) }}">
                        @if($producto->imagenes->count())
                            <img src="{{ asset('storage/' . $producto->imagenes->first()->ruta) }}"
                                 class="card-img-top"
                                 style="height:220px; object-fit:cover;">
                        @else
                            <img src="{{ asset('images/default.png') }}"
                                 class="card-img-top"
                                 style="height:220px; object-fit:cover;">
                        @endif
                    </a>

                    <div class="card-body text-center">

                        <!-- NOMBRE -->
                        <h6 class="fw-semibold">
                            {{ $producto->nombre_producto }}
                        </h6>

                        <!-- PRECIO -->
                        <p class="mb-2 fw-bold text-dark">
                            ${{ number_format($producto->precio_producto, 0, ',', '.') }}
                        </p>

                        <!-- COLOR -->
                        <p class="mb-1 small text-muted">
                            Color: {{ $producto->color ?? '-' }}
                        </p>

                        <!-- TALLE -->
                        <p class="mb-2 small text-muted">
                            Talle: {{ $producto->talle ?? '-' }}
                        </p>

                        <!-- BOTÓN -->
                        <a href="{{ route('productos.show', $producto->id) }}"
                           class="btn btn-sm text-white"
                           style="background-color:#1A5276;">
                            Ver producto
                        </a>

                    </div>

                </div>

            </div>

        @empty
            <div class="col-12 text-center text-muted py-5">
                No hay productos en esta categoría
            </div>
        @endforelse
    </div>

</div>

</x-layout>