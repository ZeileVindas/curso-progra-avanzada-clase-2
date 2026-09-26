# Curso básico: PHP + MySQL + HTML + CSS

Proyecto didáctico de ejemplo:

- Conexión a MySQL con `mysqli`.
- Uso de `mysqli_query()`.
- Lectura con `mysqli_fetch_assoc()`.
- Conteo con `mysqli_num_rows()`.
- Formularios HTML procesados por PHP.
- Formularios enviados con `fetch()`.
- Inserciones y consultas básicas.
- Validación sencilla de datos.
- Uso de CSS para una interfaz limpia.

## Requisitos

- XAMPP, WAMP, Laragon o servidor con PHP + MySQL/MariaDB.
- PHP 7.4 o superior recomendado.
- MySQL o MariaDB.

## Instalación rápida

1. Copie la carpeta `curso_php_mysql` dentro de `htdocs` si usa XAMPP.
2. Inicie Apache y MySQL.
3. Abra phpMyAdmin.
4. Importe el archivo:

   `sql/base_datos.sql`

5. Revise la configuración en:

   `config/conexion.php`

6. Abra en el navegador:

   `http://localhost/curso_php_mysql/`

## Estructura

- `config/conexion.php`: conexión reutilizable a MySQL.
- `01_conexion/`: ejemplo básico de conexión y consulta.
- `02_form_mismo_archivo/`: formulario que se procesa en el mismo archivo PHP.
- `03_fetch/`: formulario HTML que envía datos a otro archivo PHP usando Fetch API.
- `04_listado/`: listado de registros almacenados.
- `sql/base_datos.sql`: base de datos y datos de ejemplo.
- `assets/style.css`: estilos compartidos.

## Nota importante

La función correcta es:

`mysqli_num_rows()`

No existe `mysqli_nums_rows()`.

Para fines didácticos se muestran consultas con `mysqli_query()`. Para aplicaciones reales, especialmente cuando intervienen datos escritos por usuarios, se recomienda usar consultas preparadas con `mysqli_prepare()`.
