<?php
//Tipos de variables

//tipo boollelan

$test = false;
echo "\$test:";
var_dump($test);

//tipo int
$edad = 50;
echo "\$edad: ";
var_dump($edad);

echo "<BR>";

//tipo float 
$altura = 1.70;
echo "\altura";
var_dump($altura);

//tipo float exponencial
echo "<br>";

$distancia = 1.70e4;
echo "\distancia";
var_dump($distancia);

echo "<br>";

//tipo string
$mensaje = 'La distancia recorrida fue de $distancia km';
echo "\mensaje";
var_dump($mensaje);

echo "<br>";

//tipo string
$mensaje = 'La distancia recorrida fue de' .$distancia. 'km';
echo "\mensaje";
var_dump($mensaje);

echo "<br>";

?>