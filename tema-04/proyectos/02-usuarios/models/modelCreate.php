<?php
$articulos = generar_tabla();
$categorias = generar_categorias();
$marcas = generar_tabla_marcas();

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];

$nuevoArticulo = 
    [
        'id' => $id,
        'descripcion' => $descripcion,
        'modelo' => $modelo,
        'marca' => $marca,
        'categoria' => $categoria,
        'unidades' => $unidades,
        'precio' => $precio
    ];

$articulos [] = $nuevoArticulo;


/*nuevo*/
$categorias = ArrayArticulos :: getCategorias();
$marcas = ArrayArticulos :: getMarcas();

$articulo= new ArrayArticulos();
$articulos -> getDatos;

$id =$_POST['id'];

?>