<x-layout title="Mi Perfil - Intuitivas">

@if(session('success'))
    <div id="mensaje-success"
         data-msg="{{ session('success') }}">
    </div>
@endif

<!-- HEADER -->
<header class="py-5 text-center">
    <div class="container">
        <h1 class="titulo-principal fw-bold">Mi Perfil</h1>
        <p class="texto-3">Gestioná tu información personal y revisá tu actividad en la tienda.</p>
    </div>
</header>

<div class="container my-5">

    <div class="row g-4">

        <!-- SIDEBAR PERFIL -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm p-4 text-center h-100">

                <img src="{{ Auth::user()->avatar 
                    ? asset('storage/' . Auth::user()->avatar)
                    : asset('images/avatar/avatar-usuario.png') }}"
                     class="rounded-circle mx-auto mb-3"
                     style="width:120px;height:120px;object-fit:cover;">

                <h4 class="titulo mb-1">
                    {{ Auth::user()->name }} {{ Auth::user()->apellido }}
                </h4>

                <p class="texto text-muted mb-3">
                    Cliente
                </p>

                <hr>

                <div class="text-start">

                    <p class="texto-2 mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        {{ Auth::user()->email }}
                    </p>

                    <p class="texto-2 mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        {{ Auth::user()->telefono ?? 'No registrado' }}
                    </p>

                    <p class="texto-2 mb-0">
                        <i class="bi bi-geo-alt me-2"></i>
                        {{ Auth::user()->direccion ?? 'Sin dirección' }}
                    </p>

                </div>

                <hr>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger w-100 mt-2">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </div>

        <!-- CONTENIDO -->
        <div class="col-md-8">

            <!-- TARJETAS -->
            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-bag-check fs-2 me-3"></i>
                            <div>
                                <h5 class="titulo mb-0">Mis compras</h5>
                                <small class="texto-2">Historial de pedidos realizados</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cart3 fs-2 me-3"></i>
                            <div>
                                <h5 class="titulo mb-0">Carrito activo</h5>
                                <small class="texto-2">Productos guardados actualmente</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- INFORMACIÓN EXTRA -->
            <div class="card border-0 shadow-sm p-4">

                <h5 class="titulo mb-3">
                    <i class="bi bi-info-circle me-1"></i>
                    Información de cuenta
                </h5>

                <p class="texto-2 mb-2">
                    Desde tu perfil podés revisar tus compras, actualizar tus datos y seguir el estado de tus pedidos.
                </p>

                <p class="texto-2 mb-0">
                    Si necesitas ayuda, podés contactarnos desde la sección de contacto.
                </p>

            </div>

        </div>

    </div>

</div>

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
        toast.innerHTML =
            (tipo === 'success'
                ? '<i class="bi bi-check-circle-fill me-2"></i>'
                : '<i class="bi bi-x-circle-fill me-2"></i>')
            + mensaje;

        toast.style.position = 'fixed';
        toast.style.top = '20px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '5px';
        toast.style.zIndex = '9999';
        toast.style.fontWeight = '500';
        toast.style.boxShadow = '0 12px 24px rgba(0,0,0,.18), 0 4px 8px rgba(0,0,0,.12)';
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