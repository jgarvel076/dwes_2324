<?php 
/* 

    Modelo: modelOctal.php
    Descripcion: los valores del formulario a octal

*/
//Creo una variable para almacenar los valores
$decimal = $_POST["ValorDecimal"];

// Creo otra variable para guardar la operacion realizada
$operacionNombre = "OCTAL";

// Realizo los cálculos y lo almaceno en la variable resultado
$operacion = decoct($decimal);
?>