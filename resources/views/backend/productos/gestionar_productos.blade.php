<x-admin_layout title="Gestión de Productos">

<div class="container py-4 admin-body">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="admin-title m-0">
            <i class="bi bi-box-seam me-2"></i> Gestión de Productos
        </h2>

    </div>

    @if(session('success-message'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success-message') }}
        </div>
    @endif

    <div class="admin-card">

        <table class="table table-hover align-middle mb-0">

            <thead class="admin-table-head text-center">
                <tr>
                    <th>ID</th>
                    <th class="text-start">Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th style="width:160px;">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-center">

                @forelse($productos as $producto)

                @php
                    $stock = $producto->variantes->sum('stock') ?? 0;
                @endphp

                <tr class="{{ $producto->trashed() ? 'table-secondary opacity-75' : '' }}">

                    <td>{{ $producto->id }}</td>

                    <td class="text-start fw-semibold">
                        {{ $producto->nombre }}

                        @if($producto->trashed())
                            <span class="badge bg-secondary ms-2">Inactivo</span>
                        @endif
                    </td>

                    <td>
                        ${{ number_format($producto->precio ?? 0, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ optional($producto->categoria)->nombre ?? '-' }}
                    </td>

                    <td>
                        {{ $stock }}
                    </td>

                    <td>
                        @if($producto->trashed())

                            <span class="badge bg-danger">
                                Eliminado
                            </span>

                        @elseif($producto->activo)

                            <span class="badge bg-success">
                                Activo
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                Inactivo
                            </span>

                        @endif
                    </td>

                    <td>
                        <div class="d-flex gap-2 justify-content-center">

                            <a href="{{ route('admin.productos.edit', $producto->id) }}"
                                class="btn-admin">
                                    <i class="bi bi-pencil-square"></i>
                                    Editar
                            </a>

                            @if(!$producto->trashed())

                                @if($producto->activo)

                                    <form method="POST"
                                        action="{{ route('admin.productos.desactivar', $producto->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-warning">
                                            Inactivar
                                        </button>
                                    </form>

                                @else

                                    <form method="POST"
                                        action="{{ route('admin.productos.activar', $producto->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-success">
                                            Activar
                                        </button>
                                    </form>

                                @endif

                                <form method="POST"
                                    action="{{ route('admin.productos.destroy', $producto->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="boton-peligro-2">
                                        Eliminar
                                    </button>
                                </form>

                            @else

                                <form method="POST"
                                    action="{{ route('admin.productos.restore', $producto->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <button class="btn btn-success">
                                        Restaurar
                                    </button>
                                </form>

                            @endif

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="py-4 text-muted">
                        No hay productos cargados
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let success = document.getElementById('mensaje-success');
    let error = document.getElementById('mensaje-error');

    if (success) {
        mostrarToast(success.dataset.msg, 'success');
    }

    if (error) {
        mostrarToast(error.dataset.msg, 'error');
    }

    function mostrarToast(mensaje, tipo) {

        let toast = document.createElement('div');

        toast.innerHTML =
            (tipo === 'success'
                ? '<i class="bi bi-check-circle-fill me-2"></i>'
                : '<i class="bi bi-exclamation-triangle-fill me-2"></i>')
            + mensaje;

        toast.style.position = 'fixed';
        toast.style.top = '20px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.padding = '14px 24px';
        toast.style.borderRadius = '8px';
        toast.style.zIndex = '9999';
        toast.style.fontWeight = '600';
        toast.style.display = 'flex';
        toast.style.alignItems = 'center';
        toast.style.gap = '8px';
        toast.style.boxShadow = '0 8px 20px rgba(0,0,0,.15)';
        toast.style.backgroundColor = '#fff';

        if (tipo === 'success') {
            toast.style.color = '#5f2660';
            toast.style.border = '2px solid #9d4a9f';
        } else {
            toast.style.color = '#dc3545';
            toast.style.border = '2px solid #dc3545';
        }

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.transition = 'all .4s ease';
            toast.style.opacity = '0';
            toast.style.transform =
                'translateX(-50%) translateY(-10px)';
        }, 2500);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});
</script>

</x-admin_layout>