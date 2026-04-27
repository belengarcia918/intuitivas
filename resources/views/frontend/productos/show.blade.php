<x-layout title="{{ $producto['nombre'] }}">

<div class="container py-5">
    <div class="row g-4">

        <!-- GALERÍA -->
        <div class="col-12 col-md-7">

            <div class="row g-2">

                <!-- MINIATURAS -->
                <div class="col-12 col-md-2 order-2 order-md-1">

                    <div class="d-flex flex-md-column flex-row gap-2 overflow-auto">

                        @foreach ($producto['imagenes'] as $key => $img)
                            <img 
                                src="{{ asset($img) }}" 
                                class="img-thumbnail thumb-img flex-shrink-0"
                                style="width: 80px; height: 80px; object-fit: cover;"
                                data-bs-target="#carousel-{{ $producto['id'] }}"
                                data-bs-slide-to="{{ $key }}"
                            >
                        @endforeach

                    </div>

                </div>

                <!-- CARRUSEL -->
                <div class="col-12 col-md-10 order-1 order-md-2">

                    <div id="carousel-{{ $producto['id'] }}" class="carousel slide">

                        <div class="carousel-inner">

                            @foreach ($producto['imagenes'] as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($img) }}"
                                        class="d-block w-100 img-fluid rounded img-principal-producto">
                                </div>
                            @endforeach

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $producto['id'] }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $producto['id'] }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>

                </div>

            </div>
        </div>

        <!-- INFO PRODUCTO -->
        <div class="col-12 col-md-5">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item">
                        <a href="{{ route('productos.index') }}" class="text-decoration-none texto-2-n">
                            Productos
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-capitalize texto-2-n">
                        {{ $producto['categoria'] ?? 'General' }}
                    </li>
                </ol>
            </nav>

            <h1 class="titulo-principal mb-2 fs-3 fs-md-2">
                {{ $producto['nombre'] }}
            </h1>

            <h2 class="precio mb-4">
                ${{ number_format($producto['precio'], 0, ',', '.') }}
            </h2>

            <hr class="my-4 opacity-25">

            <!-- FORM -->
            <form action="{{ route('carrito.agregar') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $producto['id'] }}">
                <input type="hidden" name="nombre" value="{{ $producto['nombre'] }}">
                <input type="hidden" name="precio" value="{{ $producto['precio'] }}">
                <input type="hidden" name="imagen" value="{{ $producto['imagenes'][0] }}">

                <div class="row g-2 align-items-center mb-4">

                    <div class="col-4 col-md-3">
                        <input type="number" name="cantidad"
                            class="form-control form-control-lg text-center"
                            value="1" min="1">
                    </div>

                    <div class="col-8 col-md-9">
                        <button type="submit"
                            class="btn btn-lg w-100 text-white fw-bold boton-carrito">
                            Agregar al carrito
                        </button>
                    </div>

                </div>
            </form>

            <!-- INFO BOX -->
            <div class="card bg-light border-0">
                <div class="card-body p-3">
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="bi bi-truck me-2"></i>
                            <strong>Envío gratis</strong> en compras superiores a $50.000
                        </li>
                        <li>
                            <i class="bi bi-credit-card me-2"></i>
                            <strong>3 cuotas sin interés</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- VOLVER -->
            <div class="mt-4">
                <a href="{{ route('productos.index') }}"
                   class="btn btn-link text-decoration-none p-0 texto-2-n">
                    <i class="bi bi-arrow-left"></i> Volver al listado
                </a>
            </div>

        </div>

    </div>
</div>

</x-layout>