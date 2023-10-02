<?php 
/* 

    Modelo: suma.php
    Descripcion: suma los valores del formulario

*/
//Creo dos variables para almacenar los valores enviados POST por el formulario
$valor1 = $_POST['valor1'];
$valor2 = $_POST['valor2'];

// Creo otra variable para guardar la operacion realizada
$operacion = "Producto";

// Realizo los cálculos y lo almaceno en la variable resultado
$resultado = $valor1 * $valor2;
?>