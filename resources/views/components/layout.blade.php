@props(['title' => 'Intuitivas'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
</head>

<body class="d-flex flex-column min-vh-100">

<x-navbar />

<main class="flex-fill">
    <div class="container mt-4 pb-5">
        {{ $slot }}
    </div>
</main>

{{-- FOOTER --}}
<x-footer />

{{-- OFFCANVAS CARRITO --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCarrito">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">🛒 Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        @php
            $carrito = session('carrito', []);
            $total = 0;
        @endphp

        @forelse($carrito as $key => $item)

            @php
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            @endphp

            <div class="d-flex gap-2 border-bottom pb-2 mb-2">

                <img src="{{ asset($item['imagen']) }}"
                     class="rounded"
                     style="width:60px;height:60px;object-fit:cover;">

                <div class="flex-grow-1">
                    <div class="fw-bold">{{ $item['nombre'] }}</div>

                    <small class="text-muted">
                        Color: {{ $item['color'] }} |
                        Talle: {{ $item['talle'] }}
                    </small>

                    <div class="small">
                        {{ $item['cantidad'] }} x ${{ number_format($item['precio'],0,',','.') }}
                    </div>
                </div>

                <form method="POST" action="{{ route('carrito.eliminar') }}">
                    @csrf
                    <input type="hidden" name="key" value="{{ $key }}">
                    <button class="btn btn-sm btn-danger">×</button>
                </form>

            </div>

        @empty
            <p class="text-center text-muted">Carrito vacío</p>
        @endforelse

        @if(count($carrito) > 0)
            <hr>

            <div class="d-flex justify-content-between fw-bold mb-3">
                <span>Total</span>
                <span>${{ number_format($total,0,',','.') }}</span>
            </div>

            @auth
                <button class="btn btn-success w-100">
                    Finalizar compra
                </button>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary w-100">
                    Iniciar sesión para comprar
                </a>
            @endauth
        @endif
    </div>
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@if(session('open_cart'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    const offcanvas = new bootstrap.Offcanvas('#offcanvasCarrito');
    offcanvas.show();
});
</script>
@endif

</body>
</html>