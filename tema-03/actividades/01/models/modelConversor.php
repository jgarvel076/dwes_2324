<?php 
/* 

    Modelo: modelConversor.php
    Descripcion: los valores del formulario

*/
//Creo una variable para almacenar los valores
$decimal = $_POST["ValorDecimal"];

// Realizo los cálculos y lo almaceno en la variable resultado
$binario = decbin($decimal);
$octal = decoct($decimal);
$hexadecimal = dechex($decimal);
?>