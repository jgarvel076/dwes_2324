<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Clientes</title>
</head>

<body>
    <div class="container" style="padding-top: 2%;">
        <!-- menu fijo superior -->
        <?php require_once "template/partials/menu.php"; ?>
        <!-- cabecera  -->
        <?php include "views/clientes/partials/header.php" ?>
        <!-- Menu principal -->
        <?php require_once "views/clientes/partials/menu.php" ?>
        <!-- Mensajes -->
        <?php include "template/partials/mensaje.php"?>
        <!-- Errores -->
        <?php include "template/partials/error.php"?>
        <!-- Modal -->
        <?php require "views/clientes/partials/modal.php" ?>
        <!-- tabla clientes -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>Cliente</th>
                    <th>Direccion</th>
                    <th>Poblacion</th>
                    <th>Codigo Postal</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>NIF</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->clientes as $cliente) : ?>
                    <tr>
                        <td><?= $cliente->id ?></td>
                        <td><?= $cliente->nombre ?></td> 
                        <td><?= $cliente->direccion ?></td>                        
                        <td><?= $cliente->poblacion ?></td>
                        <td><?= $cliente->c_postal ?></td>
                        <td><?= $cliente->telefono ?></td>
                        <td><?= $cliente->email ?></td>
                        <td><?= $cliente->nif ?></td>
                        <td>
                            <!-- botones de acción -->
                            <a href="<?= URL ?>clientes/delete/<?= $cliente->id ?>" title="Eliminar"
                                onclick="return confirm('¿Quieres Borrar?')" Class="btn btn-danger
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['clientes']['delete'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-trash"></i> </a>

                            <a href="<?= URL ?>clientes/edit/<?= $cliente->id ?>" title="Editar" Class="btn btn-primary
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['clientes']['edit'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-pencil"></i> </a>
                                                
                            <a href="<?= URL ?>clientes/show/<?= $cliente->id ?>" title="Mostrar" Class="btn btn-primary
                                            <?= (!in_array($_SESSION['id_rol'], $GLOBALS['clientes']['show'])) ?
                                                'disabled' : null ?>"> <i class="bi bi-eye"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Nº clientes: <?= $this->clientes->rowCount() ?> </td>
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