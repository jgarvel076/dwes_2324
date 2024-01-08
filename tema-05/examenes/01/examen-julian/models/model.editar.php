<?php

    /*

        Modelo editar.php

    */


    $id_editar = $_GET['id'];


    $conexion = new $Libros();


    $libros = $conexion->getLibros(); 


    $libro = $conexion->getLibros($id_editar);
    

?>