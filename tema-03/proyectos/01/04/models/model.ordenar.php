<?php

#Cargamos el criterio de ordenación 
$criterio = $_GET['criterio'];

// Cargo en un array todos los valores del criterio de ordenación 
$aux = array_column($libros, $criterio);

// Validar criterio
if (!in_array($criterio, $aux) === false) {
    echo "No se ha encontrado el criterio";
    exit();

}

//Funcion array multisort
array_multisort($aux, SORT_ASC, $libros);



?>