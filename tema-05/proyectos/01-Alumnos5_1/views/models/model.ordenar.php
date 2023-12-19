<?php

/*

    Modelo: model.ordenar.php
    Descripcion: muestra los alumnos  a partir de un  criterio de ordenación

*/

setlocale(LC_MONETARY, "es_ES");

// Conecto con la base de datos
$db = new Fp();

// objeto result con los detalles del alumno
$alumnos = $db->getAlumnos();

?>