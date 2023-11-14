<?php
setlocale(LC_MONETARY, "es_ES");
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

# Creamos un objeto de la clase ArrayArticulos
$articulos = new ArrayArticulos();

#Cargo los datos
$articulos->getDatos();



?>