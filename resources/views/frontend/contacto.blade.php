<x-layout>
    <h1 class="container-fluid px-3 mb-4 titulo-alineacion-izquierda">Pagina de contacto</h1>
    <div class="container-fluid px-3">
  <div class="row">
    
    <!-- Columna izquierda -->
    <div class="col-12 col-md-4 mb-4">
      <i class="fa-solid fa-phone"></i>
      <i class="fa-solid fa-envelope"></i>
      <i class="fa-solid fa-location-dot"></i>
      <p class="texto-alineacion-izquierda">Este es un mensaje para avisar <br>que me voy a volver loca (mas de lo que ya estoy)</p>
    </div>

    <!-- Columna derecha (formulario) -->
    <div class="col-12 col-md-8">
      <form>
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" placeholder="Tu nombre completo">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="correo" placeholder="ejemplo@email.com">
        </div>

        <div class="mb-3">
          <label for="mensaje" class="form-label">Mensaje</label>
          <textarea class="form-control" id="mensaje" rows="4" placeholder="Escribí tu mensaje acá..."></textarea>
        </div>

        <button type="submit" class="boton-enviar">Enviar</button>
      </form>
    </div>

  </div>
</div>
</x-layout>