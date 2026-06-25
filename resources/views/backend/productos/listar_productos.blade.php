<x-admin_layout title="Listado de Productos">

@if(session('success'))
    <div id="mensaje-success"
         data-msg="{{ session('success') }}">
    </div>
@endif

@if(session('error'))
    <div id="mensaje-error"
         data-msg="{{ session('error') }}">
    </div>
@endif

<div class="container-fluid py-4 admin-body">

    {{-- HEADER --}}
    <div class="mb-4">

        <h2 class="admin-title mb-0">
            <i class="bi bi-box-seam me-2"></i>
            Productos
        </h2>

        <small class="text-muted">
            Gestión del catálogo de productos
        </small>

    </div>

    {{-- CARD --}}
    <div class="admin-card shadow-sm">

        <div class="p-3 border-bottom">
            <strong class="admin-label">
                Listado de productos
            </strong>
        </div>

        <div class="table-responsive">

            <table class="table admin-table mb-0 align-middle">

                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th class="text-start">Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                    @forelse($productos as $producto)

                        @php
                            $stock = $producto->variantes->sum('stock') ?? 0;
                        @endphp

                        <tr>

                            <td>{{ $producto->id }}</td>

                            <td class="text-start fw-semibold">
                                {{ $producto->nombre }}
                            </td>

                            <td>
                                ${{ number_format($producto->precio ?? 0, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $stock }}
                            </td>

                            <td>
                                {{ optional($producto->categoria)->nombre ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="py-5 text-muted text-center">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No hay productos
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

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
                : '<i class="bi bi-x-circle-fill me-2"></i>')
            + mensaje;

        toast.style.position = 'fixed';
        toast.style.top = '20px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '5px';
        toast.style.zIndex = '9999';
        toast.style.fontWeight = '500';
        toast.style.boxShadow = '0 12px 24px rgba(0,0,0,.18), 0 4px 8px rgba(0,0,0,.12)';
        toast.style.backgroundColor = '#ffffff';

        if (tipo === 'success') {
            toast.style.color = '#110f11';
            toast.style.border = '2px solid #e178cf';
        } else {
            toast.style.color = '#dc3545';
            toast.style.border = '2px solid #dc3545';
        }

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = '0.5s';
        }, 2500);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});
</script>

</x-admin_layout>