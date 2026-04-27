<x-layout title="Contacto">
    <h1 class="container-fluid px-3 mb-5 text-center titulo-principal">Página de contacto</h1>
    <div class="container-fluid px-3">
  <div class="row">
    
    <!-- Columna izquierda -->
    <div class="col-12 col-md-4 mb-4">
      <p class="mb-2 text-start texto">Atención teléfono en horario comercial de Lunes a Viernes. Por IG todos los días.</p>

      <div class="mb-2 text-start texto">
          <i class="fa-solid fa-phone me-2 text-dark"></i> +54 9 3704-xxxxxx
      </div>

      <div class="mb-2 text-start texto">
          <i class="fa-solid fa-envelope me-2 text-dark"></i> cintuitivas@gmail.com
      </div>

      <div class="mb-2 text-start texto">
          <i class="fa-solid fa-location-dot me-2 text-dark"></i> Av. Dr Nestor Kirchner 3600. Formosa Capital.
      </div>

    </div>

    <!-- Columna derecha (formulario) -->
    <div class="col-12 col-md-8">
      <form action="{{ url('/contacto') }}" method="POST" >
        @csrf
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu nombre completo">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="ejemplo@email.com">
        </div>

        <div class="mb-3">
          <label for="mensaje" class="form-label">Mensaje</label>
          <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Escribí tu mensaje acá..."></textarea>
        </div>

        <button type="submit" class="boton-enviar btn-lg">Enviar</button>
      </form>
    </div>

  </div>
</div>
</x-layout>