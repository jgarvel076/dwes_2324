<?php 
$servidor = 'localhost';
$user = 'root';
$password = '';
$bd = 'fp654654';


#conexion
$conexion = mysqli_connect($servidor, $user, $password, $bd);

if(mysqli_connect_errno()){
    echo "Error de conexion nº: ";
    echo '</br>';
    echo "Error en la base de datos". mysqli_connect_error();
    exit();
}

echo 'Conexion establecida con exito.'

?>