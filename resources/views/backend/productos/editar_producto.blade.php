<x-admin_layout title="Editar Producto">

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

    @php
        $var = $producto->variantes->first();
    @endphp

    <div class="admin-card p-4">

        <h3 class="admin-title mb-4">
            <i class="bi bi-pencil"></i> Editar Producto
        </h3>

        <form action="{{ route('admin.productos.update', $producto->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- NOMBRE --}}
            <div class="mb-3">
                <label class="form-label">Nombre</label>

                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $producto->nombre) }}"
                       class="form-control admin-input @error('nombre') is-invalid @enderror">

                @error('nombre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="mb-3">
                <label class="form-label">Descripción</label>

                <textarea
                    name="descripcion"
                    class="form-control admin-input @error('descripcion') is-invalid @enderror"
                    rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>

                @error('descripcion')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- PRECIO --}}
            <div class="mb-3">
                <label class="form-label">Precio</label>

                <input type="number"
                       step="0.01"
                       name="precio"
                       value="{{ old('precio', $producto->precio) }}"
                       class="form-control admin-input @error('precio') is-invalid @enderror">

                @error('precio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">

                <button
                    type="button"
                    id="agregar-variante"
                    class="btn boton-secundario">

                    <i class="bi bi-plus-circle"></i>
                    Agregar variante

                </button>

            </div>

            <hr>

            <h5 class="mb-3">Variantes</h5>

            @error('variantes')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            
            <div id="variantes-container">

                @foreach($producto->variantes as $i => $variante)

                    <div class="row mb-3 variante-row">

                        <input type="hidden"
                            name="variantes[{{ $i }}][id]"
                            value="{{ $variante->id }}">

                        <div class="col-md-4">

                            <label class="form-label">
                                Color
                            </label>

                            <select
                                name="variantes[{{ $i }}][color_id]"
                                class="form-select admin-input">

                                @foreach($colores as $color)

                                    <option
                                        value="{{ $color->id }}"
                                        @selected($variante->color_id == $color->id)>

                                        {{ Str::title($color->nombre) }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                Talle
                            </label>

                            <select
                                name="variantes[{{ $i }}][talle_id]"
                                class="form-select admin-input">

                                @foreach($talles as $talle)

                                    <option
                                        value="{{ $talle->id }}"
                                        @selected($variante->talle_id == $talle->id)>

                                        {{ $talle->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                Stock
                            </label>

                            <input
                                type="number"
                                name="variantes[{{ $i }}][stock]"
                                value="{{ $variante->stock }}"
                                class="form-control admin-input">

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            @if($variante->trashed())

                                <button
                                    type="submit"
                                    form="restore-variante-{{ $variante->id }}"
                                    class="btn-admin-success w-100">

                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Reactivar

                                </button>

                            @else

                                <button
                                    type="submit"
                                    form="delete-variante-{{ $variante->id }}"
                                    class="boton-peligro-2 w-100">

                                    <i class="bi bi-person-x me-1"></i>
                                    Desactivar

                                </button>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

            <hr>

            {{-- CATEGORÍA --}}
            <div class="mb-3">
                <label class="form-label">Categoría</label>

                <select
                    name="categoria_id"
                    class="form-select admin-input @error('categoria_id') is-invalid @enderror">

                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}"
                            @selected(old('categoria_id', $producto->categoria_id) == $cat->id)>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach

                </select>

                @error('categoria_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">

                <a href="{{ route('admin.productos.imagenes', $producto->id) }}"
                class="btn boton-secundario">

                    <i class="bi bi-images"></i>
                    Gestionar imágenes

                </a>

            </div>

            <button type="submit" class="btn btn-admin">
                <i class="bi bi-save"></i>
                Guardar cambios
            </button>

        </form>

        @foreach($producto->variantes as $variante)

            @if($variante->trashed())

                <form
                    id="restore-variante-{{ $variante->id }}"
                    action="{{ route('admin.variantes.restore', $variante->id) }}"
                    method="POST">

                    @csrf

                </form>

            @else

                <form
                    id="delete-variante-{{ $variante->id }}"
                    action="{{ route('admin.variantes.destroy', $variante->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                </form>

            @endif

        @endforeach

    </div>
</div>

<script>

let indice = 0;

document
.getElementById('agregar-variante')
.addEventListener('click', function () {

    const html = `
        <div class="row mb-3 variante-row">

            <div class="col-md-4">

                <select
                    name="variantes[${indice}][color_id]"
                    class="form-select admin-input">

                    @foreach($colores as $color)
                        <option value="{{ $color->id }}">
                            {{ $color->nombre }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <select
                    name="variantes[${indice}][talle_id]"
                    class="form-select admin-input">

                    @foreach($talles as $talle)
                        <option value="{{ $talle->id }}">
                            {{ $talle->nombre }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

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

    if(e.target.classList.contains('btn-eliminar-variante')){

        e.target
            .closest('.variante-row')
            .remove();
    }
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
        toast.style.boxShadow = '0 8px 20px rgba(0,0,0,0.2)';
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