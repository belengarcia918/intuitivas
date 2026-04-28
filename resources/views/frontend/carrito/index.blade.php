<x-layout title="Carrito - Intuitivas">

    @php
        $total = 0;
    @endphp

    @forelse($carrito as $key => $item)

        @php
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        @endphp

        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap">

                <!-- IMAGEN -->
                <div class="me-3">
                    <img src="{{ asset($item['imagen']) }}" 
                        alt="{{ $item['nombre'] }}" 
                        class="rounded"
                        style="width: 70px; height: 70px; object-fit: cover;">
                </div>

                <!-- INFO -->
                <div class="flex-grow-1">
                    <h5 class="mb-1 texto-2-n">{{ $item['nombre'] }}</h5>

                    <p class="mb-1 small precio-2">
                        ${{ number_format($item['precio'], 0, ',', '.') }}
                    </p>

                    <p class="mb-0 small text-muted">
                        Color: {{ $item['color'] ?? '-' }} | 
                        Talle: {{ $item['talle'] ?? '-' }}
                    </p>
                </div>

                <!-- CANTIDAD -->
                <form action="{{ route('carrito.actualizar') }}" method="POST" class="d-flex align-items-center mt-2 mt-md-0">
                    @csrf
                    <input type="hidden" name="key" value="{{ $key }}">
                    
                    <input type="number" 
                        name="cantidad" 
                        value="{{ $item['cantidad'] }}" 
                        min="1" 
                        class="form-control me-2 text-center" 
                        style="width: 70px;">

                    <button class="btn btn-sm boton-agregar">
                        <i class="bi bi-check-lg"></i>
                    </button>
                </form>

                <!-- SUBTOTAL -->
                <div class="mx-3 mt-2 mt-md-0">
                    <strong>
                        ${{ number_format($subtotal, 0, ',', '.') }}
                    </strong>
                </div>

                <!-- ELIMINAR -->
                <form action="{{ route('carrito.eliminar') }}" method="POST" class="mt-2 mt-md-0">
                    @csrf
                    <input type="hidden" name="key" value="{{ $key }}">
                    
                    <button class="btn btn-sm boton-eliminar">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </form>

            </div>
        </div>

    @empty
        <p class="text-center mensaje-carrito">
            El carrito está vacío <i class="bi bi-cart3"></i>
        </p>
    @endforelse


    <!-- TOTAL -->
    @if(count($carrito) > 0)
        <div class="card mt-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold titulo">Total</h5>
                <h4 class="mb-0 fw-bold precio-3">
                    ${{ number_format($total, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    @endif

</x-layout>