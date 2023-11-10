<?php 

$articulos = generar_tabla();
$categorias = generar_categorias();

$criterio = $_GET['criterio'];


//Cargo en un array todos los valores dek criterio de ordenacion
$aux = array_column($articulos, $criterio);

// Validar criterio
if (!in_array($criterio, array_keys($articulos[0]))) {
    echo "No se ha encontrado el criterio";
    exit();

    
}

//Funcion array multisort
array_multisort($aux, SORT_ASC, $articulos);


?>