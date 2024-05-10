<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Cliente</title>
</head>

<body>
    <!-- menú principal fijo superior-->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera -->
        <?php include "views/clientes/partials/header.php" ?>
        <!-- formulario solo lectura -->
        <form>

            <!-- nombre solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $this->cliente->nombre ?>" disabled>
            </div>
            <!-- direccion solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion" value="<?= $this->cliente->direccion ?>" disabled>
            </div>
            <!-- poblacion solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Poblacion</label>
                <input type="text" class="form-control" name="poblacion" value="<?= $this->cliente->poblacion ?>" disabled>
            </div>
            <!-- c_postal solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Codigo postal</label>
                <input type="c_postal" class="form-control" name="c_postal" id="" value="<?= $this->cliente->c_postal ?>" disabled>
            </div>
            <!-- telefono solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="" value="<?= $this->cliente->telefono ?>" disabled>
            </div>
            <!-- email solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="" value="<?= $this->cliente->email ?>" disabled>
            </div>
            <!-- nif solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">NIF</label>
                <input type="text" class="form-control" name="nif" id="" value="<?= $this->cliente->nif ?>" disabled>
            </div>
            <!-- botones acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Volver</a>
            </div>
        </form>
    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>