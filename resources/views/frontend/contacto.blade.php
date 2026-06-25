<x-layout title="Contacto - Intuitivas">
    <h1 class="container-fluid px-3 mb-5 text-center titulo-principal fw-bold">Página de contacto</h1>
    <div class="container-fluid px-3">
  <div class="row">
    @if(session('success_message'))
      <div id="mensaje-success" data-msg="{{ session('success_message') }}" data-nombre="{{ session('nombre') }}"
    data-email="{{ session('email') }}"></div>
    @endif
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
      <form action="{{ route('contacto.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text"
              name="nombre"
              class="form-control @error('nombre') is-invalid @enderror"
              value="{{ old('nombre') }}">
          @error('nombre')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Correo electrónico</label>
          <input type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">

          @error('email')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Motivo</label>
          <input type="text"
                name="motivo"
                class="form-control @error('motivo') is-invalid @enderror"
                value="{{ old('motivo') }}">

          @error('motivo')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Mensaje</label>
          <textarea
              name="consulta"
              class="form-control @error('consulta') is-invalid @enderror"
              rows="4">{{ old('consulta') }}</textarea>

          @error('consulta')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
        </div>

        <button type="submit" class="boton-enviar btn-lg">
            Enviar
        </button>

      </form>
    </div>

  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let success = document.getElementById('mensaje-success');

    if (success) {
        mostrarToast(
            success.dataset.msg,
            success.dataset.nombre,
            success.dataset.email
        );
    }

    function mostrarToast(mensaje, nombre, email) {
        let toast = document.createElement('div');

        toast.innerHTML = `
            <div class="card card-exito text-center shadow-lg border-0 p-4 animate__animated animate__zoomIn">
                <div class="mb-3">
                  <div class="check-circle">
                    <i class="bi bi-check-circle animate__animated animate__zoomIn"></i>
                </div>
                </div>

                <h2 class="mb-2 titulo-principal fw-bold">¡Éxito!</h2>

                <p class="lead mb-3 texto">
                  ${mensaje}
                </p>

                <p class="lead mb-2 texto-2">
                  Hola <strong>${nombre}</strong>, gracias por contactarte con <strong>Intuitivas</strong>.
                </p>

                <p class="mb-0 texto-2">
                  Te responderemos pronto al correo:
                  <br>
                  <strong>${email}</strong>
                </p>

                <hr>

                <p class="mb-0 texto-2">
                  <i class="bi bi-heart"></i> Estamos para ayudarte a encontrar tu estilo perfecto.
                </p>
            </div>
        `;

        toast.style.position = 'fixed';
        toast.style.top = '50%';
        toast.style.left = '50%';
        toast.style.transform = 'translate(-50%, -50%)';
        toast.style.zIndex = '9999';

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = '0.5s';
        }, 6000);

        setTimeout(() => {
            toast.remove();
        }, 6500);
    }
});
</script>
</x-layout>