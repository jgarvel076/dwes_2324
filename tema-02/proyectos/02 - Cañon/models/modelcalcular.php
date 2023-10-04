<?php

//Declaro la constante de la gravedad
define ("g",9.81);

//Obtenemos los valores del formulario
$velocidadInicial = $_POST["VelocidadInicial"];
$anguloLanzamiento = $_POST["AnguloLanzamiento"];
$angulo = deg2rad($anguloLanzamiento);

//Calculamos movimientos proyectil
$Vox =$velocidadInicial * cos($angulo);
$Voy =$velocidadInicial * sin($angulo);
$t =2 * ($Voy / g);
$Xmax =(pow($velocidadInicial,2) * sin($angulo * 2)) / g;
$Ymax =(pow($velocidadInicial,2) * pow(sin($angulo),2)) / (2 * g);

$angulo = number_format($angulo, 5, ",",".");
$Vox = number_format($Vox, 2,",",".");
$Voy = number_format($Voy, 2,",",".");
$Xmax = number_format($Xmax, 2,",",".");
$t = number_format($t, 2,",",".");
$Ymax = number_format($Ymax, 2,",",".");

?>