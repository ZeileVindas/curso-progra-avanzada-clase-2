<?php
require_once __DIR__ . "/config/conexion.php";

$sql = "SELECT COUNT(*) AS total FROM estudiantes";
$resultado = mysqli_query($conn, $sql);

$total = 0;

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $total = $fila["total"];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso PHP + MySQL</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Curso PHP + MySQL + HTML</h1>
        <p class="subtitle">
            Proyecto de demostración con MySQLi. Registros actuales: <?php echo $total; ?>
        </p>

        <div class="actions">
            <a class="btn" href="01_conexion/">1. Conexión y consulta</a>
            <a class="btn" href="02_form_mismo_archivo/">2. Formulario PHP</a>
            <a class="btn" href="03_fetch/">3. Formulario Fetch</a>
            <a class="btn secondary" href="04_listado/">4. Listado</a>
        </div>
    </div>
</div>
</body>
</html>
