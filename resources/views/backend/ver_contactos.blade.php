<x-admin_layout title="Admin - Consultas">

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
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="admin-title mb-0">
                <i class="bi bi-envelope me-2"></i>
                Consultas recibidas
            </h2>
            <small class="text-muted">
                Gestión de mensajes de contacto
            </small>
        </div>

    </div>

    {{-- CARD --}}
    <div class="admin-card shadow-sm">

        <div class="p-3 border-bottom">
            <strong class="admin-label">
                Listado de consultas
            </strong>
        </div>

        <div class="table-responsive">

            <table class="table admin-table tabla-consultas mb-0">

                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th class="text-start">Cliente</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell">Motivo</th>
                        <th>Mensaje</th>
                        <th>Estado</th>
                        <th class="text-center pe-4">Acciones</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                    @forelse($consultas as $consulta)

                        <tr class="{{ $consulta->leido ? 'bg-light text-muted' : '' }}">

                            <td class="ps-4 fw-bold">
                                {{ $consulta->id }}
                            </td>

                            <td class="text-start fw-semibold">
                                {{ $consulta->nombre }}
                            </td>

                            <td class="d-none d-md-table-cell">
                                <small>{{ $consulta->email }}</small>
                            </td>

                            <td class="d-none d-lg-table-cell">
                                <span class="badge bg-secondary-subtle text-dark">
                                    {{ $consulta->motivo }}
                                </span>
                            </td>

                            <td class="mensaje-columna">
                                <span class="mensaje-preview">
                                    {{ $consulta->consulta }}
                                </span>
                            </td>

                            <td>
                                @if($consulta->leido)
                                    <span class="admin-badge-revisada">
                                        <i class="bi bi-check2-circle me-1"></i>
                                        Leída
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border">
                                        Pendiente
                                    </span>
                                @endif
                            </td>

                            <td class="text-center pe-4">

                                <div class="d-flex flex-wrap gap-2 justify-content-center">

                                    {{-- VER MENSAJE --}}
                                    <a href="{{ route('admin.contactos.show', $consulta->id) }}"
                                    class="btn-admin">
                                        <i class="bi bi-eye"></i>
                                        Ver
                                    </a>

                                    @if(!$consulta->leido)
                                    <form ...>
                                        <button class="btn-admin-outline">
                                            Marcar leído
                                        </button>
                                    </form>
                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No hay consultas registradas
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

            <hr class="my-5">

            <div class="p-3 border-bottom">
                <strong class="admin-label">
                    Gestión de usuarios
                </strong>
            </div>

            @if(session('error'))
                <div class="alert alert-danger shadow-sm border-0">
                    {{ session('error') }}
                </div>
            @endif
            
            {{-- ================= ADMINS ================= --}}
            <div class="p-3">
                <h5 class="mb-3 text-danger fw-bold">
                    <i class="bi bi-shield-lock me-1"></i>
                    Administradores
                </h5>

                <div class="table-responsive mb-4">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($usuarios->where('rol','admin') as $user)
                                <tr>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            @php
                                                $deshabilitado =
                                                    !$user->trashed() &&
                                                    $user->rol === 'admin' &&
                                                    $cantidadAdmins <= 1;
                                            @endphp

                                            @if($user->trashed())
                                                <button type="submit" class="btn-admin-success">
                                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                                    Reactivar
                                                </button>
                                            @else
                                                <button
                                                    type="submit"
                                                    class="{{ $deshabilitado ? 'btn-admin-outline' : 'boton-peligro-2' }}"
                                                    {{ $deshabilitado ? 'disabled' : '' }}
                                                >
                                                    <i class="bi bi-person-x me-1"></i>
                                                    Desactivar
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No hay administradores
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Línea divisoria --}}
                <hr class="my-4">

                {{-- ================= CLIENTES ================= --}}
                <h5 class="mb-3 text-primary fw-bold">
                    <i class="bi bi-people me-1"></i>
                    Clientes
                </h5>

                <div class="table-responsive mb-4">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($usuarios->where('rol','cliente') as $user)
                                <tr>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            @if($user->trashed())

                                                <button type="submit" class="btn-admin-success">
                                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                                    Reactivar
                                                </button>

                                            @else

                                                <button type="submit" class="boton-peligro-2">
                                                    <i class="bi bi-person-x me-1"></i>
                                                    Desactivar
                                                </button>

                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No hay clientes
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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