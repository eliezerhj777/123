<?php
// Configuración de las credenciales de la base de datos
$host = "localhost";
$db_name = "sistema_inventario_ventas";
$username = "root";
$password = ""; // Vacío por defecto en XAMPP

// Habilitar el reporte de errores de mysqli para usar excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Crear la conexión con MySQL usando MySQLi orientado a objetos
    $conn = new mysqli($host, $username, $password, $db_name);

    // Configurar UTF-8 para aceptar tildes y eñes
    $conn->set_charset("utf8");

    // Mensaje opcional para probar
    // echo "Conexión exitosa.";

} catch (mysqli_sql_exception $e) {
    // Mensaje seguro para el usuario
    die("Error crítico: No se pudo establecer la conexión segura con el servidor de datos.");
}
?>