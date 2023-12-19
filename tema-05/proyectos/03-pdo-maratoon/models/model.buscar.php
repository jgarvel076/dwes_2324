<?php

    /**
     * 
     * Model buscar.php
     * 
     */

     // Capturamos la expresion
     $expresion = $_GET['expresion'];

     // Creamos la conexion
     $conexion = new Corredores();

     // Usamos la función buscar ya declarada 
     $corredores = $conexion->buscar($expresion);

?>