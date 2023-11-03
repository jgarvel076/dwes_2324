<?php 

    /* 
    
        Modelo: model.buscar.php
        Descripcion: filtra los libros a partir de la expresión búsqueda

    */

    # Cargo la expresión de búsqueda 
    $expresion = $_GET['expresion'];

    # Filtra la tabla a partir de esa expresión
    
    // Creamos un array vacío donde cargaré las filas que cumplen 
    // con el criterio de búsqueda
    $aux = [];

    foreach($libros as $libro){
        if (array_search($expresion, $libro, false)){
            $aux[] = $libro;
        } 
    }

    # Validar la búsqueda
    if (!empty($aux)){
        $libros = $aux;
    }

?>