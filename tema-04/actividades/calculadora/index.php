<?php
include("class/class.calculadora.php");


$calculadora = new Calculadora();
$calculadora->setValor1(4);
$calculadora->setValor2(6);

$calculadora->suma();
echo "Suma: " . $calculadora->getResultado() . "\n";

$calculadora->resta();
echo "Resta: " . $calculadora->getResultado() . "\n";

$calculadora->multiplicacion();
echo "Multiplicación: " . $calculadora->getResultado() . "\n";

$calculadora->division();
echo "División: " . $calculadora->getResultado() . "\n";

$calculadora->setValor1(2);
$calculadora->setValor2(3);
$calculadora->potencia();
echo "Potencia: " . $calculadora->getResultado() . "\n";


?>