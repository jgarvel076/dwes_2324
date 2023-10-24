<?php

/*
function buscra_en_tabla()
descripcion: busca u valor en una determinada columna de la tabla
paramteros: 
                - tabla
                - nombre de la columna
                - valor que quiero buscar
    salida: 
                - indice del array donde se encuentra el valor
                - false en caso de que no lo encuentre
*/
function buscar_en_tabla($tabla = [], $columna, $valor){
    $columna_valores = array_column($tabla, $columna);
    return array_search($valor, $columna_valores, false);

}