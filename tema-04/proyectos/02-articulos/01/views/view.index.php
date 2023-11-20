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
                    <th>Descripción</th>
                    <th>Modelo</th>
                    <th>Marcas</th>
                    <th>Categorias</th>
                    <th class="text-end">Unidades</th>
                    <th class="text-end">Precio</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>

                <?php foreach ($articulos->getTabla() as $articulo): ?>
                    <tr>

                        <td>
                            <?= $articulo->getId() ?>
                        </td>
                        <td>
                            <?= $articulo->getDescripcion() ?>
                        </td>
                        <td>
                            <?= $articulo->getModelo() ?>
                        </td>
                        <td>
                            <?= $marcas[$articulo->getMarca()] ?>
                        </td>
                        <td>
                            <?= implode(", ", ArrayArticulo::mostrarCategoria($categorias, $articulo->getCategorias())) ?>
                        </td>
                        <td class="text-end">
                            <?= $articulo->getUnidades() ?>
                        </td>
                        <td class="text-end">
                            <?= number_format($articulo->getPrecio(), 2, ',', '.') ?> €
                        </td>

                        <td>
                            <!-- botón  eliminar -->
                            <a href="eliminar.php?indice=<?= $indice ?>" title="Eliminar">
                                <i class="bi bi-trash-fill"></i></a>

                            <!-- botón  editar -->
                            <a href="editar.php?indice=<?= $indice ?>" title="Editar">
                                <i class="bi bi-pencil-square"></i></a>

                            <!-- botón  mostrar -->
                            <a href="mostrar.php?indice=<?= $indice ?>" title="Mostrar">
                                <i class="bi bi-card-text"></i></a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
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