<?php 
$servidor = 'localhost';
$user = 'root';
$password = '';
$bd = 'fp';


#conexion
$conexion = new mysqli($servidor, $user, $password, $bd);

if($conexion -> connect_errno){
    echo "Error de conexion nº: ". $conexion -> connect_errno;
    echo '</br>';
    echo "Error en la base de datos". $conexion -> connect_errno;
    exit();
}

echo 'Conexion establecida con exito.';

#creamos variable para la ejecuciob comando sql
$sql = 'select * from alumnos order by id';

#metodo query devolvemos un objeto de la clase result
$result = $conexion -> query($sql);

echo '</br>';
echo 'Numero de registros:'. $result -> num_rows;
echo '</br>';
echo 'Numero de columnas:'. $result -> field_count;
echo '</br>';

$alumnos = $result -> fetch_all(MYSQLI_BOTH);
#Constante MYSQLI_BOTH devuelve un array indexado y uno asociativo

$alumno = $alumnos[0];

var_dump($alumno);
?>