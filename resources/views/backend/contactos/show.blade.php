<x-admin_layout title="Consulta #{{ $consulta->id }}">

<div class="container py-4 admin-body">

    <div class="admin-card p-4">

        <h4 class="admin-title mb-3">
            {{ $consulta->nombre }}
        </h4>

        <p class="mb-1 admin-label">
            <i class="bi bi-envelope me-1"></i>
            {{ $consulta->email }}
        </p>

        <p class="mb-3 admin-label">
            <i class="bi bi-tag me-1"></i>
            {{ $consulta->motivo }}
        </p>

        <hr>

        <h5 class="admin-label mb-3">
            <i class="bi bi-chat-text me-1"></i>
            Mensaje
        </h5>

        <div class="p-3 rounded"
             style="background: #f8f9fa; border: 1px solid var(--admin-border);">

            <p class="mb-0" style="font-family: 'Trebuchet MS', sans-serif;">
                {{ $consulta->consulta }}
            </p>

        </div>

        <hr>

        <div class="d-flex justify-content-end">

            <a href="{{ route('admin.contactos.index') }}"
               class="btn-admin-outline">
                <i class="bi bi-arrow-left me-1"></i>
                Volver
            </a>

        </div>

    </div>

</div>

</x-admin_layout>