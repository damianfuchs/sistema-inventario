<?php
// conexion.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema-inventario"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>