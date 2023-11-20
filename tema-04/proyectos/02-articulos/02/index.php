<?php 

    /**
     * Controlador index.php
     * Muestra los detalles de los artículos ordenados
     */

    // Cargamos libreria
    include 'class/class.articulo.php';
    include 'class/class.arrayArticulo.php';

    //Cargamos modelo
    include "models/model.index.php";

    //Cargamos vista
    include "views/view.index.php";
    
?>