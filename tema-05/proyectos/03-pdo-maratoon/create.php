<?php
    /**
     * 
     * Controlador create.php
     * 
     */

     // Cargamos las constantes correspondientes
     include 'config/db.php';

     // Cargamos las clases necesarias
     include 'class/class.conexion.php';
     include 'class/class.corredor.php';
     include 'class/class.corredores.php';

     // Cargamos el modelo
     include 'models/model.create.php';

     // Rediccionamos
     header('Location: index.php');

?>