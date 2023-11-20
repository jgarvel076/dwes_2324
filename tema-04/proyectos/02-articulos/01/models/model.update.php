<?php

    /*

    Modelo: modelUpdate.php
    Descripción: Actualiza un elemento a la tabla

    */

    $articulos = generar_Tabla();
    $categorias = generar_Tabla_categoria();
    $marcas = generar_Tabla_marcas();

    $id = $_GET['id'];
    
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $categoria = $_POST['categorias'];
    $marca = $_POST['marca'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    # obtenemos el indice del artículo que quiero editar
    $id_editar = $_GET['id'];

    # obtenemos el indice del artículo
    $indice_articulo_editar = buscar_en_tabla($articulos, 'id', $id_editar);

    # Creo un array asociativo con los detalles del nuevo artículo

    $articulo = [
        'id' => $id,
        'descripcion' => $descripcion,
        'modelo' => $modelo,
        'marcas' => $marca,
        'categoria' => $categoria,
        'unidades' => $unidades,
        'precio' => $precio
    ];

    # actualizamos el artículo en su posicion correspondiente
    $articulos[$indice_articulo_editar] = $articulo;
?>