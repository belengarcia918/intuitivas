<x-layout title="Quiénes Somos - Intuitivas">

    <!-- HEADER -->
    <header class="py-5 text-center">
        <div class="container">
            <h1 class="titulo-principal fw-bold">Quiénes Somos</h1>
            <p class="texto-3">Conocé nuestra historia, nuestra esencia y el equipo que hace posible cada prenda.</p>
        </div>
    </header>

    <!-- HISTORIA -->
    <section class="container my-5">
        <div class="row align-items-center g-4">

            <div class="col-md-6">
                <h2 class="titulo fw-bold">Nuestra Historia</h2>
                <p class="texto-2">
                    Somos una marca de ropa de mujer creada con la idea de resaltar la belleza, confianza y estilo de cada persona.
                    Comenzamos como un pequeño emprendimiento familiar y hoy contamos con presencia en distintos puntos de la provincia.
                </p>
                <p class="texto-2">
                    Nuestro crecimiento se basa en la dedicación, la atención personalizada y la pasión por la moda.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <div class="p-5 h-100 rounded shadow-sm">
                    <i class="bi bi-heart-fill fs-1"></i>
                    <h4 class="titulo mt-3">Moda con identidad</h4>
                    <p class="texto">Diseños pensados para mujeres reales, seguras y auténticas.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- OBJETIVOS -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="titulo fw-bold mb-4">Nuestros Objetivos</h2>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm h-100 p-4">
                        <i class="bi bi-stars fs-1 mb-2"></i>
                        <h5 class="titulo">Calidad</h5>
                        <p class="texto-2">Ofrecer prendas de excelente calidad y diseño exclusivo.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm h-100 p-4">
                        <i class="bi bi-people fs-1 mb-2"></i>
                        <h5 class="titulo">Cercanía</h5>
                        <p class="texto-2">Brindar atención personalizada a cada clienta.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm h-100 p-4">
                        <i class="bi bi-bag-heart fs-1 mb-2"></i>
                        <h5 class="titulo">Estilo</h5>
                        <p class="texto-2">Inspirar confianza a través de la moda femenina.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STAFF -->
    <section class="container my-5">
        <h2 class="text-center titulo fw-bold mb-5">Nuestro Equipo</h2>

        <div class="row g-4 text-center">

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 h-100">
                    <img src="{{ asset('images/avatar/avatar1.png') }}" class="rounded-circle avatar d-block mx-auto mb-3">
                    <h5 class="titulo">Rodrigo Ruiz Díaz</h5>
                    <p class="texto">Dueño</p>
                    <p class="texto-2">Encargado del negocio y selección de cada colección.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 h-100">
                    <img src="{{ asset('images/avatar/avatar2.png') }}" class="rounded-circle avatar d-block mx-auto mb-3">
                    <h5 class="titulo">Camila Hernández Gonzalez</h5>
                    <p class="texto">Atención al cliente</p>
                    <p class="texto-2">Te asesora en talles, estilos y disponibilidad.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 h-100">
                    <img src="{{ asset('images/avatar/avatar3.png') }}" class="rounded-circle avatar d-block mx-auto mb-3">
                    <h5 class="titulo">María Belén García</h5>
                    <p class="texto">Ventas & logística</p>
                    <p class="texto-2">Coordina envíos y entregas en toda la provincia.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- CIERRE -->
    <section class="text-center py-5">
        <div class="container">
            <h3 class="titulo fw-bold">Gracias por confiar en nosotras</h3>
            <p class="texto">Cada prenda cuenta una historia, y queremos que la próxima sea la tuya.</p>
        </div>
    </section>

</x-layout>