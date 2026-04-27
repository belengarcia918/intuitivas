<x-layout>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
            
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                
                <h3 class="text-center mb-5 titulo-principal">Crear Cuenta</h3>
                
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
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
</x-layout>