<x-admin_layout title="Admin - Ventas">

<div class="container-fluid py-4 admin-body">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="admin-title mb-0">
                <i class="bi bi-cart-check me-2"></i>
                Listado de ventas
            </h2>
            <small class="text-muted">
                Historial de ventas realizadas
            </small>
        </div>
    </div>

    <div class="admin-card shadow-sm">

        <div class="p-3 border-bottom">
            <strong class="admin-label">
                Ventas registradas
            </strong>
        </div>

        <div class="table-responsive">

            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID Venta</th>
                        <th>Cliente</th>
                        <th>Fecha de Venta</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="text-center pe-4">Detalles</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @forelse($ventas as $venta)

                    <tr>
                        <td class="ps-4 fw-bold">{{ $venta->id }}</td>

                        <td class="fw-semibold">
                            {{ $venta->usuario->name }}
                        </td>

                        <td>
                            <small>{{ $venta->fecha_venta }}</small>
                        </td>

                        <td class="fw-bold text-success">
                            ${{ number_format($venta->total, 2) }}
                        </td>

                        <td>
                            <span class="badge bg-success-subtle text-success border">
                                Activa
                            </span>
                        </td>

                        <td class="text-center pe-4">
                            <button class="btn btn-sm btn-admin-outline"
                                data-bs-toggle="modal"
                                data-bs-target="#modalVenta{{ $venta->id }}">

                                <i class="bi bi-eye me-1"></i>
                                Ver Detalle
                            </button>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No hay ventas registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- =========================
MODALES (DETALLE DE VENTA)
========================= --}}
@foreach($ventas as $venta)
<div class="modal fade" id="modalVenta{{ $venta->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content admin-card">

            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">
                    Detalle de Venta #{{ $venta->id }}
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <p><strong>Cliente:</strong> {{ $venta->usuario->name }}</p>
                    <p><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
                    <p class="fw-bold text-success">
                        Total: ${{ number_format($venta->total, 2) }}
                    </p>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($venta->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->nombre_producto }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="fw-bold">
                                    ${{ number_format($detalle->subtotal, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="modal-footer border-top">
                <button class="btn btn-admin-outline" data-bs-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>
@endforeach

</x-admin_layout>