<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasCarrito">

     @if(session('open_cart'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const carrito = document.getElementById('offcanvasCarrito');

        if (carrito) {
            const offcanvas = bootstrap.Offcanvas.getOrCreateInstance(carrito);
            offcanvas.show();
        }

    });
    </script>
    @endif

    <div class="offcanvas-header border-bottom">

        <h5 class="offcanvas-title titulo">
            <i class="bi bi-cart3 me-2"></i>
            Mi carrito
        </h5>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas">
        </button>

    </div>

    <div class="offcanvas-body">

        @php
            $carrito = app(\App\Services\CarritoService::class)->obtener();

            $items = $carrito->items()
                ->with('producto.imagenes')
                ->get();

            $total = 0;
        @endphp

        @forelse($items as $item)

            @php
                $subtotal = $item->precio * $item->cantidad;
                $total += $subtotal;

                $imagen = $item->producto->imagen_principal;

                // VARIANTE + STOCK
                $variante = $item->producto->variantes
                    ->first(function ($v) use ($item) {
                        return strtolower($v->color->nombre) === strtolower($item->color)
                            && $v->talle->nombre === $item->talle;
                    });

                $stock = $variante->stock ?? 0;

                // MENSAJE POR ITEM
                $mensajeDisponibilidad = null;

                if (!$item->producto || !$item->producto->activo) {

                    $mensajeDisponibilidad = 'Producto retirado del catálogo';

                } else {

                    if (!$variante || $stock <= 0) {
                        $mensajeDisponibilidad = 'Sin stock disponible';
                    }
                }
            @endphp

            <div class="card shadow-sm border-0 mb-3">

                <div class="card-body">

                    <div class="d-flex">

                        {{-- IMAGEN --}}
                        <div class="me-3">

                            <img
                                src="{{ $imagen
                                    ? asset('storage/' . $imagen)
                                    : asset('images/no-image.png') }}"
                                alt="{{ $item->producto->nombre }}"
                                class="rounded"
                                style="width:80px;height:80px;object-fit:cover;">

                        </div>

                        {{-- INFO --}}
                        <div class="flex-grow-1">

                            <h6 class="mb-1 texto-2-n">
                                {{ $item->producto->nombre }}
                            </h6>

                            {{-- MENSAJES POR ITEM --}}
                            @if(!$item->producto || !$item->producto->activo)

                                <div class="estado-producto-no-disponible">
                                    <i class="bi bi-eye-slash me-2"></i>
                                    Producto retirado del catálogo
                                </div>

                            @elseif(!$variante || $stock <= 0)

                                <div class="estado-producto-no-disponible">
                                    <i class="bi bi-box-seam me-2"></i>
                                    Sin stock disponible
                                </div>

                            @endif

                            <div class="small text-muted mb-2">
                                Color: {{ $item->color ?? '-' }}
                                |
                                Talle: {{ $item->talle ?? '-' }}
                            </div>

                            <div class="precio-2 small mb-2">
                                ${{ number_format($item->precio, 0, ',', '.') }}
                            </div>

                            {{-- CANTIDAD --}}
                            <form method="POST"
                                  action="{{ route('carrito.actualizar', $item->id) }}"
                                  class="d-flex align-items-center">

                                @csrf
                                @method('PATCH')

                                <input
                                    type="number"
                                    name="cantidad"
                                    value="{{ $item->cantidad }}"
                                    min="1"
                                    max="{{ $stock }}"
                                    class="form-control form-control-sm text-center me-2"
                                    style="width:70px;"
                                    @disabled($mensajeDisponibilidad)>

                                <button
                                    class="btn btn-sm boton-agregar"
                                    @disabled($mensajeDisponibilidad)>
                                    <i class="bi bi-check-lg"></i>
                                </button>

                            </form>

                        </div>

                        {{-- ELIMINAR --}}
                        <div class="ms-2">

                            <form method="POST"
                                  action="{{ route('carrito.eliminar', $item->id) }}">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm boton-eliminar">
                                    <i class="bi bi-x-lg"></i>
                                </button>

                            </form>

                        </div>

                    </div>

                    {{-- SUBTOTAL --}}
                    <div class="text-end mt-3">

                        <strong class="precio-3">
                            ${{ number_format($subtotal, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center py-5">

                <i class="bi bi-cart3 fs-1 d-block mb-3 text-muted"></i>

                <p class="mensaje-carrito mb-0">
                    El carrito está vacío
                </p>

            </div>

        @endforelse

        {{-- VALIDACIÓN CHECKOUT --}}
        @php
            $tieneProductosInvalidos = false;

            foreach ($items as $item) {

                if (!$item->producto || !$item->producto->activo) {
                    $tieneProductosInvalidos = true;
                    break;
                }

                $variante = $item->producto->variantes
                    ->first(function ($v) use ($item) {
                        return strtolower($v->color->nombre) === strtolower($item->color)
                            && $v->talle->nombre === $item->talle;
                    });

                if (!$variante || $variante->stock <= 0) {
                    $tieneProductosInvalidos = true;
                    break;
                }
            }
        @endphp

        @if($items->count())

            <div class="card shadow-sm mt-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="titulo fw-bold">
                            Total
                        </span>

                        <span class="precio-3 fw-bold">
                            ${{ number_format($total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

            </div>

            <div class="mt-3">

                @if($tieneProductosInvalidos)

                    <div class="mensaje-carrito-error mb-3">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        Debes eliminar los productos no disponibles
                        antes de continuar con la compra.

                    </div>

                @endif

                @auth

                    <a href="{{ route('checkout') }}"
                       class="btn boton-carrito w-100 mb-2 {{ $tieneProductosInvalidos ? 'disabled' : '' }}">

                        Finalizar compra

                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="btn boton-carrito w-100 mb-2">

                        Continuar con la compra

                    </a>

                @endauth

                <form method="POST"
                      action="{{ route('carrito.vaciar') }}">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn boton-peligro w-100">

                        Vaciar carrito

                    </button>

                </form>

            </div>

        @endif

    </div>

</div>

