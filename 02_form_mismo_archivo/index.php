<?php

require_once __DIR__ . "/../config/conexion.php";

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recibir datos del formulario.
    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $curso = trim($_POST["curso"] ?? "");
    $edad = trim($_POST["edad"] ?? "");

    if ($nombre === "" || $correo === "" || $curso === "") {
        $mensaje = "Nombre, correo y curso son obligatorios.";
        $tipo_mensaje = "error";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no tiene un formato válido.";
        $tipo_mensaje = "error";
    } else {

        // mysqli_real_escape_string() ayuda a escapar texto para una consulta SQL.
        // En sistemas reales es preferible utilizar consultas preparadas.
        $nombre_sql = mysqli_real_escape_string($conn, $nombre);
        $correo_sql = mysqli_real_escape_string($conn, $correo);
        $curso_sql = mysqli_real_escape_string($conn, $curso);

        $edad_sql = ($edad === "") ? "NULL" : (int)$edad;

        $sql = "
            INSERT INTO estudiantes (nombre, correo, curso, edad)
            VALUES ('$nombre_sql', '$correo_sql', '$curso_sql', $edad_sql)
        ";

        if (mysqli_query($conn, $sql)) {
            $mensaje = "Estudiante registrado correctamente. ID generado: " . mysqli_insert_id($conn);
            $tipo_mensaje = "success";
        } else {
            $mensaje = "Error al guardar: " . mysqli_error($conn);
            $tipo_mensaje = "error";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario procesado por PHP</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>2. Formulario procesado en el mismo PHP</h1>
        <p class="subtitle">
            El atributo action queda vacío, por eso el formulario se envía a este mismo archivo.
        </p>

        <?php if ($mensaje !== ""): ?>
            <div class="alert <?php echo $tipo_mensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-grid">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Ej: María Pérez"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        placeholder="correo@ejemplo.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="curso">Curso</label>
                    <select id="curso" name="curso" required>
                        <option value="">Seleccione...</option>
                        <option value="PHP y MySQL">PHP y MySQL</option>
                        <option value="Programación Web">Programación Web</option>
                        <option value="Bases de Datos">Bases de Datos</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input
                        type="number"
                        id="edad"
                        name="edad"
                        min="1"
                        max="120"
                        placeholder="Ej: 25"
                    >
                </div>

            </div>

            <div class="actions">
                <button type="submit">Guardar estudiante</button>
                <a class="btn secondary" href="../">Volver</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
