<x-layout title="{{ $producto['nombre'] }}">

<div class="container">

    <div class="row">

        <!-- IMAGEN -->
        <div class="col-md-6">
            <img src="{{ asset($producto['imagen']) }}" class="img-fluid">
        </div>

        <!-- INFO -->
        <div class="col-md-6">
            <h1>{{ $producto['nombre'] }}</h1>

            <h3 class="text-success">${{ $producto['precio'] }}</h3>

            <p>{{ $producto['descripcion'] }}</p>

            <p>
                <strong>Categoría:</strong> {{ $producto['categoria'] ?? 'Sin categoría' }}
            </p>

            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>

    </div>

</div>

</x-layout>