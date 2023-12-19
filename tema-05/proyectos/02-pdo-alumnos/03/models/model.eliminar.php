<?php

/*
    Model: model.eliminar.php
    Descripción: Elimina un elemento

    Método POST: Cargaré las variables necesarias para eliminar un elemento
*/

# Seleccionamos el id del alumno a borrar
$id_alumno = $_GET['id']; 

# Conexión a bas de datos
$conexion = new Alumnos();

# Datos introducidos
$alumnos = $conexion->getAlumnos();
$cursos = $conexion->getCursos();

$alumno = $conexion->getAlumno($id_alumno);

$conexion->delete_alumno($id_alumno);

//Generar notificacion
$notificacion = "Alumno eliminado correctamente";

?>