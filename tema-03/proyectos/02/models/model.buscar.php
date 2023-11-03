<?php 

    /* 
    
        Modelo: model.buscar.php
        Descripcion: filtra los artículos a partir de la expresión búsqueda

    */

    $articulos = generar_Tabla();

    # Cargo la expresión de búsqueda 
    $expresion = $_GET['expresion'];

    # Filtra la tabla a partir de esa expresión
    
    // Creamos un array vacío donde cargaré las filas que cumplen 
    // con el criterio de búsqueda
    $aux = [];

    foreach($articulos as $articulo){
        if (array_search($expresion, $articulo, false)){
            $aux[] = $articulo;
        } 
    }

    # Validar la búsqueda
    if (!empty($aux)){
        $articulos = $aux;
    }

?>