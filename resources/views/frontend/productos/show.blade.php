<x-layout title="{{ $producto['nombre'] }}">

<div class="container py-5">
    <div class="row align-items-center">
        
        <div class="col-md-7 mb-4 mb-md-0">
            <div class="pe-md-5"> 
                <img src="{{ asset($producto['imagen']) }}" 
                     class="img-fluid rounded shadow-sm" 
                     alt="{{ $producto['nombre'] }}"
                     style="width: 100%; object-fit: cover; max-height: 500px;">
            </div>
        </div>

        <div class="col-md-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}" class="text-decoration-none text-muted">Productos</a></li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">{{ $producto['categoria'] ?? 'General' }}</li>
                </ol>
            </nav>

            <h1 class="fw-bold display-6 mb-2">{{ $producto['nombre'] }}</h1>
            <h2 class="fw-light mb-4" style="color: #5f2660;">
                ${{ number_format($producto['precio'], 0, ',', '.') }}
            </h2>

            <div class="mb-4">
                <h6 class="text-uppercase fw-bold text-muted small">Descripción</h6>
                <p class="text-secondary leading-relaxed">
                    {{ $producto['descripcion'] }}
                </p>
            </div>

            <hr class="my-4 opacity-25">

            <div class="row g-2 mb-4">
                <div class="col-3">
                    <input type="number" class="form-control form-control-lg text-center" value="1" min="1">
                </div>
                <div class="col-9">
                    <button class="btn btn-lg w-100 text-white fw-bold" style="background-color: #5f2660;">
                        AGREGAR AL CARRITO
                    </button>
                </div>
            </div>

            <div class="card bg-light border-0">
                <div class="card-body p-3">
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="bi bi-truck me-2"></i> <strong>Envío gratis</strong> en compras superiores a $50.000
                        </li>
                        <li>
                            <i class="bi bi-credit-card me-2"></i> <strong>3 cuotas sin interés</strong> con todos los bancos
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('productos.index') }}" class="btn btn-link text-decoration-none p-0 text-muted">
                    <i class="bi bi-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>

</x-layout>