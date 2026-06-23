<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'conexion.php';

// Verificar que se recibió un ID por la URL
if (isset($_GET['id'])) {

    $id_producto = $_GET['id'];

    try {

        // Consulta segura para eliminar
        $sql = "DELETE FROM productos WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $id_producto);

        $stmt->execute();

        $stmt->close();

        // Regresar al inventario
        header("Location: inventario.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        die("Error al eliminar el producto: " . $e->getMessage());

    }

} else {

    // Si no viene ID, regresar al inventario
    header("Location: inventario.php");
    exit();

}
?>