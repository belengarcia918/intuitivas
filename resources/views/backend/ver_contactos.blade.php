<x-layout title="Administración - Ver Consultas">
    <div class="container mt-5">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="mb-4 titulo-principal text-start fw-bold">Listado de consultas</h1>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3" style="width: 8%">ID</th>
                                <th class="py-3" style="width: 15%">Cliente</th>
                                <th class="py-3" style="width: 20%">Correo</th>
                                <th class="py-3" style="width: 15%">Motivo</th>
                                <th class="py-3" style="width: 25%">Mensaje</th>
                                <th class="py-3" style="width: 10%">Estado</th>
                                <th class="text-center py-3" style="width: 12%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($consultas as $consulta)
                                <tr class="{{ $consulta->leido ? 'text-muted bg-light' : '' }}">
                                    <td class="px-4 fw-bold">{{ $consulta->id }}</td>
                                    <td>{{ $consulta->nombre }}</td>
                                    <td>{{ $consulta->email }}</td>
                                    <td><span class="badge bg-secondary text-wrap">{{ $consulta->motivo }}</span></td>
                                    <td><p class="mb-0 text-truncate" style="max-width: 250px;" title="{{ $consulta->consulta }}">{{ $consulta->consulta }}</p></td>
                                    <td>
                                        @if($consulta->leido)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Leída</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">Pendiente</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!$consulta->leido)
                                            <form action="{{ route('admin.consultas.leer', $consulta->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-dark shadow-sm px-3">
                                                    <i class="bi bi-eye-fill me-1"></i> Leer
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-light text-muted px-3" disabled><i class="bi bi-check2-all"></i> Revisada</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-5 text-muted"><i class="bi bi-chat-left-dots fs-2 d-block mb-2"></i>No hay consultas registradas.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>