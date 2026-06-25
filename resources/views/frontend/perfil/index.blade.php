<x-layout title="Mi Perfil - Intuitivas">

@if(session('success')) <div id="mensaje-success"
      data-msg="{{ session('success') }}"> </div>
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
                {{ $usuario->name }} {{ $usuario->apellido }}
            </h4>

            <p class="texto text-muted mb-3">
                Cliente
            </p>

            <hr>

            <div class="text-start">

                <p class="texto-2 mb-2">
                    <i class="bi bi-envelope me-2"></i>
                    {{ $usuario->email }}
                </p>

                <p class="texto-2 mb-2">
                    <i class="bi bi-telephone me-2"></i>
                    {{ $usuario->telefono ?? 'No registrado' }}
                </p>

                <p class="texto-2 mb-0">
                    <i class="bi bi-geo-alt me-2"></i>
                    {{ $usuario->direccion ?? 'Sin dirección' }}
                </p>

            </div>

            <hr>

            <!-- BOTONES PERFIL -->
            <div class="d-flex flex-column gap-2">

                <a href="{{ route('perfil.editar') }}" class="bbtn boton-carrito w-100">
                    <i class="bi bi-pencil me-1"></i>
                    Editar perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="boton-peligro w-100 py-2 mt-1">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </div>

    </div>

    <!-- CONTENIDO -->
    <div class="col-md-8">

        <!-- TARJETAS -->
        <div class="row g-3 mb-4">

                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bag-check fs-2 me-3"></i>
                        <div>
                            <h5 class="titulo mb-0">Mis compras</h5>
                            <small class="texto-2">
                                {{ $totalCompras ?? 0 }} pedidos realizados
                            </small>

                            @if(isset($ultimaCompra) && $ultimaCompra)
                                <small class="texto-2 d-block mt-1">
                                    Última compra: {{ $ultimaCompra->fecha_venta }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

        </div>

        <div class="card border-0 shadow-sm p-4 mb-4">
            <h5 class="titulo mb-3">
                <i class="bi bi-clock-history me-1"></i>
                Últimas compras
            </h5>

            @if(isset($ultimasCompras) && $ultimasCompras->count())
                @foreach($ultimasCompras as $compra)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <div>
                            <strong>#{{ $compra->id }}</strong>
                            <small class="d-block text-muted">
                                {{ $compra->fecha_venta }}
                            </small>
                        </div>
                        <div class="text-end">
                            <strong>${{ $compra->total }}</strong>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="texto-2">No tenés compras aún</p>
            @endif
        </div>

        <a href="{{ route('perfil.compras') }}" class="btn boton-carrito w-100">
                    <i class="bi bi-bag me-1"></i>
                    Ver compras
                </a>

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

    if (success) {
        mostrarToast(success.dataset.msg, 'success');
    }

    function mostrarToast(mensaje, tipo) {

        let toast = document.createElement('div');
        toast.innerHTML =
            '<i class="bi bi-check-circle-fill me-2"></i>' + mensaje;

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
        toast.style.color = '#b435af';

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
