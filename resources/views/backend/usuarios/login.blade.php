<x-layout title="Iniciar sesión - Intuitivas">

<section class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-5">

                    <h3 class="text-center mb-5 titulo-principal">
                        Iniciar Sesión
                    </h3>

                    @if(session('success'))
                        <div id="mensaje-success" data-msg="{{ session('success') }}"></div>
                    @endif

                    @if(session('error'))
                        <div id="mensaje-error" data-msg="{{ session('error') }}"></div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="ejemplo@mail.com"
                                   value="{{ old('email') }}">

                            @error('email')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="••••••••">

                            @error('password')
                                <small class="text-danger d-block mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="boton-registrar btn-lg">
                                Ingresar
                            </button>
                        </div>

                    </form>

                    <p class="text-center mt-4 mb-0">
                        ¿No tenés cuenta?
                        <a href="{{ route('registro') }}" class="text-decoration-none">
                            Crear cuenta
                        </a>
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
        toast.style.borderRadius = '5px';
        toast.style.zIndex = '9999';
        toast.style.fontWeight = '500';
        toast.style.boxShadow = '0 8px 20px rgba(0,0,0,0.2)';
        toast.style.backgroundColor = '#ffffff';
        toast.style.border = '2px solid #c2c2c2';

        if (tipo === 'success') {
            toast.style.color = '#b435af';
        } else {
            toast.style.color = '#d12222';
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