<?php

$numeroFloat = 7.5;
$numeroInt = 3;

$suma = $numeroFloat + $numeroInt;
$resta = $numeroFloat - $numeroInt;
$division = $numeroFloat / $numeroInt;
$producto = $numeroFloat * $numeroInt;
$potencia = pow($numeroFloat, $numeroInt);


echo "Resultado suma: ";
var_dump($suma);
echo "<br>";

echo "Resultado resta: ";
var_dump($resta);
echo "<br>";

echo "Resultado división: ";
var_dump($division);
echo "<br>";

echo "Resultado producto: ";
var_dump($producto);
echo "<br>";

echo "Resultado potencia: ";
var_dump($potencia);
echo "<br>";
?>
