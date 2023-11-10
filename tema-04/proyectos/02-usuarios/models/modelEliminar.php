<?php

/*
Modelo: modelEliminar.php
Descripción: Elimina un elemento de la tabla

Método GET:
        - id: Identificador del elemento a eliminar
*/
$articulos = generar_tabla();
$categorias = generar_categorias();

$id = $_GET['id'];

$indice_eliminar = buscar_en_tabla($articulos,'id', $id);

// comparación estricta para distinguir el false del 0
if ($indice_eliminar !== false) {
    // Elimino el libro seleccionado
    unset($articulos[$indice_eliminar]);
    $articulos = array_values($articulos);

} else {
    echo "No se encontró el elemento a eliminar";
    exit();
}
?>