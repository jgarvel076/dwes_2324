<?php

$articulos = generar_Tabla();
$categorias = generar_Tabla_categoria();


$criterio = $_GET['criterio'];


$aux = array_column($articulos, $criterio);


if (!in_array($criterio, $aux) === false) {
    echo "No se ha encontrado el criterio";
    exit();

}


array_multisort($aux, SORT_ASC, $articulos);

?>