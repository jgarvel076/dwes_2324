<?php
// Obtener categorías, marcas y cargar los artículos
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();
$articulos = new ArrayArticulos();
$articulos->getDatos();

$idBuscado = $_GET['indice'];

# Usamos la funcion buscar de ArrayArticulos
$articulo = $articulos->buscar($idBuscado);

?>