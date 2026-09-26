<?php

require_once __DIR__ . "/../config/conexion.php";

// Consulta SQL sencilla.
// mysqli_query() recibe la conexión y el SQL que queremos ejecutar.
$sql = "SELECT id, nombre, correo, curso, edad FROM estudiantes ORDER BY id DESC";
$resultado = mysqli_query($conn, $sql);

// mysqli_num_rows() indica cuántas filas devolvió la consulta.
$cantidad = $resultado ? mysqli_num_rows($resultado) : 0;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de conexión</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>1. Conexión y consulta con MySQLi</h1>
        <p class="subtitle">
            Registros encontrados: <?php echo $cantidad; ?>
        </p>

        <?php if (!$resultado): ?>
            <div class="alert error">
                Error al consultar: <?php echo htmlspecialchars(mysqli_error($conn)); ?>
            </div>
        <?php elseif ($cantidad === 0): ?>
            <div class="alert error">
                No hay estudiantes registrados.
            </div>
        <?php else: ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Curso</th>
                        <th>Edad</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                // mysqli_fetch_assoc() obtiene una fila como arreglo asociativo.
                while ($fila = mysqli_fetch_assoc($resultado)):
                ?>
                    <tr>
                        <td><?php echo $fila["id"]; ?></td>
                        <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["correo"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["curso"]); ?></td>
                        <td><?php echo htmlspecialchars((string)$fila["edad"]); ?></td>
                    </tr>
                <?php endwhile; ?>

                </tbody>
            </table>

        <?php endif; ?>

        <div class="actions">
            <a class="btn secondary" href="../">Volver</a>
        </div>
    </div>
</div>
</body>
</html>
