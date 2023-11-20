<?php

// Model: model.eliminar.php

// Descripción: eliminar un elemto de la tabla

$categorias = ArrayArticulo::getCategorias();

$marcas = ArrayArticulo::getMarcas();

$articulos = new ArrayArticulo();
$articulos -> getDatos();


// No comprendo porqué se llama indice y no id
$id = $_GET['indice'];

if ($id !== false) {
    // elimino elemento seleccionado 
    $articulos -> delete($id);

} else {
    echo 'ERROR: libro no encontrado';
    exit();
}

?>