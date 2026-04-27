<x-layout>
    @php
    $total = 0;
    @endphp

    @forelse($carrito as $id => $item)

        @php
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        @endphp

        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between">

                <!-- IMAGEN -->
                <div class="me-3">
                    <img src="{{ asset($item['imagen']) }}" 
                        alt="{{ $item['nombre'] }}" 
                        class="rounded"
                        style="width: 70px; height: 70px; object-fit: cover;">
                </div>

                <!-- INFO -->
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{ $item['nombre'] }}</h5>
                    <p class="mb-1 text-muted small">
                        ${{ number_format($item['precio'], 0, ',', '.') }}
                    </p>
                </div>

                <!-- CANTIDAD -->
                <form action="{{ route('carrito.actualizar') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" 
                        class="form-control me-2 text-center" style="width: 70px;">
                    <button class="btn btn-dark btn-sm">✔</button>
                </form>

                <!-- SUBTOTAL -->
                <div class="mx-3">
                    <strong>
                        ${{ number_format($subtotal, 0, ',', '.') }}
                    </strong>
                </div>

                <!-- ELIMINAR -->
                <form action="{{ route('carrito.eliminar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button class="btn btn-danger btn-sm">✖</button>
                </form>

            </div>
        </div>

    @empty
        <p class="text-center mensaje-carrito">El carrito está vacío <i class="bi bi-cart3"></i></p>
    @endforelse
</x-layout>