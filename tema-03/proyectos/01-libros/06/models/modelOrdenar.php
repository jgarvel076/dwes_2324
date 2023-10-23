<?php 

$criterio = $_GET['criterio'];

$indice_mostrar = buscar_en_tabla($libros, 'id', $id);

//Cargo en un array todos los valores dek criterio de ordenacion

$aux = array_column($libros, '$criterio');


?>