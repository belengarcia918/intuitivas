<x-admin_layout title="Dashboard - Admin">

<div class="container-fluid py-4 admin-body">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="admin-title mb-0">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </h2>
            <small class="text-muted">
                Resumen general de la tienda
            </small>
        </div>

    </div>

    {{-- MÉTRICAS --}}
    <div class="row g-4 mb-4">

        {{-- Ventas hoy --}}
        <div class="col-md-3">
            <div class="admin-card p-3 shadow-sm d-flex align-items-center justify-content-between">

                <div>
                    <small class="text-muted">Ventas hoy</small>
                    <h4 class="fw-bold mb-0">$ {{ $ventasHoy }}</h4>
                    <small class="text-muted">{{ $cantidadVentasHoy }} ventas</small>
                </div>

                <div class="icon-admin bg-light">
                    <i class="bi bi-cash-stack fs-4 text-success"></i>
                </div>

            </div>
        </div>

        {{-- Ventas mes --}}
        <div class="col-md-3">
            <div class="admin-card p-3 shadow-sm d-flex align-items-center justify-content-between">

                <div>
                    <small class="text-muted">Ventas del mes</small>
                    <h4 class="fw-bold mb-0">$ {{ $ventasMes }}</h4>
                </div>

                <div class="icon-admin bg-light">
                    <i class="bi bi-bar-chart fs-4 text-primary"></i>
                </div>

            </div>
        </div>

        {{-- Ticket promedio --}}
        <div class="col-md-3">
            <div class="admin-card p-3 shadow-sm d-flex align-items-center justify-content-between">

                <div>
                    <small class="text-muted">Ticket promedio</small>
                    <h4 class="fw-bold mb-0">$ {{ number_format($ticketPromedio, 2) }}</h4>
                </div>

                <div class="icon-admin bg-light">
                    <i class="bi bi-graph-up fs-4 text-warning"></i>
                </div>

            </div>
        </div>

        {{-- Clientes --}}
        <div class="col-md-3">
            <div class="admin-card p-3 shadow-sm d-flex align-items-center justify-content-between">

                <div>
                    <small class="text-muted">Clientes</small>
                    <h4 class="fw-bold mb-0">{{ $totalClientes }}</h4>
                </div>

                <div class="icon-admin bg-light">
                    <i class="bi bi-people fs-4 text-dark"></i>
                </div>

            </div>
        </div>

    </div>

    {{-- FILA 1 --}}
    <div class="row g-4">

        {{-- ÚLTIMAS VENTAS --}}
        <div class="col-lg-6">

            <div class="admin-card shadow-sm">

                <div class="p-3 border-bottom">
                    <strong class="admin-label">
                        <i class="bi bi-receipt me-1"></i>
                        Últimas ventas
                    </strong>
                </div>

                <ul class="list-group list-group-flush">

                    @forelse($ultimasVentas as $venta)
                        <li class="list-group-item d-flex justify-content-between">

                            <span>
                                #{{ $venta->id }} - {{ $venta->usuario->name }}
                            </span>

                            <strong>$ {{ $venta->total }}</strong>

                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">
                            Sin ventas
                        </li>
                    @endforelse

                </ul>

            </div>

        </div>

        {{-- STOCK BAJO --}}
        <div class="col-lg-6">

            <div class="admin-card shadow-sm">

                <div class="p-3 border-bottom">
                    <strong class="admin-label">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Stock bajo
                    </strong>
                </div>

                <ul class="list-group list-group-flush">

                    @forelse($productosBajoStock as $producto)

                        <li class="list-group-item">

                            <strong>{{ $producto->nombre }}</strong>

                            @foreach($producto->variantes as $variante)
                                @if($variante->stock < 5)
                                    <div class="text-danger small">
                                        {{ $variante->stock }} unidades
                                    </div>
                                @endif
                            @endforeach

                        </li>

                    @empty
                        <li class="list-group-item text-muted text-center">
                            Todo en orden 👍
                        </li>
                    @endforelse

                </ul>

            </div>

        </div>

    </div>

    {{-- FILA 2 --}}
    <div class="row g-4 mt-1">

        {{-- CONTACTOS --}}
        <div class="col-lg-6">

            <div class="admin-card shadow-sm">

                <div class="p-3 border-bottom">
                    <strong class="admin-label">
                        <i class="bi bi-envelope me-1"></i>
                        Últimos contactos
                    </strong>
                </div>

                <ul class="list-group list-group-flush">

                    @forelse($ultimosContactos as $contacto)

                        <li class="list-group-item">

                            <strong>{{ $contacto->nombre }}</strong>
                            <div class="small text-muted">
                                {{ $contacto->mensaje }}
                            </div>

                        </li>

                    @empty
                        <li class="list-group-item text-muted text-center">
                            Sin mensajes
                        </li>
                    @endforelse

                </ul>

            </div>

        </div>

        {{-- TOP PRODUCTOS --}}
        <div class="col-lg-6">

            <div class="admin-card shadow-sm">

                <div class="p-3 border-bottom">
                    <strong class="admin-label">
                        <i class="bi bi-star me-1"></i>
                        Productos más vendidos
                    </strong>
                </div>

                <ul class="list-group list-group-flush">

                    @forelse($topProductos as $item)

                        <li class="list-group-item d-flex justify-content-between">

                            <span>
                                {{ $item->producto->nombre ?? 'Producto eliminado' }}
                            </span>

                            <span class="badge bg-success">
                                {{ $item->total_vendidos }}
                            </span>

                        </li>

                    @empty
                        <li class="list-group-item text-muted text-center">
                            Sin datos
                        </li>
                    @endforelse

                </ul>

            </div>

        </div>

    </div>

</div>

</x-admin_layout>