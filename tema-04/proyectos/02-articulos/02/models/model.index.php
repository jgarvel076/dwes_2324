<?php

/*

    Modelo: model.index.php
    Descripcion: genera en array de objetos de los artículos

*/

setlocale(LC_MONETARY, "es_ES");
$categorias = ArrayArticulo::getCategorias();

$marcas = ArrayArticulo::getMarcas();

$articulos = new ArrayArticulo();
$articulos -> getDatos();

?>