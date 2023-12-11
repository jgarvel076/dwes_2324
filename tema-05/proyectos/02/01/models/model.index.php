<?php

    /*

        Modelo Principal index

    */

    $conexion = new Alumnos();

    $alumnos  = $conexion->getAlumnos();

    

?>