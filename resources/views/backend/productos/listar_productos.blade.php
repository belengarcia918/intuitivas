<x-layout title="Listado de Productos - Panel Admin">
    <div class="container py-4">

        <!-- ENCABEZADO -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">
                    Productos
                </h2>
            </div>

            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <form action="{{ route('ver_productos') }}" method="GET" class="d-inline-block">
                    <div class="input-group">
                        <input type="text" 
                               name="buscar" 
                               class="form-control form-control-sm rounded-start" 
                               placeholder="Buscar producto..." 
                               value="{{ request('buscar') }}">

                        <button class="btn btn-sm text-white px-3" type="submit" style="background-color: #1A5276;">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('buscar'))
                            <a href="{{ route('ver_productos') }}" class="btn btn-sm btn-secondary">
                                Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLA -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    
                    <!-- HEADER -->
                    <thead class="text-white text-center" style="background-color: #0B1B3D;">
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th class="text-start">Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Color</th> 
                            <th>Talle</th> 
                        </tr>
                    </thead>
                    
                    <!-- BODY -->
                    <tbody class="text-center">

                        @forelse($productos as $producto)
                            <tr class="{{ $producto->trashed() ? 'bg-light text-muted opacity-75' : '' }}">
                                
                                <!-- ID -->
                                <td class="fw-bold text-secondary">
                                    {{ $producto->id }}
                                </td>
                                
                                <!-- NOMBRE -->
                                <td class="text-start fw-semibold">
                                    {{ $producto->nombre_producto }}
                                    @if($producto->trashed())
                                        <span class="badge bg-secondary ms-1" style="font-size: 0.7rem;">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- PRECIO -->
                                <td class="fw-bold text-dark">
                                    ${{ number_format($producto->precio_producto, 2, ',', '.') }}
                                </td>
                                
                                <!-- STOCK -->
                                <td>
                                    <span class="badge {{ $producto->stock_producto > 0 ? 'bg-light text-dark border' : 'bg-danger-subtle text-danger' }}">
                                        {{ $producto->stock_producto }} u.
                                    </span>
                                </td>
                                
                                <!-- CATEGORÍA -->
                                <td>
                                    {{ $producto->categoria ? $producto->categoria->nombre : 'Sin categoría' }}
                                </td>

                                <!-- COLOR -->
                                <td>
                                    <span class="badge bg-info-subtle text-dark">
                                        {{ $producto->color ?? '-' }}
                                    </span>
                                </td>

                                <!-- TALLE -->
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $producto->talle ?? '-' }}
                                    </span>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-muted">
                                    <i class="bi bi-info-circle me-1"></i> No hay productos para mostrar.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-layout>