<x-layout title="Mis Compras - Intuitivas">

<section class="container py-5">

    {{-- LINK PERFIL --}}
    <div class="mb-3">
        <a href="{{ route('perfil') }}" class="text-decoration-none texto-2-n">
            <i class="bi bi-arrow-left me-1"></i>
            Volver al perfil
        </a>
    </div>

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h2 class="titulo-principal">
            Mis Compras
        </h2>
        <p class="texto-3">
            Historial de todas tus compras realizadas
        </p>
    </div>

    {{-- CARD PRINCIPAL --}}
    <div class="card shadow-sm border-0">

        <div class="p-3 border-bottom">
            <strong class="texto-2-n">
                Compras registradas
            </strong>
        </div>

        <div class="table-responsive">

            <table class="table align-middle text-center table-frontend mb-0">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Detalles</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($compras as $compra)

                    <tr>

                        <td class="fw-bold">
                            #{{ $compra->id }}
                        </td>

                        <td class="texto-3">
                            <small>{{ $compra->fecha_venta }}</small>
                        </td>

                        <td class="precio-2">
                            ${{ number_format($compra->total, 2) }}
                        </td>

                        <td>
                            <span class="badge bg-success-subtle text-success border">
                                Activa
                            </span>
                        </td>

                        <td>
                            <button class="boton-ver"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCompra{{ $compra->id }}">
                                Ver detalle
                            </button>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="py-5 text-muted">
                            <i class="bi bi-bag-x fs-1 d-block mb-2"></i>
                            No tenés compras realizadas
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>


{{-- MODALES DETALLE COMPRA --}}
@foreach($compras as $compra)

<div class="modal fade" id="modalCompra{{ $compra->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow-sm" style="border-radius: 12px;">

            <div class="modal-header border-bottom">
                <h5 class="modal-title titulo">
                    Compra #{{ $compra->id }}
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <p class="texto-2">
                        <strong>Fecha:</strong> {{ $compra->fecha_venta }}
                    </p>

                    <p class="precio-3">
                        Total: ${{ number_format($compra->total, 2) }}
                    </p>
                </div>

                <hr>

                <div class="table-responsive">

                    <table class="table align-middle text-center table-frontend mb-0">

                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($compra->detalles as $detalle)

                            <tr>

                                <td class="texto">
                                    {{ $detalle->nombre_producto }}
                                </td>

                                <td class="texto-3">
                                    {{ $detalle->cantidad }}
                                </td>

                                <td class="precio-2">
                                    ${{ number_format($detalle->precio_unitario, 2) }}
                                </td>

                                <td class="precio-2 fw-bold">
                                    ${{ number_format($detalle->subtotal, 2) }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="modal-footer border-top">
                <button class="boton-editar" data-bs-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>

    </div>
</div>

@endforeach

</x-layout>