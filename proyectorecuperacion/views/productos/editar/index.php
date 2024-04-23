<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>

    <title>Editar Producto</title>
</head>

<body>
    <!-- menú principal -->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera  -->
        <?php include "views/productos/partials/header.php" ?>
        <!-- Formulario -->
        <form action="<?= URL ?>productos/update/<?= $this->id ?>" method="POST">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $this->producto->nombre ?>">
            </div>
            <!-- Ean_13 -->
            <div class="mb-3">
                <label for="" class="form-label">Ean_13</label>
                <input type="text" class="form-control" name="ean_13" value="<?= $this->producto->ean_13 ?>">
            </div>
            <!-- descripcion -->
            <div class="mb-3">
                <label for="" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $this->producto->descripcion ?>">
            </div>
            <!-- categoria -->
            <div class="mb-3">
                <label for="" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria" value="<?= $this->producto->categoria ?>">
            </div>
            <!-- precio_venta -->
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio_venta" id="" value="<?= $this->producto->precio_venta ?>">
            </div>
            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="stock" class="form-control" name="stock" id="" value="<?= $this->producto->stock ?>">
            </div>
            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>productos" role="button">Cancelar</a>
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