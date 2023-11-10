<?php 
$articulos = generar_tabla();
$categorias = generar_categorias();

$id = $_GET['id'];

$indice_mostrar = buscar_en_tabla($articulos, 'id', $id);

if ($indice_mostrar !== false ) {
    $articulo = $articulos[$indice_mostrar];
} else {
    echo ("articulo no encontrado");
}


?>