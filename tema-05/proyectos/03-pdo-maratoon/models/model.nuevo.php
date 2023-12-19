<?php
    /**
     * 
     * Modelo nuevo
     * 
     */

     // Creamos la conexion
     $conexion = new Corredores();

     // Cargaremos las categorias
     $categorias = $conexion->getCategorias();

     // Cargamos los clubs
     $clubs = $conexion->getClubs();
?>