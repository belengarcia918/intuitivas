<x-layout title="Crear Cuenta - Intuitivas">
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
            
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                
                <h3 class="text-center mb-5 titulo-principal">Crear Cuenta</h3>
                
                @if(session('success'))
                    <div id="mensaje-success" data-msg="{{ session('success') }}"></div>
                @endif

                @if(session('error'))
                    <div id="mensaje-error" data-msg="{{ session('error') }}"></div>
                @endif

                <form action="{{ url('/nueva_cuenta') }}" method="POST">
                    @csrf

                    <!-- Nombre y Apellido -->
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Tu apellido" required>
                    </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="ejemplo@mail.com" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" placeholder="Ej: 3794 123456">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-control" placeholder="Calle, número, ciudad">
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="mb-3">
                    <label class="form-label">Confirmar contraseña</label>
                    <input type="password" name="confirmar" class="form-control" placeholder="••••••••" required>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check mb-3">
                    <input class="form-check-input" name="terminos" type="checkbox" id="terminos" required>
                    <label class="form-check-label" for="terminos">
                        Acepto los términos y condiciones
                    </label>
                    </div>

                    <!-- Botón -->
                    <div class="d-grid">
                    <button type="submit" class="boton-registrar btn-lg">
                        Registrarme
                    </button>
                    </div>

                </form>

                <!-- Link login -->
                <p class="text-center mt-4 mb-0">
                    ¿Ya tenés cuenta? <a href="#" class="text-decoration-none">Iniciar sesión</a>
                </p>

                </div>
            </div>

            </div>
        </div>
    </section>
    <script>
    document.addEventListener("DOMContentLoaded", function () {

        let success = document.getElementById('mensaje-success');
        let error = document.getElementById('mensaje-error');

        if (success) {
            mostrarToast(success.dataset.msg, 'success');
        }

        if (error) {
            mostrarToast(error.dataset.msg, 'error');
        }

        function mostrarToast(mensaje, tipo) {
            let toast = document.createElement('div');
            toast.innerText = mensaje;

            toast.style.position = 'fixed';
            toast.style.top = '20px';
            toast.style.left = '50%';
            toast.style.transform = 'translateX(-50%)';
            toast.style.padding = '12px 20px';
            toast.style.color = '#fff';
            toast.style.borderRadius = '5px';
            toast.style.boxShadow = '0 8px 20px rgba(0,0,0,0.2)';
            toast.style.zIndex = '9999';
            toast.style.fontWeight = '500';

            if (tipo === 'success') {
                toast.style.backgroundColor = '#ffffff';
                toast.style.color = '#b435af';
                toast.style.border = '2px solid #c2c2c2';
            } else {
                toast.style.backgroundColor = '#ffffff';
                toast.style.color = '#d12222';
                toast.style.border = '2px solid #c2c2c2;';
            }

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = '0.5s';
            }, 2500);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    });
    </script>
</x-layout>