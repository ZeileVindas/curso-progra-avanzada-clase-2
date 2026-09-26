<?php

header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/../config/conexion.php";

$respuesta = [
    "ok" => false,
    "mensaje" => ""
];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    $respuesta["mensaje"] = "Método no permitido.";
    echo json_encode($respuesta);
    exit;
}

$nombre = trim($_POST["nombre"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$curso = trim($_POST["curso"] ?? "");
$edad = trim($_POST["edad"] ?? "");

if ($nombre === "" || $correo === "" || $curso === "") {
    http_response_code(400);
    $respuesta["mensaje"] = "Nombre, correo y curso son obligatorios.";
    echo json_encode($respuesta);
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    $respuesta["mensaje"] = "Correo electrónico inválido.";
    echo json_encode($respuesta);
    exit;
}

// Para este ejemplo se utiliza mysqli_real_escape_string()
// y mysqli_query() porque son parte del contenido del curso.
$nombre_sql = mysqli_real_escape_string($conn, $nombre);
$correo_sql = mysqli_real_escape_string($conn, $correo);
$curso_sql = mysqli_real_escape_string($conn, $curso);

$edad_sql = ($edad === "") ? "NULL" : (int)$edad;

$sql = "
    INSERT INTO estudiantes (nombre, correo, curso, edad)
    VALUES ('$nombre_sql', '$correo_sql', '$curso_sql', $edad_sql)
";

if (mysqli_query($conn, $sql)) {

    $respuesta["ok"] = true;
    $respuesta["mensaje"] =
        "Registro guardado correctamente. ID: " . mysqli_insert_id($conn);

} else {

    http_response_code(500);

    $respuesta["mensaje"] =
        "Error de base de datos: " . mysqli_error($conn);
}

echo json_encode($respuesta);
