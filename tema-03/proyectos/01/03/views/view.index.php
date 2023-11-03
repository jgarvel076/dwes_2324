<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "views/layouts/head.html" ?>
    <title>Proyecto 3.1 - Gestión Libros</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-4">Proyecto 3.1 - Gestión de libros</span>

        </header>
        <legend>Tabla libros</legend>
        
        <?php 
            include 'views/partials/menu_prin.php';
        ?>

        <table class="table">
            <thead>
                <!-- Encabezado Tabla -->
                <tr>
                    <!-- <//?php foreach (array_keys($libros[0]) as $clave): ?>
                        //<th><//?= $clave ?></th>
                    <//?php endforeach; ?> -->

                    <!-- Personalizado -->
                    <th>Id</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <!-- Mismo formato a cada campo de la Tabla -->
                        <?php foreach ($libro as $campo): ?>
                            <td>
                                <?= $campo ?>
                            </td>
                        <?php endforeach; ?>

                        <td>
                            <a href="eliminar.php?id=<?= $libro['id']?>">
                            <i class="bi bi-trash-fill">
                        </td>
                        <td>
                            <a href="editar.php?id=<?= $libro['id']?>">
                            <i class="bi bi-pen-fill">
                        </td>
                        

                        <!-- También se puede hacer de esta otra forma -->
                        <!-- 
                        <td><?= $titulo['id'] ?></td>
                        <td><?= $libro['id'] ?></td> 
                        -->
                    </tr>
                <?php endforeach; ?>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"> Nº Libros:
                        <?= count($libros); ?>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

    <!-- javascript bootstrap 512 -->
    <?php
    include "views/layouts/javascript.html";
    ?>
</body>

</html>