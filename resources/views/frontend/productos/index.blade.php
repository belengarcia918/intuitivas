<x-layout title="Productos">

<h4 class="container-fluid px-3 mb-4 text-start titulo">Categoría: {{ $categoria ?? 'todos' }}</h4>

<div class="row">
    @foreach ($productos as $producto)
        <div class="col-12 col-sm-6 col-md-3 mb-3">

            <div class="card h-100 shadow">

                <a href="{{ route('productos.show', $producto['id']) }}">
                    <img src="{{ asset($producto['imagenes'][0]) }}" class="card-img-top img-producto">
                </a>

                <div class="card-body">
                    <h6 class="titulo">{{ $producto["nombre"] }}</h6>
                    <p class="mb-2 precio-2"><strong>${{ $producto["precio"] }}</strong></p>

                    <a href="{{ route('productos.show', $producto['id']) }}" class="boton-ver">
                        Ver producto
                    </a>

                </div>

            </div>

        </div>
    @endforeach
</div>

</x-layout>