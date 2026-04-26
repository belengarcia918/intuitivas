<x-layout title="Productos">

<h1>Categoría: {{ $categoria ?? 'todos' }}</h1>

<div class="row">
    @foreach ($productos as $producto)
        <div class="col-md-3 mb-3">

            <div class="card h-100">

                <a href="{{ route('productos.show', $producto['id']) }}">
                <img src="{{ asset($producto['imagen']) }}" class="card-img-top img-producto">
                </a>

                <div class="card-body">
                    <h6>{{ $producto["nombre"] }}</h6>
                    <p class="mb-2">${{ $producto["precio"] }}</p>

                    <a href="{{ route('productos.show', $producto['id']) }}" class="boton-ver">
                        Ver producto
                    </a>
                </div>

            </div>

        </div>
    @endforeach
</div>

</x-layout>