<?php 
$articulos = generar_tabla();
$categorias = generar_categorias();

$expresion = $_GET['expresion'];


//Cargo en un array todos los valores dek expresion de ordenacion
$aux = array_column($articulos, $expresion);

# Filtrar la tabla a partir de la expresion
$aux = [];
foreach ($articulos as $articulo) {
    if(array_search($expresion, $articulo, false)){
        $aux[]= $articulo;

    }
}
    # Validar búsqueda
    if (!empty($aux)){
        $articulos = $aux;

    }


?>