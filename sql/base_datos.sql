CREATE DATABASE IF NOT EXISTS curso_php
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE curso_php;

CREATE TABLE IF NOT EXISTS estudiantes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL,
    curso VARCHAR(100) NOT NULL,
    edad INT UNSIGNED NULL,
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO estudiantes (nombre, correo, curso, edad) VALUES
('Ana Rodríguez', 'ana@example.com', 'Programación Web', 22),
('Carlos Mora', 'carlos@example.com', 'PHP y MySQL', 25),
('Laura Gómez', 'laura@example.com', 'Bases de Datos', 21);
