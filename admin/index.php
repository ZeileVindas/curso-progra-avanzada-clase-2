<?php
require_once __DIR__ . "/../config/conexion.php";

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'guardar_atestado') {
    $titulo = trim($_POST["titulo"] ?? "");
    $institucion = trim($_POST["institucion"] ?? "");
    $anio = trim($_POST["anio"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if ($titulo === "" || $institucion === "" || $anio === "") {
        $mensaje = "Por favor completa el titulo, institucion y ano.";
        $tipo_mensaje = "error";
    } else {
        $titulo_sql = mysqli_real_escape_string($conn, $titulo);
        $institucion_sql = mysqli_real_escape_string($conn, $institucion);
        $anio_sql = mysqli_real_escape_string($conn, $anio);
        $descripcion_sql = mysqli_real_escape_string($conn, $descripcion);

        $sql = "INSERT INTO atestados (titulo, institucion, anio, descripcion) 
                VALUES ('$titulo_sql', '$institucion_sql', '$anio_sql', '$descripcion_sql')";

        if (mysqli_query($conn, $sql)) {
            $mensaje = "Atestado registrado con exito.";
            $tipo_mensaje = "success";
        } else {
            $mensaje = "Error al guardar el registro: " . mysqli_error($conn);
            $tipo_mensaje = "error";
        }
    }
}

$res_atestados = mysqli_query($conn, "SELECT * FROM atestados ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion - Zeile Nahomy</title>
    <link rel="stylesheet" href="../assets/style.css?v=2">
</head>
<body>
<div class="container">
    
    <div class="card">
        <h1>Panel de Administracion</h1>
        <p class="subtitle">Gestion de contenido del sitio web</p>

        <?php if ($mensaje !== ""): ?>
            <div class="alert <?php echo $tipo_mensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <h2>Agregar Nuevo Atestado Academico</h2>
        <form method="POST" action="">
            <input type="hidden" name="action" value="guardar_atestado">
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="titulo">Titulo o Certificado</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Ej: Tecnico en Programacion">
                </div>
                
                <div class="form-group">
                    <label for="institucion">Institucion</label>
                    <input type="text" id="institucion" name="institucion" required placeholder="Ej: Universidad / Instituto">
                </div>
                
                <div class="form-group">
                    <label for="anio">Ano</label>
                    <input type="text" id="anio" name="anio" required placeholder="Ej: 2026">
                </div>
                
                <div class="form-group full">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Detalles o descripcion del logro...">
                </div>
            </div>

            <div class="actions" style="margin-top: 15px;">
                <button type="submit">Guardar Atestado</button>
                <a class="btn secondary" href="../">Ver Sitio Publico</a>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>Atestados Registrados</h2>
        <?php if ($res_atestados && mysqli_num_rows($res_atestados) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Institucion</th>
                        <th>Ano</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($res_atestados)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($row['titulo']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['institucion']); ?></td>
                        <td><?php echo htmlspecialchars($row['anio']); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay atestados registrados en la base de datos.</p>
        <?php endif; ?>
    </div>

</div>
</body>
</html>