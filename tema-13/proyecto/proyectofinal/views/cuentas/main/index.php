<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Cuentas - GESBANK</title>
</head>

<body>
    <!-- capa principal -->
    <div class="container" style="padding-top: 2%;">
        <!-- menu fijo superior -->
        <?php require_once "template/partials/menuAut.php"; ?>
        <!-- cabecera o titulo -->
        <?php include "views/cuentas/partials/header.php" ?>
         <!-- Mensajes -->
         <?php include "template/partials/notify.php"?>
        <!-- Errores -->
        <?php include "template/partials/error.php"?>
        <!--Modal-->
        <?php include "views/cuentas/partials/modal.php" ?>
        
        <!-- Menu principal -->
        <?php require_once "views/cuentas/partials/menu.php" ?>
        <table class="table">
            <thead>
                <tr>

                    <th>Id </th>
                    <th>Numero de cuenta</th>
                    <th>Cliente</th>
                    <th>Fecha Alta</th>
                    <th>Fecha ultimo movimiento</th>
                    <th class="text-end">Num_movtos</th>
                    <th class="text-end">Saldo</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->cuentas as $cuenta) : ?>
                    <tr>
                        <td><?= $cuenta->id ?></td>
                        <td><?= $cuenta->num_cuenta ?></td>
                        <td><?= $cuenta->cliente ?></td>
                        <td><?= $cuenta->fecha_alta ?></td>
                        <td><?= $cuenta->fecha_ul_mov ?></td>
                        <td class="text-end"><?= number_format($cuenta->num_movtos, 0, ',', '.')?></td>
                        <td class="text-end"><?= number_format($cuenta->saldo, 2, ',', '.')?> €</td>
                        <td>
                            <!-- botones de acción -->
                            <a href="<?= URL ?>cuentas/delete/<?= $cuenta->id ?>" title="Eliminar"
                                onclick="return confirm('¿Quieres Borrar?')" Class="btn btn-danger
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['delete'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-trash"></i> </a>

                            <a href="<?= URL ?>cuentas/editar/<?= $cuenta->id ?>" title="Editar" Class="btn btn-primary
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['edit'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-pencil"></i> </a>
                            <a href="<?= URL ?>cuentas/mostrar/<?= $cuenta->id ?>" title="Mostrar" Class="btn btn-primary
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['show'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-eye"></i> </a>
                            <!-- botón mostrar movimientos -->
							<a href="<?= URL ?>cuentas/tablaMovimientos/<?= $cuenta->id ?> ?>" title="Mostrar Movimientos"><i class="bi bi-bar-chart-line-fill"></i></a>
									
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Nº Registros: <?= $this->cuentas->rowCount() ?> </td>
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