<x-admin_layout title="Agregar Producto">

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

<div class="container py-5 admin-body">

    <div class="mb-3">
        <a href="{{ route('admin.productos') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="admin-card p-4 shadow-sm">

        <h3 class="admin-title mb-4">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </h3>

        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- NOMBRE --}}
            <div class="mb-3">
                <label class="admin-label">Nombre</label>

                <input type="text"
                    name="nombre"
                    placeholder="Ej: Remera oversize"
                    class="form-control admin-input @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre') }}">

                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="mb-3">
                <label class="admin-label">Descripción</label>

                <textarea name="descripcion"
                    placeholder="Descripción del producto..."
                    class="form-control admin-input @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>

                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PRECIO --}}
            <div class="mb-3">
                <label class="admin-label">Precio</label>

                <input type="number"
                    step="0.01"
                    name="precio"
                    placeholder="Ej: 15000"
                    class="form-control admin-input @error('precio') is-invalid @enderror"
                    value="{{ old('precio') }}">

                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- CATEGORÍA --}}
            <div class="mb-3">
                <label class="admin-label">Categoría</label>

                <input list="categorias"
                    name="categoria_nombre"
                    placeholder="Ej: Remeras"
                    class="form-control admin-input @error('categoria_nombre') is-invalid @enderror"
                    value="{{ old('categoria_nombre') }}">

                <datalist id="categorias">
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->nombre }}">
                    @endforeach
                </datalist>

                @error('categoria_nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Variante inicial</h5>

            <div class="row">

                {{-- COLOR (CREADO DINÁMICAMENTE) --}}
                <div class="col-md-4 mb-3">
                    <label class="admin-label">Color</label>

                    <div class="d-flex gap-2 align-items-center">

                        {{-- HEX visual --}}
                        <input type="color" name="color_hex"
                            value="{{ old('color_hex', '#000000') }}"
                            class="form-control form-control-color">

                            @error('color_hex')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            
                        {{-- INPUT REAL --}}
                        <input type="text"
                            name="color_nombre"
                            placeholder="Ej: Rojo, Negro..."
                            list="colores"
                            class="form-control admin-input @error('color_nombre') is-invalid @enderror"
                            value="{{ old('color_nombre') }}">

                        <datalist id="colores">
                            @foreach($colores as $color)
                                <option value="{{ $color->nombre }}">
                            @endforeach
                        </datalist>

                    </div>

                    @error('color_nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TALLE --}}
                <div class="col-md-4 mb-3">
                    <label class="admin-label">Talle</label>

                    <select name="talle_id"
                        class="form-control admin-input @error('talle_id') is-invalid @enderror">

                        <option value="">Seleccionar</option>

                        @foreach($talles as $talle)
                            <option value="{{ $talle->id }}"
                                {{ old('talle_id') == $talle->id ? 'selected' : '' }}>
                                {{ $talle->nombre }}
                            </option>
                        @endforeach

                    </select>

                    @error('talle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STOCK --}}
                <div class="col-md-4 mb-3">
                    <label class="admin-label">Stock</label>

                    <input type="number"
                        name="stock"
                        placeholder="Cantidad disponible"
                        class="form-control admin-input @error('stock') is-invalid @enderror"
                        value="{{ old('stock') }}">

                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            {{-- IMÁGENES --}}
            <div class="mb-3">
                <label class="admin-label">Imágenes</label>

                <input type="file"
                    name="imagenes[]"
                    multiple
                    class="form-control admin-input @error('imagenes') is-invalid @enderror">

                @if ($errors->has('imagenes'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('imagenes') }}
                    </div>
                @endif

                @foreach ($errors->get('imagenes.*') as $errores)
                    @foreach ($errores as $error)
                        <div class="invalid-feedback d-block">
                            {{ $error }}
                        </div>
                    @endforeach
                @endforeach

                <div id="preview" class="d-flex gap-2 mt-2 flex-wrap"></div>
            </div>

            {{-- BOTONES --}}
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-admin px-4">
                    <i class="bi bi-save"></i> Guardar
                </button>

                <a href="{{ route('admin.productos') }}" class="btn btn-secondary px-4">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

<script>
document.querySelector('input[name="imagenes[]"]').addEventListener('change', function(e) {

    const preview = document.getElementById('preview');
    preview.innerHTML = '';

    [...e.target.files].forEach(file => {

        const reader = new FileReader();

        reader.onload = function(ev) {
            const img = document.createElement('img');
            img.src = ev.target.result;
            img.style.height = '80px';
            img.classList.add('rounded');
            preview.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
});
</script>

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