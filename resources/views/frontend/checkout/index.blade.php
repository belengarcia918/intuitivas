<x-layout title="Finalizar compra - Intuitivas">

<div class="container py-4">

    {{-- CABECERA --}}
    <header class="mb-4">
        <h1 class="titulo-principal fw-bold mb-2">
            Finalizar compra
        </h1>

        <p class="texto-3 mb-0">
            Completá tus datos para confirmar el pedido
        </p>
    </header>

    <div class="row g-4">

        {{-- FORMULARIO --}}
        <div class="col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <h4 class="titulo mb-4">
                        Datos de envío
                    </h4>

                    <form
                        method="POST"
                        action="{{ route('checkout.finalizar') }}">

                        @csrf

                        {{-- DATOS DEL USUARIO --}}
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ auth()->user()->name }}"
                                    disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    value="{{ auth()->user()->email }}"
                                    disabled>
                            </div>

                        </div>

                        <hr>

                        {{-- ENVÍO --}}
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">
                                    Código Postal
                                </label>

                                <input
                                    type="text"
                                    name="codigo_postal"
                                    value="{{ old('codigo_postal') }}"
                                    class="form-control @error('codigo_postal') is-invalid @enderror">

                                @error('codigo_postal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-8 mb-3">
                                <label class="form-label">
                                    Calle
                                </label>

                                <input
                                    type="text"
                                    name="calle"
                                    value="{{ old('calle') }}"
                                    class="form-control @error('calle') is-invalid @enderror">

                                @error('calle')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">
                                    Número
                                </label>

                                <input
                                    type="number"
                                    name="numero"
                                    value="{{ old('numero') }}"
                                    class="form-control @error('numero') is-invalid @enderror">

                                @error('numero')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-8 mb-3">
                                <label class="form-label">
                                    Barrio
                                </label>

                                <input
                                    type="text"
                                    name="barrio"
                                    value="{{ old('barrio') }}"
                                    class="form-control @error('barrio') is-invalid @enderror">

                                @error('barrio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Ciudad
                                </label>

                                <input
                                    type="text"
                                    name="ciudad"
                                    value="{{ old('ciudad') }}"
                                    class="form-control @error('ciudad') is-invalid @enderror">

                                @error('ciudad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Provincia
                                </label>

                                <input
                                    type="text"
                                    name="provincia"
                                    value="{{ old('provincia') }}"
                                    class="form-control @error('provincia') is-invalid @enderror">

                                @error('provincia')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <hr>

                        {{-- MÉTODO DE PAGO --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold d-block mb-3">
                                Método de pago
                            </label>

                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metodo_pago"
                                    value="efectivo"
                                    {{ old('metodo_pago') == 'efectivo' ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Efectivo contra entrega
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metodo_pago"
                                    value="debito"
                                    {{ old('metodo_pago') == 'debito' ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Tarjeta de Débito
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metodo_pago"
                                    value="visa"
                                    {{ old('metodo_pago') == 'visa' ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Tarjeta de Crédito Visa
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metodo_pago"
                                    value="mastercard"
                                    {{ old('metodo_pago') == 'mastercard' ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Tarjeta de Crédito Mastercard
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metodo_pago"
                                    value="naranjax"
                                    {{ old('metodo_pago') == 'naranjax' ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Naranja X
                                </label>
                            </div>

                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metodo_pago"
                                    value="mercadopago"
                                    {{ old('metodo_pago') == 'mercadopago' ? 'checked' : '' }}>

                                <label class="form-check-label">
                                    Mercado Pago
                                </label>
                            </div>

                            @error('metodo_pago')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button
                            type="submit"
                            class="btn boton-carrito w-100">

                            <i class="bi bi-check-circle me-2"></i>
                            Confirmar compra

                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- RESUMEN --}}
        <div class="col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <h4 class="titulo mb-4">
                        Resumen del pedido
                    </h4>

                    @foreach($items as $item)

                        <div class="d-flex align-items-center mb-3">

                            <img
                                src="{{ asset('storage/' . $item['imagen']) }}"
                                alt="{{ $item['nombre'] }}"
                                class="rounded me-3"
                                style="
                                    width:70px;
                                    height:70px;
                                    object-fit:cover;
                                ">

                            <div class="flex-grow-1">

                                <div class="texto-2-n">
                                    {{ $item['nombre'] }}
                                </div>

                                <small class="text-muted">

                                    Color:
                                    {{ $item['color'] }}

                                    |

                                    Talle:
                                    {{ $item['talle'] }}

                                </small>

                                <br>

                                <small class="text-muted">

                                    Cantidad:
                                    {{ $item['cantidad'] }}

                                </small>

                            </div>

                            <div class="fw-bold">

                                ${{ number_format(
                                    $item['subtotal'],
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>

                        @if(!$loop->last)
                            <hr>
                        @endif

                    @endforeach

                    <hr>

                    <div
                        class="d-flex justify-content-between align-items-center">

                        <span class="titulo">
                            Total
                        </span>

                        <span class="precio-3">

                            ${{ number_format(
                                $total,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-layout>