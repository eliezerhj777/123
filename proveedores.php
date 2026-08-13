<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Conexión
require_once 'conexion.php';

// Obtener proveedores
$sql = "SELECT nombre_empresa, contacto, telefono, direccion
        FROM proveedores
        ORDER BY nombre_empresa ASC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores - Sistema de Ventas</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h2 {
            color: #0f172a;
            margin: 0;
        }

        .btn-nuevo {
            background: #3b82f6;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-nuevo:hover {
            background: #2563eb;
        }

        .btn-volver {
            display: inline-block;
            margin-bottom: 20px;
            color: #64748b;
            text-decoration: none;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f1f5f9;
            color: #334155;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #cbd5e1;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        .sin-datos {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="dashboard.php" class="btn-volver">
        ← Volver al Dashboard
    </a>

    <div class="encabezado">
        <h2>Catálogo de Proveedores</h2>

        <a href="nuevo_proveedor.php" class="btn-nuevo">
            + Nuevo Proveedor
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>

        <tbody>

        <?php if ($resultado && $resultado->num_rows > 0): ?>

            <?php while ($proveedor = $resultado->fetch_assoc()): ?>

                <tr>
                    <td>
                        <?php echo htmlspecialchars($proveedor['nombre_empresa']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($proveedor['contacto']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($proveedor['telefono']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($proveedor['direccion']); ?>
                    </td>
                </tr>

            <?php endwhile; ?>

        <?php else: ?>

            <tr>
                <td colspan="4" class="sin-datos">
                    No hay proveedores registrados.
                </td>
            </tr>

        <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>