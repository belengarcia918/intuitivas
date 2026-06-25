<x-layout title="Editar Perfil - Intuitivas">

<section class="container py-5">

<div class="row justify-content-center">
    <div class="col-lg-6">

        <div class="card shadow border-0 rounded-4">

            <div class="card-body p-5">

                <h3 class="text-center mb-5 titulo-principal">
                    Editar Perfil
                </h3>

                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ $usuario->name }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text"
                                name="apellido"
                                class="form-control"
                                value="{{ $usuario->apellido }}">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="{{ $usuario->email }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text"
                            name="telefono"
                            class="form-control"
                            value="{{ $usuario->telefono }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text"
                            name="direccion"
                            class="form-control"
                            value="{{ $usuario->direccion }}">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="boton-registrar btn-lg">
                            Guardar cambios
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

</section>

</x-layout>
