<?php

/**
 * Generamos nuesvo producto 
 */

$articulos = new ArrayArticulo();
$articulos -> getDatos();

$categorias = ArrayArticulo::getCategorias();
$marcas = ArrayArticulo::getMarcas();

$id = $_POST['id'];
$modelo = $_POST['modelo'];
$descripcion = $_POST['descripcion'];
$marca_Art = $_POST['marca'];
$categoria_art = $_POST['categorias'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];

# Validación


# Creo un objeto clase artículo a partir de los detalles 
# del formulario 
$articulo = new Articulo(
    $id,
    $modelo,
    $descripcion,
    $marca_Art,
    $categoria_art,
    $unidades,
    $precio
);

# Añadimos el artículo a la tabla 
$articulos -> create($articulo);

# Generamos notificación
$notificacion = "Artículo creado con éxito"

?>