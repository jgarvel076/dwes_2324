<?php
// Obtener categorías, marcas y cargar los artículos
$categorias = ArrayArticulo::getCategorias();
$marcas = ArrayArticulo::getMarcas();
$articulos = new ArrayArticulo();
$articulos->getDatos();

$idBuscado = $_GET['indice'];

# Usamos la funcion buscar de ArrayArticulos
$articulo = $articulos->buscarId($idBuscado);

?>