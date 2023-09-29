<!DOCTYPE html>
<html>
<head>
    <title>Información de alumnos</title>
</head>
<body>
    <h1>Información de alumnos</h1>
    
    <?php
    $nombre = "Julian";
    $apellidos = "Garcia Velazquez";
    $poblacion = "Prado del rey";
    $edad = 18;
    $ciclo = "Desarrollo de Aplicaciones Web";
    $curso = "2er Curso";
    $modulo = "Programación PHP";

    echo '<table border="1">';
    echo '<tr><th>Campo</th><th>Valor</th></tr>';
    
    echo '<tr><td>Nombre</td><td>' . $nombre . '</td></tr>';
    echo '<tr><td>Apellidos</td><td>' . $apellidos . '</td></tr>';
    echo '<tr><td>Población</td><td>' . $poblacion . '</td></tr>';
    echo '<tr><td>Edad</td><td>' . $edad . '</td></tr>';
    echo '<tr><td>Ciclo</td><td>' . $ciclo . '</td></tr>';
    echo '<tr><td>Curso</td><td>' . $curso . '</td></tr>';
    echo '<tr><td>Módulo</td><td>' . $modulo . '</td></tr>';
    
    echo '</table>';
    ?>
    <p>
        <?php
        echo "El alumno ".$nombre." ".$apellidos." con residencia en ".$poblacion ." tiene ".$edad ." años, cursa ".$ciclo ." en el ".$curso ."  en el que esta aprendiendo ".$modulo;
        ?>
    </p>
</body>
</html>