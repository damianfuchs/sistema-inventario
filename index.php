<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Evitar caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.png">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>


</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-3 vh-100">

        <div class="text-center mb-3">
            <img src="img/logo.png" alt="Logo" class="logo-sidebar img-fluid;">
        </div>

        <hr class="text-white">

        <ul class="nav nav-pills flex-column mb-auto sidebar-menu" id="menu-principal">
            <!-- Inicio -->
            <li style="padding: 3px;">
                <a href="index.php" class="nav-link active" id="btn-inicio">
                    <i class="bi bi-house me-2"></i> INICIO
                </a>
            </li>

            <!-- Productos con submenú -->
            <li style="padding: 3px;">
                <a href="#submenu-productos" data-bs-toggle="collapse" class="nav-link">
                    <i class="bi bi-archive me-2"></i> PRODUCTOS
                </a>
                <ul class="collapse ps-2" id="submenu-productos" data-bs-parent="#menu-principal">
                    <li style="padding: 3px;" id="btn-productos">
                        <a href="#" class="nav-link">Ver Productos</a>
                    </li>
                    <li style="padding: 3px; font-size: 15px;" id="btn-agregarproductos">
                        <a href="#" class="nav-link">Agregar Producto</a>
                    </li>
                </ul>
            </li>

            <!-- Categorías con submenú -->
            <li style="padding: 3px;">
                <a href="#submenu-categorias" data-bs-toggle="collapse" class="nav-link">
                    <i class="bi bi-receipt me-2"></i> CATEGORIAS
                </a>
                <ul class="collapse ps-2" id="submenu-categorias" data-bs-parent="#menu-principal">
                    <li style="padding: 3px; font-size: 15px;">
                        <a href="#" class="nav-link">Ver Categorías</a>
                    </li>
                    <li style="padding: 3px; font-size: 15px;">
                        <a href="#" class="nav-link">Agregar Categoría</a>
                    </li>
                </ul>
            </li>

            <!-- Ventas con submenú -->
            <li style="padding: 3px;">
                <a href="#submenu-ventas" data-bs-toggle="collapse" class="nav-link">
                    <i class="bi bi-cart me-2"></i> VENTAS
                </a>
                <ul class="collapse ps-2" id="submenu-ventas" data-bs-parent="#menu-principal">
                    <li style="padding: 3px; font-size: 15px;">
                        <a href="#" class="nav-link">Ver Ventas</a>
                    </li>
                    <li style="padding: 3px; font-size: 15px;">
                        <a href="#" class="nav-link">Nueva Venta</a>
                    </li>
                </ul>
            </li>

            <!-- Proveedores con submenú -->
            <li style="padding: 3px;">
                <a href="#submenu-proveedores" data-bs-toggle="collapse" class="nav-link">
                    <i class="bi bi-file-earmark-person"></i> PROVEEDORES
                </a>
                <ul class="collapse ps-2" id="submenu-proveedores" data-bs-parent="#menu-principal">
                    <li style="padding: 3px; font-size: 15px;">
                        <a href="#" class="nav-link">Ver Proveedores</a>
                    </li>
                    <li style="padding: 3px; font-size: 15px;">
                        <a href="#" class="nav-link">Nuevo Proveedor</a>
                    </li>
                </ul>
            </li>
        </ul>



        <hr class="text-white">
        <h6 class="text-uppercase text-white-50 fw-bold small text-center mb-2">Mantenimiento</h6>

        <ul class="nav nav-pills flex-column sidebar-menu" id="menu">
            <li style="padding: 3px;"><a href="#" class="nav-link" id="btn-configuracion"><i
                        class="bi bi-gear me-2"></i> Configuración</a></li>
            <li style="padding: 3px;"><a href="#" class="nav-link" id="btn-usuarios"><i class="bi bi-people me-2"></i>
                    Usuarios</a></li>
        </ul>
        <hr class="text-white">

        <div class="derechosautor mt-auto text-start ms-4">

            <p class="mb-1">© Damian Emmanuel Fuchs</p>
            <div class="mt-auto ms-4">
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
    <div class="main p-4" style="background-color: rgb(186 190 193);" id>


        <div class="encabezado-custom position-relative text-center" style=" border-radius: 6px;">
            <h2 class="mb-0">DF Inventario</h2>
            <a href="controladores/logout.php"
                class="bi bi-box-arrow-right fs-2 position-absolute end-0 top-50 translate-middle-y me-3" style="color: white;"></a>
        </div>

        <!-- Gráficos -->




        <!-- ACA VAN LOS GRAFICOS DE INICIO -->
        <!-- ACA VAN LOS GRAFICOS DE INICIO -->
        <!-- ACA VAN LOS GRAFICOS DE INICIO -->




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
        "btn-usuarios": "modulos/usuarios.php",
        "btn-agregarproductos": "modulos/agregar_productos.php",
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