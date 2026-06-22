<x-layout title="Compra realizada - Intuitivas">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card card-exito text-center shadow border-0 p-4 animate__animated animate__zoomIn">

                <div class="mb-3">

                    <div class="check-circle">
                        <i class="bi bi-check-circle animate__animated animate__zoomIn"></i>
                    </div>

                </div>

                <h1 class="titulo-principal fw-bold mb-3">
                    ¡Compra realizada con éxito!
                </h1>

                <p class="lead texto mb-3">
                    Tu pedido fue registrado correctamente.
                </p>

                <p class="texto-2 mb-4">

                    Gracias por comprar en
                    <strong>Intuitivas</strong>.

                </p>

                <hr>

                <div class="row text-start">

                    <div class="col-md-6 mb-3">

                        <strong>Número de pedido</strong>

                        <br>

                        #{{ $venta->id }}

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Fecha</strong>

                        <br>

                        {{ $venta->fecha_venta->format('d/m/Y H:i') }}

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Método de pago</strong>

                        <br>

                        {{ ucfirst($venta->metodo_pago) }}

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Total</strong>

                        <br>

                        ${{ number_format(
                            $venta->total,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>

                <hr>

                <h4 class="titulo mb-3">
                    Dirección de envío
                </h4>

                <p class="texto-2 mb-4">

                    {{ $venta->calle }}
                    {{ $venta->numero }}

                    <br>

                    {{ $venta->barrio }}

                    <br>

                    {{ $venta->ciudad }},
                    {{ $venta->provincia }}

                    <br>

                    CP:
                    {{ $venta->codigo_postal }}

                </p>

                <hr>

                <p class="texto-2 mb-4">

                    <i class="bi bi-truck"></i>

                    Tu pedido será preparado y enviado a la dirección indicada.

                </p>

                <p class="texto-2 mb-4">

                    <i class="bi bi-heart"></i>

                    Gracias por confiar en Intuitivas para expresar tu estilo.

                </p>

                <div class="d-flex justify-content-center gap-3 flex-wrap">

                    <a
                        href="{{ route('principal') }}"
                        class="btn boton-carrito">

                        <i class="bi bi-house me-2"></i>

                        Volver al inicio

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</x-layout>