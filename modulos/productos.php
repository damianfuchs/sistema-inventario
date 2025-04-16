<?php
// Incluir el archivo de conexión
include_once '../db/conexion.php';

// Inicializar mensaje
$mensaje = "";

// Realizar la consulta a la base de datos para mostrar los Productos
$consulta = "SELECT p.prod_id, p.prod_codigo, p.prod_nombre, p.prod_descripcion, c.categoria_nombre, p.prod_stock, p.prod_precio
                            FROM productos p
                            INNER JOIN categorias c ON p.categoria_id = c.categoria_id";
$result = $conn->query($consulta);
?>

<link rel="stylesheet" href="./css/productos.css">

<div class="mt-4" id="producto-lista" style="max-width: 90%; margin: 0 auto;">

    <!-- Formulario de registro -->

    <h4 class="mt-2 px-3 py-2 text-white rounded"
        style="background-color: #343a40; margin-left: 0px; margin-bottom: 5px; display: inline-block;">
        Productos
    </h4>

    <div class="form-container" style="margin-top: 15px;">
        <form id="" action="modulos/agregar_productos.php#agregar_productos-lista" method="POST"
            enctype="multipart/form-data">

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                </div>
                <div class="col-md-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                </div>
                <div class="col-md-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" required>
                </div>

                <div class="col-md-1 d-flex align-items-center mt-4">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>



            </div>

        </form>
    </div>

    <table class="table table-dark table-hover table-bordered mt-4">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si se han obtenido resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["prod_codigo"] . "</td>
                            <td>" . $row["prod_nombre"] . "</td>
                            <td>" . $row["prod_descripcion"] . "</td>
                            <td>" . $row["categoria_nombre"] . "</td>
                            <td>" . $row["prod_stock"] . "</td>
                            <td>" . $row["prod_precio"] . "</td>
                            <td>
                                <button class='btn btn-warning btn-sm' onclick='editarProducto(" . $row["prod_id"] . ")'>Editar</button>
                                <a href='eliminar_producto.php?prod_id=" . $row["prod_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No hay Productos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>