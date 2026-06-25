<x-layout title="Intuitivas - Tu estilo en Formosa">

@if(session('success')) <div id="mensaje-success" data-msg="{{ session('success') }}"></div>
@endif

@if(session('error')) <div id="mensaje-error" data-msg="{{ session('error') }}"></div>
@endif

{{-- CAROUSEL --}}

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">


<div class="carousel-indicators">
    <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"></button>

    <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"></button>

    <button type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"></button>
</div>

<div class="carousel-inner">

    <div class="carousel-item active" data-bs-interval="3000">
        <img src="{{ asset('images/carousel/moda1.jpg') }}"
             class="d-block w-100"
             alt="Percha de ropa">

        <div class="carousel-caption d-none d-md-block">
            <h5 class="titulo-carrusel">NUEVA COLECCIÓN</h5>
            <p class="subtitulo-carrusel">
                Descubrí las tendencias que llegaron a Formosa.
            </p>
        </div>
    </div>

    <div class="carousel-item" data-bs-interval="3000">
        <img src="{{ asset('images/carousel/moda2.jpg') }}"
             class="d-block w-100"
             alt="Moda femenina">

        <div class="carousel-caption d-none d-md-block">
            <h5 class="titulo-carrusel">ASESORÍA PERSONALIZADA</h5>
            <p class="subtitulo-carrusel">
                No solo vendemos ropa, potenciamos tu intuición.
            </p>
        </div>
    </div>

    <div class="carousel-item" data-bs-interval="3000">
        <img src="{{ asset('images/carousel/moda3.jpg') }}"
             class="d-block w-100"
             alt="Ropa">

        <div class="carousel-caption d-none d-md-block">
            <h5 class="titulo-carrusel">TENDENCIA 2026</h5>
            <p class="subtitulo-carrusel">
                Elegancia y comodidad para tu día a día.
            </p>
        </div>
    </div>

</div>

<button class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">

    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>

</button>

<button class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">

    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>

</button>


</div>

{{-- BIENVENIDA --}}

<section class="container seccion-bienvenida">


<div class="row justify-content-center text-center">

    <div class="col-lg-8">

        <h6 class="subtitulo-marca">
            Bienvenidos a Intuitivas
        </h6>

        <h2 class="titulo-principal">
            Sentite segura, vestí con intuición.
        </h2>

        <p class="texto-descripcion">
            Explorá nuestra selección exclusiva en Formosa Capital.
            Prendas elegidas para destacar tu esencia.
        </p>

    </div>

</div>


</section>

{{-- RECIÉN LLEGADOS --}}

<section class="container py-5">


<div class="text-center mb-5">
    <h2 class="titulo-seccion">Recién Llegados</h2>
    <hr class="separador-marca">
</div>

<div class="row justify-content-center">

    @foreach ($ultimosProductos as $producto)

        @php
            $imagen = $producto->imagenes->first();
        @endphp

        <div class="col-12 col-sm-6 col-md-3 mb-3">

            <div class="card h-100 border-0 shadow-sm producto-card">

                <a href="{{ route('productos.show', $producto->id) }}">

                    <img
                        src="{{ $imagen ? asset('storage/' . $imagen->path) : asset('images/default.png') }}"
                        class="card-img-top img-producto"
                        alt="{{ $producto->nombre }}">

                </a>

                <div class="card-body text-center">

                    <h6 class="titulo">
                        {{ $producto->nombre }}
                    </h6>

                    <p class="mb-2 precio-2">
                        <strong>
                            ${{ number_format($producto->precio, 0, ',', '.') }}
                        </strong>
                    </p>

                    <a href="{{ route('productos.show', $producto->id) }}"
                       class="boton-ver">
                        Ver producto
                    </a>

                </div>

            </div>

        </div>

    @endforeach

</div>

<div class="text-center mt-4">

    <a href="{{ url('/productos') }}" class="text-decoration-none">
        Ver todo el catálogo
    </a>

</div>


</section>

{{-- FRASE FINAL --}}

<footer class="footer-frase">

    <div class="container">

        <div class="bg-white shadow rounded p-5 text-center">

            <i class="bi bi-quote icono-quote"></i>

            <h2 class="frase-inspiracional">
                "La moda es la herramienta, tu intuición es el poder."
            </h2>

            <p class="firma-equipo mb-0">
                — Equipo Intuitivas —
            </p>

        </div>

    </div>

</footer>

{{-- CATEGORÍAS --}}

<section class="container py-5">

    <div class="text-center mb-5">
        <h2 class="titulo-seccion">Categorías</h2>
        <hr class="separador-marca">
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-3">

        @foreach ($categorias as $categoria)

            <a href="{{ route('productos.categoria', $categoria->id) }}"
               class="btn-categoria">

                {{ $categoria->nombre }}

            </a>

        @endforeach

    </div>

</section>

</x-layout>
