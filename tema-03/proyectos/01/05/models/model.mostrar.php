<?php 

$id = $_GET['id'];

$indice_mostrar = buscar_en_tabla($libros, 'id', $id);

if ($indice_mostrar != null ) {

    $libro = $libros[$indice_mostrar];

} else {
    
    echo ("Libro no encontrado");
}

?>