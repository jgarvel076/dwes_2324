<?php
$articulos = generar_tabla();
$categorias = generar_categorias();

$id = $_GET['id'];

$indice = buscar_en_tabla($articulos,'id', $id);
if ($indice !== false) {
    // Elimino el libro seleccionado
    $articulo = $articulos[$indice];
    

} else {
    echo "No se encontró el elemento a eliminar";
    exit();
}
?>
