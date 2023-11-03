<?php 

    $idLibroEditar = $_GET('id');

    $libroEditar = buscar_en_tabla($libros, 'id', $idLibroEditar);

?>