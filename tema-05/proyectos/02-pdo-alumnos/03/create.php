<?php
/*
 Controlador create con PDO
*/

# Cargamos configuración
include('config/db.php');

# Cargamos librería de funciones

# Cargamos clases en orden
include('class/class.conexion.php');
include('class/class.alumno.php');
include('class/class.alumnos.php');

# Cargo modelo
include('models/model.create.php');

// Una vez que se  añade un nuevo alumno se debe redireccionar al index

header('location: index.php');

?>