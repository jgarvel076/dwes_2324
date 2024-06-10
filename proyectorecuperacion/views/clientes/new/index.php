<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Añadir Cliente</title>

</head>

<body>
    <!-- menu fijo superior -->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera -->
        <?php include "views/clientes/partials/header.php" ?>
        <!-- Mensaje en caso de error -->
        <?php include("template/partials/error.php") ?>
        <!-- formulario  -->
        <form action="<?= URL ?>clientes/create" method="POST">
            <!-- nombre -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <!-- direccion -->
            <div class="mb-3">
                <label for="" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion">
            </div>
            <!-- poblacion -->
            <div class="mb-3">
                <label for="" class="form-label">Poblacion</label>
                <input type="text" class="form-control" name="poblacion">
            </div>
            <!-- c_postal -->
            <div class="mb-3">
                <label for="" class="form-label">Codigo postal</label>
                <input type="text" class="form-control" name="c_postal" id="">
            </div>
            <!-- telefono -->
            <div class="mb-3">
                <label for="" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="">
            </div>
            <!-- email -->
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="">
            </div>
            <!-- NIF -->
            <div class="mb-3">
                <label for="" class="form-label">NIF</label>
                <input type="text" class="form-control" name="nif" id="">
            </div>
            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Crear</button>
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