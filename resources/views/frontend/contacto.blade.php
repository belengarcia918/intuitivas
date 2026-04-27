<x-layout title="Contacto - Intuitivas Formosa">

    <header class="py-5 text-center" style="background-color: #f8f4ff;">
        <div class="container">
            <h1 class="display-4 fw-bold text-uppercase" style="color: #2d054b; letter-spacing: 5px;">Contacto</h1>
            <hr class="w-25 mx-auto border-2 opacity-100" style="color: #6a0dad;">
            <p class="text-muted fs-5">Estamos para asesorarte y responder todas tus dudas.</p>
        </div>
    </header>

    <div class="container py-5 mb-5">
        <div class="row g-5">
            
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-3 shadow-sm h-100" style="background-color: #2d054b; color: white;">
                    <h3 class="fw-bold mb-4 border-bottom border-white border-opacity-25 pb-2 text-uppercase" style="letter-spacing: 2px;">Información</h3>
                    
                    <div class="mb-4 d-flex align-items-start">
                        <i class="fa-solid fa-phone fs-5 me-3 mt-1" style="color: #e2d1f0;"></i>
                        <div>
                            <p class="mb-0 small opacity-75 text-uppercase fw-bold" style="letter-spacing: 1px;">Llamanos</p>
                            <p class="mb-0 fs-5">+54 9 3704-xxxxxx</p>
                        </div>
                    </div>

                    <div class="mb-4 d-flex align-items-start">
                        <i class="fa-solid fa-envelope fs-5 me-3 mt-1" style="color: #e2d1f0;"></i>
                        <div>
                            <p class="mb-0 small opacity-75 text-uppercase fw-bold" style="letter-spacing: 1px;">Escribinos</p>
                            <p class="mb-0 fs-5">cintuitivas@gmail.com</p>
                        </div>
                    </div>

                    <div class="mb-4 d-flex align-items-start">
                        <i class="fa-solid fa-location-dot fs-5 me-3 mt-1" style="color: #e2d1f0;"></i>
                        <div>
                            <p class="mb-0 small opacity-75 text-uppercase fw-bold" style="letter-spacing: 1px;">Visitanos</p>
                            <p class="mb-0 fs-5">Av. Dr Nestor Kirchner 3600.<br>Formosa Capital.</p>
                        </div>
                    </div>

                    <div class="mt-5 p-3 rounded bg-white bg-opacity-10 text-center">
                        <p class="fst-italic mb-0 small">"Potenciamos tu intuición para resaltar tu mejor versión."</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="bg-white p-4 p-md-5 shadow-sm rounded-3 border">
                    <h3 class="fw-bold mb-4" style="color: #2d054b; letter-spacing: 1px;">Envianos un mensaje</h3>
                    
                    <form action="{{ url('/contacto') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nombre" class="form-label fw-bold small text-uppercase text-muted" style="letter-spacing: 1px;">Nombre Completo</label>
                                <input type="text" name="nombre" class="form-control form-control-lg rounded-0 shadow-none" id="nombre" placeholder="Tu nombre" style="border-color: #e2d1f0; font-size: 0.95rem;">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label fw-bold small text-uppercase text-muted" style="letter-spacing: 1px;">Correo electrónico</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-0 shadow-none" id="email" placeholder="ejemplo@email.com" style="border-color: #e2d1f0; font-size: 0.95rem;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="mensaje" class="form-label fw-bold small text-uppercase text-muted" style="letter-spacing: 1px;">Tu consulta</label>
                            <textarea class="form-control rounded-0 shadow-none" name="mensaje" id="mensaje" rows="5" placeholder="¿En qué podemos ayudarte?" style="border-color: #e2d1f0; font-size: 0.95rem;"></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark btn-lg px-5 rounded-0 fw-bold text-uppercase" style="background-color: #2d054b; border: none; letter-spacing: 2px; font-size: 0.9rem;">
                                Enviar Mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>