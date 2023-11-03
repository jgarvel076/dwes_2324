<?php 

    // Model: model.eliminar.php
    
    // Descripción: eliminar un elemto de la tabla

    $id = $_GET['id'];

    $indice_eliminar =  buscar_en_tabla($libros, 'id', $id);

    if ($indice_eliminar !== false) {
        // elimino elemento seleccionado 
        unset ($libros[$indice_eliminar]);

        // reorganizo array
        $libros = array_values($libros);
    
    } else {
        echo 'ERROR: libro no encontrado';
        exit();
    }

?>