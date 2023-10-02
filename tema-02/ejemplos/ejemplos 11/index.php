<?php 
    /*
        Funcion is_null()

        - variable no definida
    */

    // variable no definida
    var_dump(is_null($var));

    echo"<BR>";

    // variable definida sin valor asignado
    $var = null;
    var_dump(is_null($var));
    echo "<BR>";

    // variable eliminada 
    unset($var);
    var_dump(is_null($var));
    echo "<BR>";

?>