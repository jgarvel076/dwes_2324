<?php
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

$articulos = new ArrayArticulos();
$articulos->getDatos();


$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$categoria = $_POST['categorias'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];


$articulo = new Articulo(
    $id, 
    $descripcion, 
    $modelo, 
    $marca,
    $categoria,
    $unidades,
    $precio);

#    añadimos el articulo
$articulos->create($articulo);

# genero notificación
$notificacion = "Articulo creado con éxito";


?>