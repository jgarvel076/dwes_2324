<?php 
    /*

    Comentario prueba 
    Autor: Pablo Mateos Palas
    Aparece un atajo de teclado que es ctrl + Ç  

    */
    $alumno = "Pablo Mateos";

    //Si usamos echo o print el resultado sería de la misma forma. 
    print "El alumno es: ";
    print $alumno;

    echo "<br>";
    //La diferencia entre echo y print es: 
    //(Tanto echo como print son funciones, la sintaxis de PHP 
    //admite el no uso de paréntesis).
        //- Echo puede imprimir varias cadenas separadas por ,  
    echo "Mi nombre es: ", "Pablo Mateos Palas"; 
        //Print no admite más de un argumento.
        //Print se suele usar cuando queremos mostrar algo con un formato.

    echo "<br>";
    print "Mi nombre es: " . "Pablo Mateos Palas";
        //(Print no admite dos argumentos por eso si usamos el punto que es el 
        //operador de concadenado, introducimos solo un parámetro).
?>