<?php 
/* 

    Modelo: modelBinario.php
    Descripcion: los valores del formulario a binario

*/
//Creo una variable para almacenar los valores
$decimal = $_POST["ValorDecimal"];

// Creo otra variable para guardar la operacion realizada
$operacionNombre = "HEXADECIMAL";

// Realizo los cálculos y lo almaceno en la variable resultado
$operacion = dechex($decimal);
?>