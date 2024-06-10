<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Añadir Producto</title>

</head>

<body>
    <!-- menu fijo superior -->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera -->
        <?php include "views/productos/partials/header.php" ?>
        <!-- Mensaje en caso de error -->
        <?php include("template/partials/error.php") ?>
        <!-- formulario  -->
        <form action="<?= URL ?>productos/create" method="POST">
            <!-- nombre -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <!-- ean_13 -->
            <div class="mb-3">
                <label for="" class="form-label">Ean_13</label>
                <input type="text" class="form-control" name="ean_13">
            </div>
            <!-- descripcion -->
            <div class="mb-3">
                <label for="" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion">
            </div>
            <!-- precio_venta -->
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="text" class="form-control" name="c_postal" id="">
            </div>
            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="text" class="form-control" name="stock" id="">
            </div>
            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>productos" role="button">Cancelar</a>
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