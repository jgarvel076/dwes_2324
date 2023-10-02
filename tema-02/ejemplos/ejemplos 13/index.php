<?php
/*
    Funcion isset()

    FALSO
        - variable no definido
        - variable definida y asignada valor null
    VERDADERO
        - asignar el valor 0
        - asginar cualquier valor entero
        - asignar cadena vacia ""
        - asignamos un array
*/

//isset() devuelve false por que $var no ha sido definida
var_dump(isset($var1));
echo "<BR>";

//isset() devuelve false aunque la variable haya sido declarada pues //su valor es NULL
$var2;
var_dump(isset($var2));
echo "<BR>";

//isset() devuelve true. El valor ya no es nulo aunque esté vacío
$var3 = "";
var_dump(isset($var3));
echo "<BR>";

?>