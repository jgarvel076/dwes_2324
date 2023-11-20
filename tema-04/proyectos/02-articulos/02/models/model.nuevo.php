<?php

/**
 * 
 * Model: model.nuevo.php
 * Descripción: carga array categorias y array de marcas
 * 
 */


# Cargamos arrays para generar de forma dinámica la lista select
$categorias = ArrayArticulo::getCategorias();
$marcas = ArrayArticulo::getMarcas();

?>