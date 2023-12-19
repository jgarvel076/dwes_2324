<?php

    /*  
        model.index.php

        Mostrar contenido de la tabla fp.alumnos

        Mostrará la tabla como array de objetos
    */


     $conexion = new libros();

     $libros = $conexion->getLibros();
?>