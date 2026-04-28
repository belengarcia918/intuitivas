<x-layout title="Comercialización - Intuitivas">

    <header class="py-2 shadow-sm text-center">
        <div class="container py-3">
            <h1 class="titulo-principal fw-bold fw-bold">Comercialización</h1>
            <p class="texto-3">Todo lo que necesitás saber para comprar fácil, rápido y seguro</p>
        </div>
    </header>

    <!-- PROCESO DE COMPRA -->
    <section class="container my-5 py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-bag-heart fs-1"></i>
                    </div>
                    <h4 class="titulo fw-bold">Elegí</h4>
                    <p class="texto-2">Navegá nuestro catálogo o visitanos en el showroom de Formosa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle circulo">
                        <i class="bi bi-credit-card fs-1"></i>
                    </div>
                    <h4 class="titulo fw-bold">Pagá</h4>
                    <p class="texto-2">Aceptamos efectivo, tarjetas y transferencias (¡consultá cuotas!).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
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

    
    <!-- CONTACTO -->
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

    <!-- CAMBIOS -->
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="text-center fw-bold mb-5 titulo">Información Útil</h3>
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