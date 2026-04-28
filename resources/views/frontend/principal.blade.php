<x-layout title="Intuitivas - Tu estilo en Formosa">

    @if(session('success'))
        <div id="mensaje-success" data-msg="{{ session('success') }}"></div>
    @endif

    @if(session('error'))
        <div id="mensaje-error" data-msg="{{ session('error') }}"></div>
    @endif
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="{{asset('images/carousel/moda1.jpg')}}" class="d-block w-100" alt="Percha de Ropa">
      <div class="carousel-caption d-none d-md-block">
        <h5>NUEVA COLECCION</h5>
        <p>Descubri las tendencia que llegaron a Formosa.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="{{asset('images/carousel/moda2.jpg')}}" class="d-block w-100" alt="Percha de Ropa">
      <div class="carousel-caption d-none d-md-block">
        <h5>Asesoria Personalizada</h5>
        <p>No solo vendemos ropa,potenciamos tu intuicion.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="{{asset('images/carousel/moda3.jpg')}}" class="d-block w-100" alt="Ropa">
      <div class="carousel-caption d-none d-md-block">
        <h5>TENDENCIA 2026</h5>
        <p>Elegancia y comodidad para tu dia a dia.</p>
      </div>
    </div>
  </div>
  
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <section class="container seccion-bienvenida">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="fw-bold titulo-principal">Bienvenidos a Intuitivas</h1>
                <h2 class="texto-3">Sentite segura, vestí con intuición.</h2>
                <p class="texto">
                    Explorá nuestra selección exclusiva en Formosa Capital. 
                    Prendas elegidas para destacar tu esencia.
                </p>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="text-center mb-5">
            <h3 class="fw-bold titulo">Recién Llegados</h3>
            <hr class="separador-marca">
        </div>

        <div class="row justify-content-center">
            @foreach ($ultimosProductos as $producto)
                <div class="col-12 col-sm-6 col-md-3 mb-3">
                    <div class="card h-100 shadow card-producto">
                        <a href="{{ route('productos.show', $producto['id']) }}">
                            <img src="{{ asset($producto['imagenes'][0] ?? $producto['imagen']) }}" class="card-img-top img-producto">
                        </a>

                        <div class="card-body text-center">
                            <h6 class="titulo">{{ $producto["nombre"] }}</h6>
                            <p class="mb-2 precio-2"><strong>${{ number_format($producto["precio"], 0, ',', '.') }}</strong></p>

                            <a href="{{ route('productos.show', $producto['id']) }}" class="boton-ver">
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

    <footer class="footer-frase shadow">
        <div class="container text-center">
            <i class="bi bi-quote icono-quote"></i>
            <h2 class="frase-inspiracional">
                "La moda es la herramienta, tu intuición es el poder."
            </h2>
            <p class="firma-equipo">— Equipo Intuitivas —</p>
        </div>
    </footer>

    <!-- PROCESO DE COMPRA -->
    <section class="container my-5 py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-bag-heart fs-1"></i>
                    </div>
                    <h4 class="titulo fw-bold">Elegí</h4>
                    <p class="texto-2">Navegá nuestro catálogo o visitanos en el showroom de Formosa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-credit-card fs-1"></i>
                    </div>
                    <h4 class="titulo fw-bold">Pagá</h4>
                    <p class="texto-2">Aceptamos efectivo, tarjetas y transferencias (¡consultá cuotas!).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-truck fs-1"></i>
                    </div>
                    <h4 class="titulo fw-bold">Recibí</h4>
                    <p class="texto-2">Envíos rápidos en Formosa y despachos a toda la provincia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ENVÍOS Y PAGOS -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-6">
                    <div class="p-4 bg-white shadow-sm rounded h-100">
                        <h4 class="fw-bold mb-3 titulo"><i class="bi bi-truck me-2 text-dark"></i> Envíos</h4>
                        <ul class="mb-0">
                            <li>Envíos a domicilio en Formosa capital (24/72 hs)</li>
                            <li>Envíos al interior mediante correo</li>
                            <li>Retiro gratuito en showroom</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 bg-white shadow-sm rounded h-100">
                        <h4 class="fw-bold mb-3 titulo"><i class="bi bi-cash-coin me-2 text-dark"></i> Medios de pago</h4>
                        <ul class="mb-0">
                            <li>Efectivo</li>
                            <li>Tarjetas de débito y crédito</li>
                            <li>Transferencia bancaria</li>
                            <li>Mercado Pago</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="container my-5 text-center">

        <h2 class="fw-bold titulo mb-4">Categorías</h2>

        <div class="d-flex flex-wrap justify-content-center gap-3">

            <a href="{{ route('productos.categoria', 'sweater') }}" class="btn-categoria">Sweater</a>
            <a href="{{ route('productos.categoria', 'blazer') }}" class="btn-categoria">Blazer</a>
            <a href="{{ route('productos.categoria', 'pantalones') }}" class="btn-categoria">Pantalones</a>
            <a href="{{ route('productos.categoria', 'camisa') }}" class="btn-categoria">Camisa</a>

        </div>

    </section>

</x-layout>