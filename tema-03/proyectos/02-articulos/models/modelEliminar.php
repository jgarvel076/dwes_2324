<?php 

    // Model: model.eliminar.php
    
    // Descripción: eliminar un elemto de la tabla

    $articulos = generar_Tabla();
    $categorias = generar_Tabla_categoria();

    $id = $_GET['id'];

    $indice_eliminar =  buscar_en_tabla($articulos, 'id', $id);

    if ($indice_eliminar !== false) {

        unset ($articulos[$indice_eliminar]);

        $articulos = array_values($articulos);
    
    } else {
        echo 'ERROR: libro no encontrado';
        exit();
    }

?>