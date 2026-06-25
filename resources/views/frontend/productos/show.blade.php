<x-layout title="{{ $producto->nombre }} - Intuitivas">

<div class="container py-5">

    <div class="row g-5">

        {{-- GALERÍA --}}
        <div class="col-lg-7">

            <div class="row">

                {{-- MINIATURAS --}}
                <div class="col-2">

                    @foreach($producto->imagenes as $key => $img)
                        <img
                            src="{{ asset('storage/' . $img->path) }}"
                            class="img-fluid mb-2 thumb-img"
                            data-bs-target="#carouselProducto"
                            data-bs-slide-to="{{ $key }}">
                    @endforeach

                </div>

                {{-- IMAGEN PRINCIPAL --}}
                <div class="col-10">

                    <div id="carouselProducto" class="carousel slide">

                        <div class="carousel-inner">

                            @foreach($producto->imagenes as $key => $img)

                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                                    <img
                                        src="{{ asset('storage/' . $img->path) }}"
                                        class="d-block w-100 img-producto-2">

                                </div>

                            @endforeach

                        </div>

                        @if($producto->imagenes->count() > 1)

                            <button
                                class="carousel-control-prev"
                                type="button"
                                data-bs-target="#carouselProducto"
                                data-bs-slide="prev">

                                <span class="carousel-control-prev-icon"></span>

                            </button>

                            <button
                                class="carousel-control-next"
                                type="button"
                                data-bs-target="#carouselProducto"
                                data-bs-slide="next">

                                <span class="carousel-control-next-icon"></span>

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- INFORMACIÓN --}}
        <div class="col-lg-5">

            <p class="texto mb-1">
                {{ $producto->categoria->nombre }}
            </p>

            <h1 class="titulo mb-2">
                {{ $producto->nombre }}
            </h1>

            <div class="precio mb-4">
                ${{ number_format($producto->precio, 0, ',', '.') }}
            </div>

            @if($producto->descripcion)
                <p class="texto-3 mb-4">
                    {{ $producto->descripcion }}
                </p>
            @endif

            <hr>

            <form action="{{ route('carrito.agregar') }}" method="POST">

                @csrf

                <input type="hidden"
                        name="producto_id"
                        value="{{ $producto->id }}">
                <input type="hidden" name="nombre" value="{{ $producto->nombre }}">
                <input type="hidden" name="precio" value="{{ $producto->precio }}">
                <input type="hidden"
                       name="imagen"
                       value="{{ $producto->imagenes->first()->path ?? '' }}">

                {{-- COLORES --}}
                <div class="mb-4">

                    <label class="fw-bold texto-2-n d-block mb-2">
                        Color
                    </label>

                    <div class="d-flex flex-wrap gap-2">

                        @php
                            $colores = $producto->variantes
                                ->unique('color_id')
                                ->values();
                        @endphp

                        <input
                            type="hidden"
                            id="color_nombre"
                            name="color"
                            value="{{ \Illuminate\Support\Str::title($colores->first()->color->nombre ?? '') }}">

                        @foreach($colores as $index => $variante)

                        <label>

                            <input
                                type="radio"
                                name="color_id"
                                value="{{ $variante->color_id }}"
                                class="d-none"
                                {{ $index == 0 ? 'checked' : '' }}>

                            <span
                                class="color-circle"
                                data-nombre="{{ \Illuminate\Support\Str::title($variante->color->nombre) }}"
                                title="{{ \Illuminate\Support\Str::title($variante->color->nombre) }}"
                                style="background-color: {{ $variante->color->hex }}">
                            </span>

                        </label>

                        @endforeach

                    </div>

                </div>

                {{-- TALLES --}}
                <div class="mb-4">

                    <label class="fw-bold texto-2-n d-block mb-2">
                        Talle
                    </label>

                    <div
                        id="contenedor-talles"
                        class="d-flex flex-wrap gap-2">
                    </div>

                </div>

                <div class="mb-4">

                        <div id="mensaje-stock" class="mt-3"></div>

                    </div>

                {{-- CANTIDAD --}}
                <div class="row g-2 mb-4">

                    <div class="col-4">

                        <input
                            id="cantidad"
                            type="number"
                            name="cantidad"
                            value="1"
                            min="1"
                            class="form-control text-center">

                    </div>

                    <div class="col-8">

                        <button
                            id="btn-carrito"
                            type="submit"
                            class="btn boton-carrito w-100">

                            Agregar al carrito

                        </button>

                    </div>

                </div>

            </form>

            <div class="bg-light rounded shadow-sm p-4 mt-4">

                <h5 class="titulo mb-3">
                    Información de compra
                </h5>

                <div class="mb-3">
                    <i class="bi bi-truck me-2"></i>
                    Envíos a domicilio en Formosa capital (24/72 hs)
                </div>

                <div class="mb-3">
                    <i class="bi bi-box-seam me-2"></i>
                    Envíos al interior mediante correo
                </div>

                <div class="mb-3">
                    <i class="bi bi-shop me-2"></i>
                    Retiro gratuito en showroom
                </div>

                <hr>

                <div class="mb-3">
                    <i class="bi bi-cash-coin me-2"></i>
                    Efectivo
                </div>

                <div class="mb-3">
                    <i class="bi bi-credit-card me-2"></i>
                    Tarjetas de débito y crédito
                </div>

                <div class="mb-3">
                    <i class="bi bi-bank me-2"></i>
                    Transferencia bancaria
                </div>

                <div>
                    <i class="bi bi-wallet2 me-2"></i>
                    Mercado Pago
                </div>

            </div>

            <a href="{{ route('productos.index') }}"
               class="text-decoration-none">

                ← Volver al catálogo

            </a>

        </div>

    </div>

</div>

<script>

const variantes = @json($variantesData);

const contenedorTalles =
    document.getElementById('contenedor-talles');

function renderizarTalles(colorId)
{
    contenedorTalles.innerHTML = '';

    const tallesDisponibles =
        variantes.filter(
            variante => variante.color_id == colorId
        );

    tallesDisponibles.forEach((talle, index) => {

        contenedorTalles.innerHTML += `
            <label>

                <input
                    type="radio"
                    name="talle"
                    value="${talle.talle}"
                    class="d-none"
                    ${index === 0 ? 'checked' : ''}>

                <span class="talle-box">

                    ${talle.talle}

                </span>

            </label>
        `;
    });

    actualizarStock();
}

function actualizarStock() {

    const colorSeleccionado =
        document.querySelector(
            'input[name="color_id"]:checked'
        );

    const talleSeleccionado =
        document.querySelector(
            'input[name="talle"]:checked'
        );

    if (!colorSeleccionado || !talleSeleccionado) {
        return;
    }

    const variante = variantes.find(v =>
        v.color_id == colorSeleccionado.value &&
        v.talle == talleSeleccionado.value
    );

    const mensaje =
        document.getElementById('mensaje-stock');

    const boton =
        document.getElementById('btn-carrito');

    const cantidad =
        document.getElementById('cantidad');

    if (!variante) {
        return;
    }

    cantidad.max = variante.stock;

    if (parseInt(cantidad.value) > variante.stock) {

        cantidad.value =
            variante.stock > 0
                ? variante.stock
                : 1;
    }

    if (variante.stock <= 0) {

        mensaje.innerHTML = `
            <span class="texto-4 fw-semibold">
                <i class="bi bi-x-circle-fill"></i>
                Sin stock
            </span>
        `;

        boton.disabled = true;
        cantidad.disabled = true;

    } else {

        boton.disabled = false;
        cantidad.disabled = false;

        if (variante.stock === 1) {

            mensaje.innerHTML = `
                <span class="texto-4 fw-semibold">
                    <i class="bi bi-fire"></i>
                    ¡Última unidad disponible!
                </span>
            `;

        } else if (variante.stock <= 5) {

            mensaje.innerHTML = `
                <span class="texto-4 fw-semibold">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    ¡Últimas ${variante.stock} unidades!
                </span>
            `;

        } else {

            mensaje.innerHTML = '';
        }
    }
}

document
.querySelectorAll('input[name="color_id"]')
.forEach(radio => {

    radio.addEventListener('change', function() {

        const nombreColor =
            this.parentElement
                .querySelector('.color-circle')
                .dataset.nombre;

        document.getElementById('color_nombre').value =
            nombreColor;

        renderizarTalles(this.value);
    });

});

document.addEventListener('change', function(e){

    if(e.target.name === 'talle'){

        actualizarStock();

    }

});

const primerColor =
    document.querySelector(
        'input[name="color_id"]:checked'
    );

if (primerColor) {

    renderizarTalles(primerColor.value);

}

document
.getElementById('cantidad')
.addEventListener('input', function() {

    const max = parseInt(this.max);

    if (this.value > max) {
        this.value = max;
    }

    if (this.value < 1) {
        this.value = 1;
    }
});

</script>


</x-layout>