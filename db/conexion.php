<?php
$host = 'localhost';
$dbname = 'sistema-inventario';
$usuario = 'root';
$contrasena = ''; // O la contraseña que tengas

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
