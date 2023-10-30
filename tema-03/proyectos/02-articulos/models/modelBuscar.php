<?php 

    /* 
    
        Modelo: model.buscar.php
        Descripcion: filtra los artículos a partir de la expresión búsqueda

    */

    $articulos = generar_Tabla();

    $expresion = $_GET['expresion'];

    $aux = [];

    foreach($articulos as $articulo){
        if (array_search($expresion, $articulo, false)){
            $aux[] = $articulo;
        } 
    }

    if (!empty($aux)){
        $articulos = $aux;
    }

?>