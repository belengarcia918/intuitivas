<x-admin_layout title="Listado de Productos">

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

</x-admin_layout>