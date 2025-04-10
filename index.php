<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-3 vh-100">
        <div class="barra-roja">
            <div class="nombrelogo">
                <a href="#">DF INVENTARIO</a>
            </div>
        </div>

        <div class="text-center mb-3">
            <img src="img/logo.png" alt="Logo" class="logo-sidebar img-fluid">
        </div>

        <hr class="text-white">

        <ul class="nav nav-pills flex-column mb-auto sidebar-menu" id="menu">
            <li><a href="index.php" class="nav-link active" id="btn-inicio"><i class="bi bi-house me-2"></i> Inicio</a>
            </li>
            <li><a href="#" class="nav-link" id="btn-productos"><i class="bi bi-archive me-2"></i> Productos </a></li>
            <li><a href="#" class="nav-link" id="btn-categorias"><i class="bi bi-receipt me-2"></i> Categorias</a></li>
            <li><a href="#" class="nav-link" id="btn-venta"><i class="bi bi-bag me-2"></i> Venta</a></li>
            <li><a href="#" class="nav-link" id="btn-recibidos"><i class="bi bi-box-arrow-in-down me-2"></i>
                    Recibidos</a></li>
            <li><a href="#" class="nav-link" id="btn-devoluciones"><i class="bi bi-arrow-counterclockwise me-2"></i>
                    Devoluciones</a></li>
        </ul>

        <hr class="text-white">
        <h6 class="text-uppercase text-white-50 fw-bold small text-center mb-2">Mantenimiento</h6>

        <ul class="nav nav-pills flex-column sidebar-menu" id="menu">
            <li><a href="#" class="nav-link" id="btn-proveedores"><i class="bi bi-truck me-2"></i> Proveedores</a></li>
            <li><a href="#" class="nav-link" id="btn-productos2"><i class="bi bi-box-seam me-2"></i> Productos</a></li>
            <li><a href="#" class="nav-link" id="btn-usuarios"><i class="bi bi-people me-2"></i> Usuarios</a></li>
            <li><a href="#" class="nav-link" id="btn-configuracion"><i class="bi bi-gear me-2"></i> Configuración</a>
            </li>
        </ul>

        <div class="derechosautor mt-auto text-center">
            <p class="mb-1">© Damian Emmanuel Fuchs</p>
            <div>
                <a href="https://www.instagram.com/damiifuchs" target="_blank" class="text-white mx-2">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.facebook.com/profile.php?id=61573726928262" target="_blank"
                    class="text-white mx-2">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://github.com/damianfuchs" target="_blank" class="text-white mx-2">
                    <i class="bi bi-github"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main p-4" style="background-color: rgb(186 190 193);">
        <div class="encabezado-custom d-flex align-items-center">
            <h2 class="mb-0">Sistema web de inventarios</h2>
            <a href="#" class="bi bi-box-arrow-right fs-2 ms-auto"></a>
        </div>

        <!-- Gráficos -->
        <div class="row mt-5 px-3" id="graficos-estadisticas"
            style="overflow-x: hidden; max-width: 80%; margin: 0 auto;">
            <div class="col-md-8 mb-4">
                <canvas id="barLineChart" style="max-width: 100%; height: auto; display: block;"></canvas>
            </div>
            <div class="col-md-4 mb-4">
                <canvas id="pieChart" style="max-width: 100%; height: auto; display: block;"></canvas>
            </div>
        </div>


        <!-- Contenido dinámico -->
        <div class="mt-4" id="contenido-dinamico" style="max-width: 90%; margin: 0 auto;"></div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/graficos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    const botones = {
        "btn-productos": "modulos/productos.php",
        "btn-categorias": "modulos/categorias.php",
        "btn-venta": "modulos/venta.php",
        "btn-recibidos": "modulos/recibidos.php",
        "btn-devoluciones": "modulos/devoluciones.php",
        "btn-proveedores": "modulos/proveedores.php",
        "btn-productos2": "modulos/productos.php",
        "btn-usuarios": "modulos/usuarios.php",
        "btn-configuracion": "modulos/configuracion.php"
    };

    Object.keys(botones).forEach(id => {
        const btn = document.getElementById(id);
        if (btn) {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                document.getElementById("dashboard-cards")?.classList.add("d-none");
                document.getElementById("graficos-estadisticas")?.classList.add("d-none");
                fetch(botones[id])
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("contenido-dinamico").innerHTML = data;
                    });
            });
        }
    });

    // El botón de inicio ahora recarga la página
    document.getElementById("btn-inicio").addEventListener("click", function(e) {
        e.preventDefault();
        location.href = "index.php";
    });
    </script>
</body>

</html>