<?php

    /*

        Controlador: editar.php
        Descripción: mostrar un formulario con los detalles editables
        del libro seleccionado
    */

//Cargamos configuración
include('config/config.php');

//Cargamos las clases
include("class/class.conexion.php");
include("class/class.libros.php");
include("class/class.libro.php");

//Cargamos el modelo
include("models/model.editar.php");

//Cargamos la vista
include("views/view.editar.php");

?>