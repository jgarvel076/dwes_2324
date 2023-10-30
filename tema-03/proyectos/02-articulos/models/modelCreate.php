<?php

$articulos = generar_Tabla();
$categorias = generar_Tabla_categoria();



$articulo =
    [
        'id' =>  sizeof($articulos) + 1,
        'descripcion' => $_POST['descripcion'],
        'modelo' => $_POST['modelo'],
        'categoria' => $_POST['categoria'],
        'unidades' => $_POST['unidades'],
        'precio' => $_POST['precio']
    ];


array_push($articulos, $articulo);
    
?>