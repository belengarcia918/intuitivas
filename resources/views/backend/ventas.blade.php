<x-layout title="Listado de Ventas - Panel Admin">
    <div class="container mt-4">
        <h2>Listado de ventas</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                    <td>{{ $venta->fecha_venta->format('d/m/Y H:i') }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$venta->id}}">
                            Ver Detalle
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($ventas as $venta)
    <div class="modal fade" id="modal{{$venta->id}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de Venta #{{$venta->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Cliente: {{ $venta->usuario->name ?? 'N/A' }}</p>
                    <p>Fecha: {{ $venta->fecha_venta->format('d/m/Y H:i') }}</p>
                    <p>Total: ${{ number_format($venta->total, 2) }}</p>
                    
                    <table class="table table-sm">
                        <thead>
                            <tr><th>Producto</th><th>Cant</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @foreach($venta->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre_producto ?? 'N/A' }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>${{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-layout>