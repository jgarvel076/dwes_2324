<?php
/**
 * Modelo create.php
 * Capturamos a tráves del método POST 
 * 
 */

// Asignamos a unas variables los valores del formulario enviados a traves del método POST
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$sexo = $_POST['sexo'];
$fechaNac = $_POST['fechaNacimiento'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$categoria = $_POST['id_categoria'];
$club = $_POST['id_club'];

// Creamos un objeto de la clase Corredor
$corredor = new Corredor();

// Añadimos al nuevo objeto los datos del formulario
$corredor->nombre = $nombre;
$corredor->apellidos = $apellidos;
$corredor->ciudad = $ciudad;
$corredor->fechaNacimiento = $fechaNac;
$corredor->sexo = $sexo;
$corredor->email = $email;
$corredor->dni = $dni;
$corredor->id_categoria = $categoria;
$corredor->id_club = $club;

// Conectamos a la base de datos
$conexion = new Corredores();

// Inserto el registro en la tabla corredores
$conexion->insertCorredor($corredor);
?>