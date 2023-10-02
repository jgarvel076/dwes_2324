<?php 
    /*
        Funcion is_null()

        VERDADERO
            - variable no definido
            - variable adignada al valor null
        FALSO
            - asignar el valor 0
            - asginar cualquier valor entero
            - asignar cadena vacia ""
            - asignamos un array
    */
   
    
    // variable con valor 0

    $var1 = null;
    var_dump(is_null($var));
    echo "<BR>";

    // variable con cualquier valor entero 

    $var2 = 56;
    var_dump(is_null($var));
    echo "<BR>";

    // variable con una cadena vacia 

    $var3 = "";
    var_dump(is_null($var));
    echo "<BR>";

    // variable es un array 

    $var4 = [];
    var_dump(is_null($var));
    echo "<BR>";

?>