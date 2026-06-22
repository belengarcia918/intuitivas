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

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="admin-card shadow-sm">

        <div class="p-3 border-bottom">
            <strong class="admin-label">
                Listado de consultas
            </strong>
        </div>

        <div class="table-responsive">

            <table class="table admin-table mb-0">

                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Motivo</th>
                        <th>Mensaje</th>
                        <th>Estado</th>
                        <th class="text-center pe-4">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($consultas as $consulta)

                        <tr class="{{ $consulta->leido ? 'bg-light text-muted' : '' }}">

                            <td class="ps-4 fw-bold">
                                {{ $consulta->id }}
                            </td>

                            <td class="fw-semibold">
                                {{ $consulta->nombre }}
                            </td>

                            <td>
                                <small>{{ $consulta->email }}</small>
                            </td>

                            <td>
                                <span class="badge bg-secondary-subtle text-dark">
                                    {{ $consulta->motivo }}
                                </span>
                            </td>

                            <td style="max-width: 300px;">
                                <span class="text-truncate d-inline-block w-100">
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

                                <div class="d-flex gap-2 justify-content-center">

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

                                            <button class="btn btn-sm btn-admin-outline"
                                                {{ $usuarios->where('rol','admin')->count() <= 1 ? 'disabled' : '' }}>
                                                
                                                <i class="bi bi-trash me-1"></i>
                                                {{ $user->trashed() ? 'Restaurar' : 'Eliminar' }}
                                            </button>
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

                <div class="table-responsive">
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

                                            <button class="boton-peligro-2">
                                                <i class="bi bi-trash me-1"></i>
                                                {{ $user->trashed() ? 'Restaurar' : 'Eliminar' }}
                                            </button>
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