<!-- LOGIN de la Pagina -->
<?php
session_start();
include 'db/conexion.php';  // Incluye la conexión con mysqli

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar usuario con mysqli
    $consulta = $conn->prepare("SELECT usuario_id, usuario_nombre, contrasena, usuario_tipo FROM usuarios WHERE usuario_nombre = ? AND contrasena = ?");
    $consulta->bind_param("ss", $usuario, $contrasena); // 'ss' indica que ambos parámetros son cadenas
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();  // Usar get_result() con mysqli

    if ($resultado) {
        // Guardar datos en sesión
        $_SESSION['usuario_id'] = $resultado['usuario_id'];
        $_SESSION['usuario_nombre'] = $resultado['usuario_nombre'];
        $_SESSION['usuario_tipo'] = $resultado['usuario_tipo'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css"> <!-- Estilos personalizados -->
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card card-transparente p-4 shadow" style="width: 400px;">
        <!-- Logo centrado y limitado -->
        <div class="text-center mb-3">
            <img src="img/logo.png" alt="Logo" class="img-fluid" style="max-width: 130px; max-height: 130px;">
        </div>



        <form method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>

            <div class="d-grid mb-2">
                <button type="submit" name="login" class="btn btn-transparente">Entrar</button>
            </div>



            <!-- Botón que abre el modal -->
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalRecuperacion">
                ¿Olvidaste tu contraseña?
            </button>
        </form>
    </div>


    <!-- Modal de recuperación -->
    <div class="modal fade" id="modalRecuperacion" tabindex="-1" aria-labelledby="modalRecuperacionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRecuperacionLabel">Recuperar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Ingresa con el Usuario y Contraseña de recuperación que se te asignó en el sistema.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <?php if (isset($error)): ?>
    <script>
    const modalError = new bootstrap.Modal(document.getElementById('modalError'));
    modalError.show();
    </script>
    <?php endif; ?>

</body>

</html>