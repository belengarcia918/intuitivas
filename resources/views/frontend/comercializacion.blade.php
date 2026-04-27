<x-layout title="Comercialización">

    <header class="py-2 shadow-sm text-center caja">
        <div class="container py-3 texto-blanco">
            <h1>Experiencia Intuitivas</h1>
            <p>Comprar moda nunca fue tan fácil y seguro.</p>
        </div>
    </header>

    <section class="container my-5 py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-bag-heart fs-1"></i>
                    </div>
                    <h4 class="fw-bold titulo">1. Elegí</h4>
                    <p class="text-muted">Navegá nuestro catálogo o visitanos en el showroom de Formosa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-credit-card fs-1"></i>
                    </div>
                    <h4 class="fw-bold titulo">2. Pagá</h4>
                    <p class="text-muted">Aceptamos efectivo, tarjetas y transferencias (¡consultá cuotas!).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-truck fs-1"></i>
                    </div>
                    <h4 class="fw-bold titulo">3. Recibí</h4>
                    <p class="text-muted">Envíos rápidos en Formosa y despachos a toda la provincia.</p>
                </div>
            </div>
        </div>
    </section>

   <div class="container my-5">
        <div class="card border-0 shadow text-white card-degradado">
            <div class="row g-0 align-items-center">
                
                <div class="col-md-7 col-contenido">
                    <h2 class="titulo-asesoria fw-bold mb-3">¿Necesitás asesoría?</h2>
                    <p class="texto-asesoria">
                        Escribinos por WhatsApp y te ayudamos con los talles, medidas o colores disponibles en tiempo real.
                    </p>
                    <a href="#" class="btn btn-light btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm btn-whatsapp">
                        <i class="bi bi-whatsapp me-2"></i> CONTACTAR POR WHATSAPP
                    </a>
                </div>

                <div class="col-md-5 d-none d-md-block text-center">
                    <i class="bi bi-chat-heart icono-fondo"></i>
                </div>

            </div>
        </div>
    </div>

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="text-center fw-bold mb-5 texto-2-n">Información Útil</h3>
                <div class="accordion accordion-flush shadow-sm rounded border" id="faqComercializacion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold texto-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                <i class="bi bi-geo-alt me-2 text-dark"></i> ¿Dónde retiro mi compra?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqComercializacion">
                            <div class="accordion-body texto-2">
                                Podés retirar sin cargo en nuestro showroom en Formosa Capital o coordinar envío a domicilio.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold texto-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                <i class="bi bi-arrow-left-right me-2 text-dark"></i> Política de Cambios
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqComercializacion">
                            <div class="accordion-body texto-2">
                                Tenés 15 días para realizar cambios de talle o modelo, siempre que la prenda esté en perfectas condiciones y con etiqueta.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>