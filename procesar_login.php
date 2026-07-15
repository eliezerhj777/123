<?php
// 1. Iniciar sesión
session_start();

// 2. Conexión a la base de datos
require_once 'conexion.php';

// 3. Verificar que venga desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener datos
    $user = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    try {

        // 4. Consulta preparada
        $sql = "SELECT id, nombre_completo, password, rol FROM usuarios WHERE usuario = ?";

        // 5. Preparar sentencia
        $stmt = $conn->prepare($sql);

        // 6. Vincular parámetro
        $stmt->bind_param("s", $user);

        // 7. Ejecutar
        $stmt->execute();

        // Obtener resultado
        $result = $stmt->get_result();

        // 8. Verificar si existe el usuario
        if ($result->num_rows === 1) {

            $row = $result->fetch_assoc();

            // 9. Verificar contraseña
            if ($password === $row['password']) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre_completo'];
                $_SESSION['rol'] = $row['rol'];

                header("Location: dashboard.php");
                exit();

            } else {

                header("Location: index.php?error=1");
                exit();

            }

        } else {

            header("Location: index.php?error=1");
            exit();

        }

        $stmt->close();

    } catch (mysqli_sql_exception $e) {

        die("Error de autenticación en el servidor: " . $e->getMessage());

    }

} else {

    header("Location: index.php");
    exit();

}
?>