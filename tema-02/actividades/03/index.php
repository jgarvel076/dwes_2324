
<?php
// Ejercicio 1: Conversiones de datos en expresiones

// Multiplica valor entero con una cadena que contiene un número inicial
$valorEntero = 5;
$cadenaNumero = "98";
$resultado = $valorEntero * $cadenaNumero;
var_dump(gettype($resultado));

// Sumar valor entero con cadena con número inicial
$valorEntero = 8;
$cadenaNumero = "15";
$resultado = $valorEntero + $cadenaNumero;
var_dump(gettype($resultado));

// Sumar valor entero con valor float
$valorEntero = 10;
$valorFloat = 3.5;
$resultado = $valorEntero + $valorFloat;
var_dump(gettype($resultado));

// Concatenar valor entero con cadena
$valorEntero = 15;
$cadena = "Hola ";
$resultado = $cadena . $valorEntero;
var_dump(gettype($resultado));

// Sumar valor entero con valor booleano
$valorEntero = 7;
$valorBooleano = true;
$resultado = $valorEntero + $valorBooleano;
var_dump(gettype($resultado));

// Ejercicio 2: is_null()

$valor1 = null;
$valor2 = 4;
$valor3 = "Buenas";
$valor4 = false;
$valor5 = 0;
$valor6 = array();

var_dump(is_null($valor1) );
var_dump(is_null($valor2) ?);
var_dump(is_null($valor3));
var_dump(is_null($valor4));
var_dump(is_null($valor5));
var_dump(is_null($valor6));

// Ejercicio 3: isset()

$valor1 = null;
$valor2 = 4;
$valor3 = "Buenas";
$valor4 = false;
$valor5 = 0;
$valor6 = array();

var_dump(isset($valor1));
var_dump(isset($valor2));
var_dump(isset($valor3));
var_dump(isset($valor4));
var_dump(isset($valor5));
var_dump(isset($valor6));

// Ejercicio 4: empty()

$valor1 = null;
$valor2 = 4;
$valor3 = "Buenas";
$valor4 = false;
$valor5 = 0;
$valor6 = array();

var_dump(empty($valor1));
var_dump(empty($valor2));
var_dump(empty($valor3));
var_dump(empty($valor4));
var_dump(empty($valor5));
var_dump(empty($valor6));
?>

