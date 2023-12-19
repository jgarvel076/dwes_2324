<?php

    /**
     * 
     * Controlador eliminar.php
     * 
     */

     // Cargamos las constantes
     include 'config/db.php';

     // Cargamos las clases correspondientes
     include 'class/class.conexion.php';
     include 'class/class.corredores.php';

     // Cargamos el modelo correspondiente
     include 'models/model.eliminar.php';

     // Redireccion
     header('Location: index.php');

?>