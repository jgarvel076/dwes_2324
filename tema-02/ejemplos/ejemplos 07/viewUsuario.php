<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h2>Ejemplo 7 - Tema 2</h2>
    </center>
    
    <table border="1" width="50%">
        <tr>
            <th>Usuarios</th>
            <th>Categorias</th>
            <th>Especialidad</th>
        </tr>
        <tr>
            <!-- <td><?php echo $usuario?></td>
            <td><?php echo $categoria?></td>
            <td><?php echo $especialidad?></td> 
            Esto sería mala práctica -->
            
            <!-- Se debe de hacer así -->
            <td><?= $usuario?></td>
            <td><?= $categoria?></td>
            <td><?= $especialidad?></td>
        </tr>
    </table>
</body>

</html>