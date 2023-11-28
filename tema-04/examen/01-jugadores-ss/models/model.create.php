<?php

$jugadores = new tablaJugadores();
$jugadores -> getDatos();

$posiciones = tablaJugadores::getPosiciones();
$equipos = tablaJugadores::getEquipos();
$paises = tablaJugadores::getPaises();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$numero = $_POST['numero'];
$paises = $_POST['paises'];
$equipos = $_POST['equipos'];
$posiciones = $_POST['posiciones'];
$contrato = $_POST['contrato'];

 
$jugador = new Jugador(
    $id,
    $nombre,
    $numero,
    $paises,
    $equipos,
    $posiciones,
    $contrato
);


$jugadores -> create($jugador);

$t_jugadores = $jugadores-> getTabla();

?>