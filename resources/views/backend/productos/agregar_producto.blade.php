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

<div class="container py-4 admin-body">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="admin-title m-0">
            <i class="bi bi-plus-circle m-2"></i> Nuevo Producto
        </h2>

    </div>

    <div class="admin-card p-4 shadow-sm mb-4">


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

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h5 class="mb-0">
                        Variantes
                    </h5>

                    <button
                        type="button"
                        id="agregar-variante"
                        class="btn boton-secundario">

                        <i class="bi bi-plus-circle"></i>
                        Agregar variante

                    </button>

                </div>

                @php
                $variantes = old('variantes', [
                    [
                        'color_nombre' => '',
                        'color_hex' => '#000000',
                        'talle_id' => '',
                        'stock' => 0,
                    ]
                ]);
                @endphp

                <div id="variantes-container">

                    @foreach($variantes as $i => $variante)

                        <div class="row mb-3 variante-row">

                            {{-- COLOR --}}
                            <div class="col-md-3">

                                <label class="admin-label">
                                    Color
                                </label>

                                <input
                                    type="text"
                                    name="variantes[{{ $i }}][color_nombre]"
                                    value="{{ $variante['color_nombre'] ?? '' }}"
                                    class="form-control admin-input
                                        @error("variantes.$i.color_nombre") is-invalid @enderror">

                                @error("variantes.$i.color_nombre")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- HEX --}}
                            <div class="col-md-2">

                                <label class="admin-label">
                                    HEX
                                </label>

                                <input
                                    type="color"
                                    name="variantes[{{ $i }}][color_hex]"
                                    value="{{ $variante['color_hex'] ?? '#000000' }}"
                                    class="form-control form-control-color">

                            </div>

                            @error("variantes.$i.color_hex")
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- TALLE --}}
                            <div class="col-md-3">

                                <label class="admin-label">
                                    Talle
                                </label>

                                <select
                                    name="variantes[{{ $i }}][talle_id]"
                                    class="form-control admin-input
                                        @error("variantes.$i.talle_id") is-invalid @enderror">

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    @foreach($talles as $talle)
                                        <option
                                            value="{{ $talle->id }}"
                                            @selected(($variante['talle_id'] ?? '') == $talle->id)>

                                            {{ $talle->nombre }}

                                        </option>
                                    @endforeach

                                </select>

                                @error("variantes.$i.talle_id")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- STOCK --}}
                            <div class="col-md-2">

                                <label class="admin-label">
                                    Stock
                                </label>

                                <input
                                    type="number"
                                    name="variantes[{{ $i }}][stock]"
                                    value="{{ $variante['stock'] ?? 0 }}"
                                    class="form-control admin-input
                                        @error("variantes.$i.stock") is-invalid @enderror">

                                @error("variantes.$i.stock")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- ELIMINAR --}}
                            <div class="col-md-2 d-flex align-items-end">

                                <button
                                    type="button"
                                    class="btn boton-peligro btn-eliminar-variante w-100">

                                    Eliminar

                                </button>

                            </div>

                        </div>

                    @endforeach

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

                <a href="{{ route('admin.productos.listado') }}" class="btn btn-secondary px-4">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

<script>

let indice = {{ count($variantes) }};

document
.getElementById('agregar-variante')
.addEventListener('click', function () {

    const ultimaFila =
        document.querySelector(
            '#variantes-container .variante-row:last-child'
        );

    const ultimoColor =
        ultimaFila.querySelector(
            'input[name*="[color_nombre]"]'
        ).value;

    const ultimoHex =
        ultimaFila.querySelector(
            'input[type="color"]'
        ).value;

    const html = `
    <div class="row mb-3 variante-row">

        <div class="col-md-3">

            <input
                type="text"
                name="variantes[${indice}][color_nombre]"
                value="${ultimoColor}"
                class="form-control admin-input">

        </div>

        <div class="col-md-2">

            <input
                type="color"
                name="variantes[${indice}][color_hex]"
                value="${ultimoHex}"
                class="form-control form-control-color">

        </div>

        <div class="col-md-3">

            <select
                name="variantes[${indice}][talle_id]"
                class="form-control admin-input">

                <option value="">
                    Seleccionar
                </option>

                @foreach($talles as $talle)
                    <option value="{{ $talle->id }}">
                        {{ $talle->nombre }}
                    </option>
                @endforeach

            </select>

        </div>

        <div class="col-md-2">

            <input
                type="number"
                name="variantes[${indice}][stock]"
                value="0"
                class="form-control admin-input">

        </div>

        <div class="col-md-2">

            <button
                type="button"
                class="btn boton-peligro btn-eliminar-variante w-100">

                Eliminar

            </button>

        </div>

    </div>
    `;

    document
        .getElementById('variantes-container')
        .insertAdjacentHTML('beforeend', html);

    indice++;
});

document.addEventListener('click', function(e){

    const boton = e.target.closest('.btn-eliminar-variante');

    if(!boton){
        return;
    }

    const filas = document.querySelectorAll('.variante-row');

    if(filas.length <= 1){

        alert('El producto debe tener al menos una variante.');

        return;
    }

    boton.closest('.variante-row').remove();

});

</script>

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
        toast.style.boxShadow = '0 12px 24px rgba(0,0,0,.18), 0 4px 8px rgba(0,0,0,.12)';
        toast.style.backgroundColor = '#fff';

        if (tipo === 'success') {
            toast.style.color = '#110f11';
            toast.style.border = '2px solid #e178cf';
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