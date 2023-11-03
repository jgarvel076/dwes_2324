<?php

$libros = generar_Tabla();

$id = $_GET['id'];

$libroEditar = buscar_en_tabla($libros, 'id', $id);

if ($libroEditar != null) {

    $libro = $libros[$libroEditar];

} else {

    echo ("Libro no encontrado");
}

?>