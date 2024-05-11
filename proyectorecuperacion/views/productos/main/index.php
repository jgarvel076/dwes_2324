<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Productos</title>
</head>

<body>
    <div class="container" style="padding-top: 2%;">
        <!-- menu fijo superior -->
        <?php require_once "template/partials/menu.php"; ?>
        <!-- cabecera  -->
        <?php include "views/productos/partials/header.php" ?>
        <!-- Menu principal -->
        <?php require_once "views/productos/partials/menu.php" ?>
        <!-- Modal -->
        <?php require "views/productos/partials/modal.php" ?>
        <!-- tabla productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>Producto</th>
                    <th>ean_13</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->productos as $producto) : ?>
                    <tr>
                        <td><?= $producto->id ?></td>
                        <td><?= $producto->nombre ?></td> 
                        <td><?= $producto->ean_13 ?></td> 
                        <td><?= $producto->descripcion ?></td>                  
                        <td><?= $producto->stock ?></td>
                        <td><?= $producto->precio_venta ?></td>
                        <td>
                            <!-- botones de acción -->
                            <a href="<?= URL ?>productos/delete/<?= $producto->id ?>" title="Eliminar" onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                            <a href="<?= URL ?>productos/edit/<?= $producto->id ?>" title="Editar"> <i class="bi bi-pencil"></i> </a>
                            <a href="<?= URL ?>productos/show/<?= $producto->id ?>" title="Mostrar"> <i class="bi bi-eye"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº productos: <?= $this->productos->rowCount() ?> </td>
                </tr>
            </tfoot>

        </table>

    </div>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>