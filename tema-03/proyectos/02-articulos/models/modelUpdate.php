<?php

    /*

    Modelo: modelUpdate.php
    Descripción: Actualiza un elemento a la tabla

    */

    $articulos = generar_Tabla();
    $categorias = generar_Tabla_categoria();

    $id = $_GET['id'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $categoria = $_POST['categoria'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    $id_editar = $_GET['id'];


    $indice_articulo_editar = buscar_en_tabla($articulos, 'id', $id_editar);


    $articulo = [
        'id' => $id,
        'descripcion' => $descripcion,
        'modelo' => $modelo,
        'categoria' => $categoria,
        'unidades' => $unidades,
        'precio' => $precio
    ];


    $articulos[$indice_articulo_editar] = $articulo;
?>