<x-layout title="Gestión de Productos - Panel Admin">
    <div class="container py-4">

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">
                    Gestión de Productos
                </h2>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div class="d-inline-block me-2">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Buscar prenda...">
                        <button class="btn btn-sm text-white px-3" style="background-color: #1A5276;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <a href="{{ route('productos.create') }}" 
                   class="btn btn-sm text-white fw-semibold px-3"
                   style="background-color: #1A5276;">
                    <i class="bi bi-plus-lg me-1"></i> Agregar producto
                </a>
            </div>
        </div>

        @if(session('success-message'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
                {{ session('success-message') }}
            </div>
        @endif

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
                            <th style="width: 180px;">Estado</th>
                        </tr>
                    </thead>
                    
                    <!-- BODY -->
                    <tbody class="text-center">

                        @foreach($productos as $producto)
                            <tr class="{{ $producto->trashed() ? 'bg-light text-muted' : '' }}">
                                
                                <td class="fw-bold text-secondary">
                                    {{ $producto->id }}
                                </td>
                                
                                <td class="text-start fw-semibold">
                                    {{ $producto->nombre_producto }}

                                    @if($producto->trashed())
                                        <span class="badge bg-secondary ms-1">Inactivo</span>
                                    @endif
                                </td>
                                
                                <td class="fw-bold text-dark">
                                    ${{ number_format($producto->precio_producto, 2, ',', '.') }}
                                </td>
                                
                                <td>
                                    {{ $producto->stock_producto }}
                                </td>
                                
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
                                
                                <!-- ACCIONES -->
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        
                                        <a href="{{ route('productos.edit', $producto->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        @if(!$producto->trashed())
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('productos.restore', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Activar
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-layout>