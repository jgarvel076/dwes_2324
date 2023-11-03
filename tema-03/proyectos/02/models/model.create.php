<?php

$articulos = generar_Tabla();
$categorias = generar_Tabla_categoria();

/*
    Recogemos los datos del nuevo artículo y llamamos a la función nuevoLibro().
*/

//TODO DEBEMOS CAMBIAR LOS DATOS DENTRO DEL POST
$articulo =
    [
        'id' =>  sizeof($articulos) + 1,
        'descripcion' => $_POST['descripcion'],
        'modelo' => $_POST['modelo'],
        'categoria' => $_POST['categoria'],
        'unidades' => $_POST['unidades'],
        'precio' => $_POST['precio']
    ];


# Añado nuevo libro a la tabla
array_push($articulos, $articulo);
    
?>