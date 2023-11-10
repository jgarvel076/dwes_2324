<?php

$articulos = generar_tabla();
$categorias = generar_categorias();

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$categoria = $_POST['categoria'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];

$id = $_GET['id'];

$indice = buscar_en_tabla($articulos, 'id', $id);

$articulo = 
[
    'id' => $id,
    'descripcion' => $descripcion,
    'modelo' => $modelo,
    'categoria' => $categoria,
    'unidades' => $unidades,
    'precio' => $precio
];

$articulos[$indice] = $articulo;