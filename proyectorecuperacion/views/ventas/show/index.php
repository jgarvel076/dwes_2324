<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Editar Venta</title>
</head>

<body>
    <!-- menú principal fijo superior-->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera -->
        <?php include "views/ventas/partials/header.php" ?>
        <!-- formulario solo lectura -->
        <form>

            <!-- Cliente solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Cliente</label>
                <input type="text" class="form-control" name="Cliente" value="<?= $this->venta->Cliente ?>" disabled>
            </div>
            <!-- importe_total solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">Importe</label>
                <input type="text" class="form-control" name="importe_total" value="<?= $this->venta->importe_total ?>" disabled>
            </div>
            <!-- estado solo lectura -->
            <div class="mb-3">
                <label for="" class="form-label">estado</label>
                <input type="text" class="form-control" name="estado" value="<?= $this->venta->estado ?>" disabled>
            </div>
            <!-- botones acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>ventas" role="button">Volver</a>
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