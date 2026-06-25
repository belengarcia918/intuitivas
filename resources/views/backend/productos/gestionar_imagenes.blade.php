<x-admin_layout title="Gestionar Imágenes">

@if(session('success'))
    <div id="mensaje-success"
         data-msg="{{ session('success') }}">
    </div>
@endif

<div class="container py-5 admin-body">

    <div class="mb-4">

        <a href="{{ route('admin.productos.edit', $producto->id) }}"
           class="text-decoration-none">

            <i class="bi bi-arrow-left"></i>
            Volver al producto

        </a>

    </div>

    <div class="admin-card p-4">

        <h2 class="admin-title mb-4">

            <i class="bi bi-images"></i>

            Imágenes de:

            <span class="fw-bold">
                {{ $producto->nombre }}
            </span>

        </h2>

        {{-- AGREGAR IMÁGENES --}}
        <form
            action="{{ route('admin.productos.imagen.store', $producto->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Agregar nuevas imágenes
                </label>

                <input
                    type="file"
                    name="imagenes[]"
                    multiple
                    class="form-control admin-input
                    @if($errors->has('imagenes') || $errors->has('imagenes.*'))
                        is-invalid
                    @endif">

            </div>

            <button
                type="submit"
                class="btn btn-admin mb-4">

                <i class="bi bi-upload"></i>
                Subir imágenes

            </button>

        </form>

        <hr>

        {{-- IMÁGENES ACTUALES --}}
        <h5 class="mb-4">
            Imágenes actuales
        </h5>

        <div class="row g-4">

            @forelse($producto->imagenes as $imagen)

                <div class="col-md-3">

                    <div class="admin-imagen-card h-100">

                        <img
                            src="{{ asset('storage/' . $imagen->path) }}"
                            alt="Imagen producto"
                            class="admin-imagen-preview">

                        <form
                            action="{{ route('admin.productos.imagen.destroy', $imagen->id) }}"
                            method="POST"
                            class="mt-3">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn boton-peligro w-100"

                                <i class="bi bi-trash"></i>
                                Eliminar

                            </button>

                            @if($errors->has('imagenes'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('imagenes') }}
                                </div>
                            @endif

                        </form>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning">

                        Este producto no tiene imágenes.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let success = document.getElementById('mensaje-success');

    if(success){
        mostrarToast(success.dataset.msg);
    }

    function mostrarToast(mensaje){

        let toast = document.createElement('div');

        toast.innerHTML =
            '<i class="bi bi-check-circle-fill me-2"></i>' +
            mensaje;

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
        toast.style.color = '#110f11';
        toast.style.border = '2px solid #e178cf';

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