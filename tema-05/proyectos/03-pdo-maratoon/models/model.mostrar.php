<?php 

    /*

        Modelo mostrar index

    */

    $conexion = new Corredores();

    $indice = $_GET['id'];

    $categorias = $conexion->getCategorias();
    $clubs = $conexion->getClubs();

    // Estos dos métodos no eran necesarios ya que se coge en la vista la categoría y club que es 
    // $categoria = $conexion->getCategoria($indice);
    // $club = $conexion->getClub($indice);


    $corredor = $conexion->getCorredor($indice);

?>