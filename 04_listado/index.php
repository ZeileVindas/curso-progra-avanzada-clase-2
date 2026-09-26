<?php

require_once __DIR__ . "/../config/conexion.php";

$buscar = trim($_GET["buscar"] ?? "");

if ($buscar !== "") {

    $buscar_sql = mysqli_real_escape_string($conn, $buscar);

    $sql = "
        SELECT id, nombre, correo, curso, edad, fecha_registro
        FROM estudiantes
        WHERE nombre LIKE '%$buscar_sql%'
           OR correo LIKE '%$buscar_sql%'
           OR curso LIKE '%$buscar_sql%'
        ORDER BY id DESC
    ";

} else {

    $sql = "
        SELECT id, nombre, correo, curso, edad, fecha_registro
        FROM estudiantes
        ORDER BY id DESC
    ";
}

$resultado = mysqli_query($conn, $sql);

$cantidad = $resultado ? mysqli_num_rows($resultado) : 0;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de estudiantes</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>4. Listado y búsqueda</h1>
        <p class="subtitle">
            Ejemplo de SELECT, WHERE, LIKE, mysqli_query(), mysqli_num_rows() y mysqli_fetch_assoc().
        </p>

        <form method="GET">
            <div class="form-grid">
                <div class="form-group full">
                    <label for="buscar">Buscar estudiante</label>
                    <input
                        type="text"
                        id="buscar"
                        name="buscar"
                        value="<?php echo htmlspecialchars($buscar); ?>"
                        placeholder="Nombre, correo o curso"
                    >
                </div>
            </div>

            <div class="actions">
                <button type="submit">Buscar</button>
                <a class="btn secondary" href="./">Limpiar</a>
                <a class="btn secondary" href="../">Volver</a>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>Resultados: <?php echo $cantidad; ?></h2>

        <?php if (!$resultado): ?>

            <div class="alert error">
                <?php echo htmlspecialchars(mysqli_error($conn)); ?>
            </div>

        <?php elseif ($cantidad === 0): ?>

            <div class="alert error">
                No se encontraron registros.
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
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>

                <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>

                    <tr>
                        <td><?php echo $fila["id"]; ?></td>
                        <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["correo"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["curso"]); ?></td>
                        <td><?php echo htmlspecialchars((string)$fila["edad"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["fecha_registro"]); ?></td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        <?php endif; ?>
    </div>
</div>
</body>
</html>
