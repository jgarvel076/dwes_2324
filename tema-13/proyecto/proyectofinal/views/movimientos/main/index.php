<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Movimientos</title>
</head>

<body>
 <!-- capa principal -->
 <div class="container" style="padding-top: 2%;">
        <!-- menu fijo superior -->
        <?php require_once "template/partials/menuAut.php"; ?>
        <!-- cabecera  -->
        <?php include "views/movimientos/partials/header.php" ?>
        <!-- Mensajes -->
        <?php include 'template/partials/notify.php' ?>
        <!-- errores -->
        <?php include "template/partials/error.php"?>


        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                Tabla de Movimientos
            </div>
            <div class="card-header">
                <!-- menú movimientos -->
                <?php require_once("views/movimientos/partials/menu.php") ?>
            </div>
            <div class="card-body">

                <!-- Muestra datos de la tabla -->
                <table class="table">
                    <!-- Encabezado tabla -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nº Cuenta</th>
                            <th>Fecha y Hora</th>
                            <th>Concepto</th>
                            <th>Tipo</th>
                            <th class="text-end">Cantidad</th>
                            <th class="text-end">Saldo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Mostramos cuerpo de la tabla -->
                    <tbody>

                        <!-- Objeto clase pdostatement en foreach -->
                        <?php foreach ($this->movimientos as $movimiento): ?>
                            <tr>
                                <!-- Detalles de movimiento -->
                                <td><?= $movimiento->id ?></td>
                                <td><?= $movimiento->num_cuenta ?></td>
                                <td><?= $movimiento->fecha_hora ?></td>
                                <td><?= $movimiento->concepto ?></td>
                                <td><?= $movimiento->tipo ?></td>
                                <td class="text-end"><?= number_format($movimiento->cantidad, 0, ',', '.') ?></td>
                                <td class="text-end"><?= number_format($movimiento->saldo, 2, ',', '.') ?> €</td>

                                <!-- botones de acción -->
                                <td>
                                    <!-- botón mostrar -->
                                    <a href="<?= URL ?>movimientos/mostrar/<?= $movimiento->id ?>" title="Mostrar">
                                        <i class="bi bi-card-text"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <small class="text-muted"> Nº movimientos: <?= $this->movimientos->rowCount(); ?></small>
            </div>
        </div>
    </div>
    <br><br><br>

    <?php require_once("template/partials/footer.php") ?>
    <?php require_once("template/partials/javascript.php") ?>

</body>

</html>