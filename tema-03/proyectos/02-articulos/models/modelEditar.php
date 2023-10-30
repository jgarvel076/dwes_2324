<?php

$categorias = generar_Tabla_categoria();
$articulos = generar_Tabla();

$id = $_GET['id'];

$articuloEditar = buscar_en_tabla($articulos, 'id', $id);

if ($articuloEditar !== false) {

    $articulo = $articulos[$articuloEditar];

} else {

    echo ("Libro no encontrado");
}

?>