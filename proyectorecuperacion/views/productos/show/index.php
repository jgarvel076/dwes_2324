<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Producto</title>
</head>

<body>
    <!-- menú principal fijo superior-->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera -->
        <?php include "views/productos/partials/header.php" ?>
        <!-- formulario solo lectura -->
        <form>

            <!-- nombre solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $this->producto->nombre ?>" disabled>
            </div>
            <!-- ean_13 solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Ean_13</label>
                <input type="text" class="form-control" name="ean_13" value="<?= $this->producto->ean_13 ?>" disabled>
            </div>
            <!-- descripcion solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $this->producto->descripcion ?>" disabled>
            </div>

            <!-- precio_venta solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="precio_venta" class="form-control" name="precio_venta" id="" value="<?= $this->producto->precio_venta ?>" disabled>
            </div>
            <!-- stock solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="text" class="form-control" name="stock" id="" value="<?= $this->producto->stock ?>" disabled>
            </div>
            <!-- botones acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>productos" role="button">Volver</a>
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