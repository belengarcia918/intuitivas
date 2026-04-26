<x-layout title="{{ $producto['nombre'] }}">

<div class="container">

    <div class="row">

        <!-- IMAGEN -->
        <div class="col-md-6">
            <img src="{{ asset($producto['imagen']) }}" class="img-fluid">
        </div>

        <!-- INFO -->
        <div class="col-md-6">
            <h1 class="titulo mb-3">{{ $producto['nombre'] }}</h1>

            <h3 class="precio"><strong>${{ $producto['precio'] }}</strong></h3>

            <p class="texto">{{ $producto['descripcion'] }}</p>

            <p class="texto">
                <strong>Categoría:</strong> {{ $producto['categoria'] ?? 'Sin categoría' }}
            </p>

            <a href="{{ route('productos.index') }}" class="boton-carrito">
                Volver
            </a>
        </div>

    </div>

</div>

</x-layout>