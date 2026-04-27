<x-layout title="Intuitivas - Tu Estilo en Formosa">

    <div id="mainCarousel" class="carousel slide carousel-fade shadow" data-bs-ride="carousel" data-bs-interval="3000">
        
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 600px;">
                <img src="{{ asset('images/carousel/moda1.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Nueva Colección">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-25 py-4">
                    <h2 class="display-3 fw-bold text-uppercase" style="letter-spacing: 5px;">Nueva Colección</h2>
                    <p class="fs-4">Descubrí las tendencias que llegaron a Formosa.</p>
                </div>
            </div>

            <div class="carousel-item" style="height: 600px;">
                <img src="{{ asset('images/carousel/moda2.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Asesoría">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-25 py-4">
                    <h2 class="display-3 fw-bold text-uppercase" style="letter-spacing: 5px;">Asesoría Personalizada</h2>
                    <p class="fs-4">No solo vendemos ropa, potenciamos tu intuición.</p>
                </div>
            </div>

            <div class="carousel-item" style="height: 600px;">
                <img src="{{ asset('images/carousel/moda3.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Tendencias">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-25 py-4">
                    <h2 class="display-3 fw-bold text-uppercase" style="letter-spacing: 5px;">Tendencias 2026</h2>
                    <p class="fs-4">Elegancia y comodidad para tu día a día.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <section class="container py-5 my-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h6 class="text-uppercase fw-bold" style="color: #6a0dad; letter-spacing: 3px;">Bienvenidos a Intuitivas</h6>
                <h2 class="display-4 fw-bold mb-4" style="color: #2d054b;">Sentite segura, vestí con intuición.</h2>
                <p class="fs-5 text-muted">
                    Explorá nuestra selección exclusiva en Formosa Capital. 
                    Prendas elegidas para destacar tu esencia.
                </p>
            </div>
        </div>
    </section>

    <section class="container py-5 my-5">
        <div class="text-center mb-5">
            <h6 class="text-uppercase fw-bold" style="color: #6a0dad; letter-spacing: 3px;">Lo último de Intuitivas</h6>
            <h2 class="display-4 fw-bold" style="color: #2d054b;">Recién Llegados</h2>
            <hr class="w-25 mx-auto border-2 opacity-100" style="color: #6a0dad;">
        </div>

        <div class="row justify-content-center g-4">
            @foreach($ultimosProductos as $producto)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card h-100 border-0 shadow-sm transition-hover" style="border-radius: 15px; overflow: hidden;">
                        
                        <div style="height: 400px; overflow: hidden;">
                            <a href="{{ route('productos.show', $producto['id']) }}">
                                <img src="{{ asset($producto['imagen']) }}" 
                                     class="w-100 h-100 object-fit-cover" 
                                     alt="{{ $producto['nombre'] }}">
                            </a>
                        </div>

                        <div class="card-body text-center p-4">
                            <p class="text-uppercase mb-1 small fw-bold" style="color: #6a0dad; letter-spacing: 1px;">
                                {{ $producto['categoria'] }}
                            </p>
                            <h4 class="fw-bold mb-2" style="color: #2d054b;">{{ $producto['nombre'] }}</h4>
                            <p class="fs-5 fw-bold mb-4" style="color: #2d054b;">
                                ${{ number_format($producto['precio'], 0, ',', '.') }}
                            </p>
                            
                            <a href="{{ route('productos.show', $producto['id']) }}" 
                               class="btn btn-dark w-100 rounded-0 text-uppercase fw-bold py-2" 
                               style="background-color: #2d054b; border: none; font-size: 0.8rem; letter-spacing: 2px;">
                                Ver Producto
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/productos') }}" class="btn btn-outline-dark rounded-0 px-5 fw-bold text-uppercase" style="letter-spacing: 1px;">
                Ver todo el catálogo
            </a>
        </div>
    </section>

    <section class="py-5 my-5">
        <div class="container text-center">
            <i class="bi bi-quote display-1" style="color: #e2d1f0;"></i>
            <h2 class="fst-italic fw-light mb-4" style="color: #2d054b; font-size: 2.5rem;">
                "La moda es la herramienta, tu intuición es el poder."
            </h2>
            <p class="text-uppercase fw-bold mt-1" style="letter-spacing: 4px; color: #6a0dad;">
                — Equipo Intuitivas —
            </p>
        </div>
    </section>

</x-layout>

<style>
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-10px); }
    .object-fit-cover { object-fit: cover; }
</style>