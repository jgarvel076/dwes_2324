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
                        <td><?= $cliente->cliente ?></td> 
                        <td><?= $cliente->direccion ?></td>                        
                        <td><?= $cliente->poblacion ?></td>
                        <td><?= $cliente->c_postal ?></td>
                        <td><?= $cliente->email ?></td>
                        <td><?= $cliente->telefono ?></td>

                        <td><?= $cliente->nif ?></td>
                        <td>
                            <!-- botones de acción -->
                            <a href="<?= URL ?>clientes/delete/<?= $cliente->id ?>" title="Eliminar" onclick="return confirm('¿Quieres Borrar?')"> <i class="bi bi-trash"></i> </a>
                            <a href="<?= URL ?>clientes/editar/<?= $cliente->id ?>" title="Editar"> <i class="bi bi-pencil"></i> </a>
                            <a href="<?= URL ?>clientes/mostrar/<?= $cliente->id ?>" title="Mostrar"> <i class="bi bi-eye"></i> </a>
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