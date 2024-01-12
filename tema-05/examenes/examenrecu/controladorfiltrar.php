<?php

//Cargamos configuración
include('config/config.php');

//Cargamos las clases
include("class/class.conexion.php");
include("class/class.libros.php");
include("class/class.libro.php");

//Cargamos el modelo
include("models/model.filtrar.php");

//Cargamos la vista
include("views/view.index.php");

?>