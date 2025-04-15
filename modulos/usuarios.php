<?php
// Incluir el archivo de conexión
include_once '../db/conexion.php';

// Inicializar mensaje
$mensaje = "";

// Realizar la consulta a la base de datos para mostrar los usuarios
$sql = "SELECT usuario_id, usuario_nombre, contrasena, usuario_tipo FROM usuarios";
$result = $conn->query($sql);
?>

<div class="mt-4" id="usuario-lista" style="max-width: 90%; margin: 0 auto;">
    <!-- Formulario de registro -->

    <h4 class="mb-3">Usuarios</h4>
    <table class="table table-dark table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Tipo de Usuario</th>
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
                            <td>" . $row["usuario_id"] . "</td>
                            <td>" . $row["usuario_nombre"] . "</td>
                            <td>" . $row["contrasena"] . "</td>
                            <td>" . $row["usuario_tipo"] . "</td>
                            <td>
                                <button class='btn btn-warning btn-sm' onclick='editarUsuario(" . $row["usuario_id"] . ")'>Editar</button>
                                <button class='btn btn-danger btn-sm' onclick='eliminarUsuario(" . $row["usuario_id"] . ")'>Eliminar</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No hay usuarios registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
