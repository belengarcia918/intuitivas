<x-layout title="Mi Panel - Intuitivas">
    <section class="container py-5">
        <h2 class="mb-4">¡Hola, {{ Auth::user()->name }}!</h2>
        <p class="text-muted">Bienvenido a tu panel de usuario de Intuitivas.</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Mis Datos</h5>
                        <hr>
                        <p class="mb-1"><strong>Nombre:</strong> {{ Auth::user()->name }} {{ Auth::user()->apellido }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p class="mb-1"><strong>Teléfono:</strong> {{ Auth::user()->telefono ?? 'No registrado' }}</p>
                        <p class="mb-0"><strong>Dirección:</strong> {{ Auth::user()->direccion ?? 'No registrada' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light border-0 shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><i class="fa-solid fa-bag-shopping"></i> Mis Pedidos</h5>
                                    <p class="text-muted small">Revisa el estado de tus últimas compras.</p>
                                </div>
                                <a href="#" class="btn btn-outline-dark w-100">Ver pedidos</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-dark text-white border-0 shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><i class="fa-solid fa-shirt"></i> Nueva Compra</h5>
                                    <p class="small">Explora nuestra nueva colección.</p>
                                </div>
                                <a href="{{ route('productos.index') }}" class="btn btn-light w-100">Ir a la tienda</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>