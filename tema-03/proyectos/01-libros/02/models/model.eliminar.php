<?php

/*

Modelo: model.eliminar.php

*/
$id = $_GET['id'];

$indice_eliminar = $buscar_en_tabla($libros, 'id', $id);

if ($indice_eliminar !==false){

    unset ($libros[$indice_eliminar]);
    $libros = array_values($libros);

} else {
    echo 'ERROR: libro no encontrado';
    exit();
}

/*$libros = eliminar($libros, '3');*/

?>