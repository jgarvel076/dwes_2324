<!DOCTYPE html>
<html lang="es">

<head>

    <?php include "views/layouts/head.html" ?>

</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <?php include "views/partials/header.php" ?>

        <legend>Tabla Artículos</legend>

        <?php
        include 'views/partials/menu_prin.php';
        ?>

        <table class="table">
            <thead>
                <!-- Encabezado Tabla -->
                <tr>

                    <!-- Personalizado -->
                    <th>Id</th>
                    <th>Desripción</th>
                    <th>Modelo</th>
                    <th>Marcas</th>
                    <th>Categorias</th>
                    <th class="text-end">Unidades</th>
                    <th class="text-end">Precio</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php foreach ($articulos as $articulo): ?>
                    <tr>
                        
                        <td><?= $articulo['id'] ?></td>
                        <td><?= $articulo['descripcion'] ?></td>
                        <td><?= $articulo['modelo'] ?></td>
                        <td><?= $marcas[$articulo['marca']] ?></td>
                        <td><?= implode(", ", mostrarCategoria($categorias, $articulo['categoria']))?></td>
                        <td class="text-end"><?= $articulo['unidades'] ?></td>
                        <td class="text-end"><?= number_format($articulo['precio'], 2, ',', '.') ?> €</td>

                        <td>
                            <a href="eliminar.php?id=<?= $articulo['id'] ?>">
                                <i class="bi bi-trash-fill"></i></a>
                            <a href="editar.php?id=<?= $articulo['id'] ?>">
                                <i class="bi bi-pen-fill"></i></a>
                            <a href="mostrar.php?id=<?= $articulo['id'] ?>">
                                <i class="bi bi-eye"></i></a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"> Nº Libros:
                        <?= count($articulos); ?>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

    <?php
    'views/partials/footer.html';
    ?>
    <!-- javascript bootstrap 512 -->
    <?php
    include "views/layouts/javascript.html";
    ?>
</body>

</html>