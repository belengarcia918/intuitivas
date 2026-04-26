<x-layout title="Inicio - Mi Proyecto">
    <div class="row align-items-center g-5 py-5">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Esta es la parte del medio</h1>
            <p class="lead">Aquí es donde desarrollas tu parte del proyecto usando clases de Bootstrap. Todo esto aparecerá automáticamente entre el Navbar y el Footer de tu compañera.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Botón Principal</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Saber más</button>
            </div>
        </div>
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="https://getbootstrap.com/docs/5.3/examples/heroes/bootstrap-themes.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
    </div>

    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="col">
            <h2>Sección 1</h2>
            <p>Puedes usar el sistema de rejilla para organizar columnas.</p>
        </div>
        <div class="col">
            <h2>Sección 2</h2>
            <p>Bootstrap se encarga de que esto se vea bien en celulares.</p>
        </div>
        <div class="col">
            <h2>Sección 3</h2>
            <p>Laravel inyecta esto directamente en el $slot del layout.</p>
        </div>
    </div>
    </x-layout>