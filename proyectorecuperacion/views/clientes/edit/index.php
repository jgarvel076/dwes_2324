<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>

    <title>Editar Cliente</title>
</head>

<body>
    <!-- menú principal -->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera  -->
        <?php include "views/clientes/partials/header.php" ?>
        <!-- Errores -->
        <?php include "template/partials/error.php"?>
        <!-- Formulario -->
        <form action="<?= URL ?>clientes/update/<?= $this->id ?>" method="POST">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $this->cliente->nombre ?>">
            </div>
            <!-- direccion -->
            <div class="mb-3">
                <label for="" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion" value="<?= $this->cliente->direccion ?>">
            </div>
            <!-- poblacion -->
            <div class="mb-3">
                <label for="" class="form-label">Poblacion</label>
                <input type="text" class="form-control" name="poblacion" value="<?= $this->cliente->poblacion ?>">
            </div>
            <!-- c_postal -->
            <div class="mb-3">
                <label for="" class="form-label">Codigo postal</label>
                <input type="text" class="form-control" name="c_postal" id="" value="<?= $this->cliente->c_postal ?>">
            </div>
            <!-- telefono -->
            <div class="mb-3">
                <label for="" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="" value="<?= $this->cliente->telefono ?>">
            </div>
            <!-- email -->
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="" value="<?= $this->cliente->email ?>">
            </div>
            <!-- nif -->
            <div class="mb-3">
                <label for="" class="form-label">NIF</label>
                <input type="text" class="form-control" name="nif" id="" value="<?= $this->cliente->nif ?>">
            </div>
            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
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