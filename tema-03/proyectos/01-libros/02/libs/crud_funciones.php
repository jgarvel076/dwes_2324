<?php

function buscar_en_tablas($tabla = [], $columna, $valor){

    $columna_valores = array_column($tabla, $columna);
    return array_search($valor, $columna_valores, false);
}

/*function eliminar ($tabla = [], $id) {
$lista_id = array_column($tabla, 'id');

$elemento = array_search($id, $lista_id, false);

unset($tabla[$elemento]);

return $tabla;

}*/

?>