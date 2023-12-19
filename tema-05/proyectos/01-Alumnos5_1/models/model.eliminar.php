<?php

/*

    Modelo: model.eliminar.php
    Descripcion: elimina un elemento de la  tabla

    Método GET:
                - indice. del artículo que quiero eliminar

*/

setlocale(LC_MONETARY, "es_ES");



# Conectamos BBDD fp y extraemos los cursos
$db = new Fp();
$cursos = $dp->getCursos();

# Id del alumno que voy a editar
$id = $_GET['id'];

# Obtengo un objeto de la clase Alumno los detalles del alumno
$alumno = $db->delete_alumno($id);

# notificación
$notificacion = "Alumno eliminado con éxito";


?>