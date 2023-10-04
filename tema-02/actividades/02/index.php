<?php
$var=3;

//conversion
$var1=strval($var);
$var2=intval($var);
$var3=floatval($var);

//muestra el valor
var_dump($var1);
var_dump($var2);
var_dump($var3);

//conversion
$var1=(int)$var;
$var2=(float)$var;
$var3=(string)$var;
$var4=(array)$var;

//muestra el valor
var_dump($var1);
var_dump($var2);
var_dump($var3);
var_dump($var4);

//conversion
settype($var, "integer");
settype($var2, "float");
settype($var3, "string");
settype($var4, "boolean");

//muestra el valor
var_dump($var1);
var_dump($var2);
var_dump($var3);
var_dump($var4);

?>