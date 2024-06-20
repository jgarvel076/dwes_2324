<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Ventas</title>
</head>

<body>
    <div class="container" style="padding-top: 2%;">
        <!-- menu fijo superior -->
        <?php require_once "template/partials/menu.php"; ?>
        <!-- cabecera  -->
        <?php include "views/ventas/partials/header.php" ?>
        <!-- Menu principal -->
        <?php require_once "views/ventas/partials/menu.php" ?>
        <!-- Mensajes -->
        <?php include "template/partials/mensaje.php"?>
        <!-- Errores -->
        <?php include "template/partials/error.php"?>
        <!-- Modal -->
        <?php require "views/ventas/partials/modal.php" ?>
        <!-- tabla ventas -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>Cliente</th>
                    <th>Importe</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->ventas as $venta) : ?>
                    <tr>
                        <td><?= $venta->id ?></td>
                        <td><?= $venta->cliente_id ?></td> 
                        <td><?= $venta->importe_total ?></td>                        
                        <td><?= $venta->estado ?></td>
                        <td>
                            <!-- botones de acción -->
                            <a href="<?= URL ?>ventas/delete/<?= $venta->id ?>" title="Eliminar"
                                onclick="return confirm('¿Quieres Borrar?')" Class="btn btn-danger
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['delete'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-trash"></i> </a>

                            <a href="<?= URL ?>ventas/edit/<?= $venta->id ?>" title="Editar" Class="btn btn-primary
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['edit'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-pencil"></i> </a>
                                                
                            <a href="<?= URL ?>ventas/show/<?= $venta->id ?>" title="Mostrar" Class="btn btn-primary
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['show'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-eye"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº ventas: <?= $this->ventas->rowCount() ?> </td>
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