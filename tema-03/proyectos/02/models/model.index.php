<?php

/*

    Modelo: model.index.php
    Descripcion: genera en array los datos de los artículos

*/

setlocale(LC_MONETARY, "es_ES");
$categorias = generar_Tabla_categoria();
$articulos = generar_Tabla();
$marcas = generar_Tabla_marcas();

?>