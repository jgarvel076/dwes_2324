<?php

    /*

        Modelo editar.php

    */

    # tomamos por GET el id del alumno a editar
    $id_editar = $_GET['id'];

    # creamos objeto de la clase conexion
    $conexion = new Corredores();

    # extraigo los valores de los alumnos y de los cursos
    // $corredores = $conexion->getCorredores(); 
    $clubs = $conexion->getClubs();
    $categorias = $conexion->getCategorias();

    # Buscamos el alumno a editar
    $corredor = $conexion->getCorredor($id_editar);
    

?>