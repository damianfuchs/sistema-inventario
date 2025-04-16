<!-- Agregar Productos.php -->

<?php

include_once '../db/conexion.php';
$conexion = new mysqli("localhost", "root", "", "sistema-inventario");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria'];
    
    // Imagen
    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $imagen_destino = 'img/' . $imagen_nombre;
    move_uploaded_file($imagen_tmp, $imagen_destino);

    $stmt = $conexion->prepare("INSERT INTO productos (prod_codigo, prod_nombre, prod_precio, prod_stock, prod_descripcion, prod_img, categoria_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdissi", $codigo, $nombre, $precio, $stock, $descripcion, $imagen_destino, $categoria_id);
    
    if ($stmt->execute()) {

    } else {
        echo "<script>
            alert('Error al agregar producto: " . $stmt->error . "');    
        </script>";
    }
    $stmt->close();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/agregar_productos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.png">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>


</head>



<body>


    <div class="mt-4" id="agregar_productos-lista" style="max-width: 90%; margin: 0 auto;">


        <h4 class="mt-2 px-3 py-2 text-white rounded"
            style="background-color: #343a40; margin-left: 15px; display: inline-block;">
            Agregar Productos
        </h4>


        <div class="container">
            <div class="form-container" style="margin-top: 15px;">
                <form id="" action="modulos/agregar_productos.php" method="POST" enctype="multipart/form-data">

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="codigo" class="form-label">Código</label>
                            <input style="background-color: #1e1e1e; color: white;" type="text" class="form-control"
                                id="codigo" name="codigo" required>
                        </div>
                        <div class="col-md-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input style="background-color: #1e1e1e; color: white;" type="text" class="form-control"
                                id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input style="background-color: #1e1e1e; color: white;" type="number" step="0.01"
                                class="form-control" id="precio" name="precio" required>
                        </div>
                        <div class="col-md-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input style="background-color: #1e1e1e; color: white;" type="number" step="0.01"
                                class="form-control" id="stock" name="stock" required>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea style="background-color: #1e1e1e; color: white;" class="form-control"
                                id="descripcion" name="descripcion" rows="1" required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input style="background-color: #1e1e1e; color: white;" type="file" class="form-control"
                                id="imagen" name="imagen" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select style="background-color: #1e1e1e; color: white;" class="form-select" id="categoria"
                            name="categoria" required>
                            <option value="">Seleccione una categoría</option>
                            <?php
                                $consulta = "SELECT categoria_id, categoria_nombre FROM categorias";
                                $resultado = $conexion->query($consulta);

                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $fila['categoria_id'] . "'>" . htmlspecialchars($fila['categoria_nombre']) . "</option>";
                                }
                        ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Guardar Producto</button>

                </form>
            </div>
        </div>

        <table class="table table-dark table-hover table-bordered mt-3  ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../db/conexion.php';

                $consulta = "SELECT p.prod_codigo, p.prod_nombre, p.prod_descripcion, c.categoria_nombre, p.prod_stock, p.prod_precio
                            FROM productos p
                            INNER JOIN categorias c ON p.categoria_id = c.categoria_id";
                $resultado = $conexion->query($consulta);

                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['prod_codigo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prod_nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prod_descripcion']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['categoria_nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prod_stock']) . "</td>";
                    echo "<td>$" . number_format($row['prod_precio'], 2) . "</td>";
                    echo "</tr>";
                }
                $conexion->close();
            ?>
            </tbody>
        </table>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/graficos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>