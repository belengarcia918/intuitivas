<x-layout title="Intuitivas - Tu Estilo en Formosa">

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
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
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