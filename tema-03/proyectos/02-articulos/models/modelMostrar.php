<?php 

$articulos = generar_Tabla();
$categorias = generar_Tabla_categoria();

$id = $_GET['id'];

$indice_mostrar = buscar_en_tabla($articulos, 'id', $id);

if ($indice_mostrar !== false ) {

    $articulo = $articulos[$indice_mostrar];

} else {
    
    echo ("Libro no encontrado");
}

?>