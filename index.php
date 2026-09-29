<?php
require_once __DIR__ . "/config/conexion.php";

$res_atestados = mysqli_query($conn, "SELECT * FROM atestados ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web Personal - Zeile Nahomy</title>
    <link rel="stylesheet" href="assets/style.css?v=7">
</head>
<body>
<div class="container">

    <!-- Sección Inicio -->
    <div class="card profile-card">
        <div class="profile-img-container">
            <img src="assets/perfil.jpg" alt="Foto de perfil de Zeile Nahomy" class="profile-img">
        </div>
        <div class="profile-info">
            <h1>Mi Sitio Web Personal</h1>
            <p class="subtitle">Zeile Nahomy - Estudiante de Programacion</p>
            
            <p>
                Bienvenido/a a mi sitio web personal. Soy estudiante de programación y me encuentro aprendiendo las bases para el desarrollo de páginas web y el manejo de bases de datos.
            </p>
            
            <p>
                En este sitio comparto mis atestados académicos, proyectos del curso y medios de contacto.
            </p>

            <div class="actions" style="margin-top: 20px;">
                <a class="btn" href="admin/">Panel de Administracion</a>
            </div>
        </div>
    </div>

    <!-- Sección Acerca de Mí -->
    <div class="card">
        <h2>Acerca de Mi</h2>
        <p>
            Me encuentro en proceso de aprendizaje en la carrera de programación, con el objetivo de adquirir nuevos conocimientos y desarrollar habilidades en el área de la tecnología.
        </p>
        
        <h3>Intereses Academicos</h3>
        <ul>
            <li>Aprender sobre desarrollo y diseño de páginas web.</li>
            <li>Creación y administración de bases de datos relacionales.</li>
            <li>Aprender nuevas herramientas y tecnologías para proyectos futuros.</li>
        </ul>

        <h3>Habilidades y Conocimientos</h3>
        <p>
            Actualmente me encuentro aprendiendo los fundamentos básicos de maquetación web (HTML, CSS), conceptos iniciales de programación y el uso de herramientas como Visual Studio Code y XAMPP para las prácticas del curso.
        </p>
    </div>

    <!-- Sección Atestados Académicos -->
    <div class="card">
        <h2>Atestados Academicos</h2>
        <?php if ($res_atestados && mysqli_num_rows($res_atestados) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Institucion</th>
                        <th>Ano</th>
                        <th>Descripcion</th>
                        <th>Comprobante</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($res_atestados)): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($row['titulo']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['institucion']); ?></td>
                        <td><?php echo htmlspecialchars($row['anio']); ?></td>
                        <td><?php echo htmlspecialchars($row['descripcion'] ?? ''); ?></td>
                        <td>
                            <a href="assets/certificado.jpg" target="_blank" title="Ver comprobante en tamaño completo">
                                <img src="assets/certificado.jpg" alt="Título Bachiller" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--card-border);">
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay atestados registrados aun.</p>
        <?php endif; ?>
    </div>

    <!-- Sección Galería -->
    <div class="card">
        <h2>Galeria</h2>
        <p class="subtitle">Fotografias personales y avances de proyectos</p>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="assets/perfil.jpg" alt="Fotografía Personal">
                <span>Fotografia Personal</span>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Proyecto Web</div>
                <span>Sistema de Gestion Web</span>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Base de Datos</div>
                <span>Modelado de Bases de Datos</span>
            </div>
        </div>
    </div>

    <!-- Sección Contacto -->
    <div class="card">
        <h2>Contacto</h2>
        <p>Si deseas comunicarte conmigo para consultas o información académica, puedes escribirme a:</p>
        <p>
            <strong>Correo Electronico:</strong> zeile.vindas@gmail.com<br>
            <strong>Repositorio en linea:</strong> 
            <a href="https://github.com" target="_blank" style="color: var(--primary);">Perfil de GitHub</a>
        </p>
    </div>

</div>
</body>
</html>