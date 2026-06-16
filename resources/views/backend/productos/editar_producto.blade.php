<x-layout title="Editar Producto - Panel Admin">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-3">
                <a href="{{ route('admin.productos') }}" class="text-decoration-none text-muted fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Volver al Gestor
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">

                <div class="py-3 px-4 text-white fw-bold" style="background-color:#D35400;">
                    <i class="bi bi-pencil-square me-2"></i> Editar Producto
                </div>

                <div class="p-4">

                    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- NOMBRE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Nombre</label>

                            <input type="text"
                                   name="nombre_producto"
                                   class="form-control @error('nombre_producto') is-invalid @enderror"
                                   value="{{ old('nombre_producto', $producto->nombre_producto) }}">

                            @error('nombre_producto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Descripción</label>

                            <textarea name="descripcion_producto"
                                      class="form-control @error('descripcion_producto') is-invalid @enderror"
                                      rows="3">{{ old('descripcion_producto', $producto->descripcion_producto) }}</textarea>

                            @error('descripcion_producto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- PRECIO / STOCK --}}
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-muted">Precio</label>

                                <input type="number"
                                       step="0.01"
                                       name="precio_producto"
                                       class="form-control @error('precio_producto') is-invalid @enderror"
                                       value="{{ old('precio_producto', $producto->precio_producto) }}">

                                @error('precio_producto')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-muted">Stock</label>

                                <input type="number"
                                       name="stock_producto"
                                       class="form-control @error('stock_producto') is-invalid @enderror"
                                       value="{{ old('stock_producto', $producto->stock_producto) }}">

                                @error('stock_producto')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        {{-- COLOR --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Color</label>

                            <input type="text"
                                   name="color"
                                   class="form-control @error('color') is-invalid @enderror"
                                   value="{{ old('color', $producto->color) }}"
                                   placeholder="Ej: Negro, Blanco, Azul">

                            @error('color')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- TALLE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Talle</label>

                            <select name="talle"
                                    class="form-select @error('talle') is-invalid @enderror">

                                <option value="">Seleccionar talle</option>

                                @foreach(['XS','S','M','L','XL'] as $t)
                                    <option value="{{ $t }}"
                                        {{ old('talle', $producto->talle) == $t ? 'selected' : '' }}>
                                        {{ $t }}
                                    </option>
                                @endforeach

                            </select>

                            @error('talle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- CATEGORÍA --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Categoría</label>

                            <select name="categoria_id"
                                    class="form-select @error('categoria_id') is-invalid @enderror">

                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach

                            </select>

                            @error('categoria_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMÁGENES ACTUALES --}}
                        @if($producto->imagenes->count())
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted d-block">
                                    Imágenes actuales
                                </label>

                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($producto->imagenes as $img)
                                        <img src="{{ asset('storage/' . $img->ruta) }}"
                                             style="width:100px;height:100px;object-fit:cover"
                                             class="rounded shadow-sm">
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- NUEVAS IMÁGENES --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted">
                                Agregar más imágenes
                            </label>

                            <input type="file"
                                   name="imagenes[]"
                                   multiple
                                   class="form-control @error('imagenes.*') is-invalid @enderror">

                            @error('imagenes.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex gap-2 border-top pt-3">

                            <button type="submit"
                                    class="btn text-white px-4"
                                    style="background:#1A5276;">
                                Actualizar Producto
                            </button>

                            <a href="{{ route('admin.productos') }}"
                               class="btn btn-secondary px-4">
                                Cancelar
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</x-layout>