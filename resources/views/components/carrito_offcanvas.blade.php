<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasCarrito">

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
                                style="
                                    width:80px;
                                    height:80px;
                                    object-fit:cover;
                                ">

                        </div>

                        {{-- INFO --}}
                        <div class="flex-grow-1">

                            <h6 class="mb-1 texto-2-n">
                                {{ $item->producto->nombre }}
                            </h6>

                            <div class="small text-muted mb-2">

                                Color:
                                {{ $item->color ?? '-' }}

                                |

                                Talle:
                                {{ $item->talle ?? '-' }}

                            </div>

                            <div class="precio-2 small mb-2">

                                ${{ number_format(
                                    $item->precio,
                                    0,
                                    ',',
                                    '.'
                                ) }}

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
                                    class="form-control form-control-sm text-center me-2"
                                    style="width:70px;">

                                <button class="btn btn-sm boton-agregar">
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

                                <button
                                    class="btn btn-sm boton-eliminar">

                                    <i class="bi bi-x-lg"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                    {{-- SUBTOTAL --}}
                    <div class="text-end mt-3">

                        <strong class="precio-3">

                            ${{ number_format(
                                $subtotal,
                                0,
                                ',',
                                '.'
                            ) }}

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

        @if($items->count())

            <div class="card shadow-sm mt-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="titulo fw-bold">
                            Total
                        </span>

                        <span class="precio-3 fw-bold">

                            ${{ number_format(
                                $total,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

            <div class="mt-3">

                @auth

                    <a href="{{ route('checkout') }}"
                    class="btn boton-carrito w-100 mb-2">

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

                    <button
                        type="submit"
                        class="btn boton-peligro w-100">

                        Vaciar carrito

                    </button>

                </form>

            </div>

        @endif

    </div>

</div>


@if(session('open_cart'))
<script>
document.addEventListener('DOMContentLoaded', () => {

    const carrito = document.getElementById(
        'offcanvasCarrito'
    );

    if (carrito) {

        const offcanvas =
            new bootstrap.Offcanvas(carrito);

        offcanvas.show();
    }
});
</script>
@endif