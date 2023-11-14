<?php

/*
Modelo: modelEliminar.php
Descripción: Elimina un elemento de la tabla

Método GET:
        - id: Identificador del elemento a eliminar
*/
$articulos = new ArrayArticulos();
$articulos->getDatos();
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

$id = $_GET['indice'];

$articulos->delete($id);

$notificacion = "Articulo eliminado con éxito";


?>