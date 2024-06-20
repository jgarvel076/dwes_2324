<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php");  ?>
    <title>Añadir producto</title>

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
                <input type="text" class="form-control <?= (isset($this->errores['nombre']))? 'is-invalid': null ?>" name="nombre" value="<?=$this->producto->nombre?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- ean_13 -->
            <div class="mb-3">
                <label for="" class="form-label">Ean_13</label>
                <input type="text" class="form-control <?= (isset($this->errores['ean_13']))? 'is-invalid': null ?>" name="ean_13" value="<?=$this->producto->ean_13?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['ean_13'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['ean_13'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- descripcion -->
            <div class="mb-3">
                <label for="" class="form-label">Descripcion</label>
                <input type="text" class="form-control <?= (isset($this->errores['descripcion']))? 'is-invalid': null ?>" name="descripcion" value="<?=$this->producto->descripcion?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['descripcion'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['descripcion'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- precio_venta -->
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="text" class="form-control <?= (isset($this->errores['precio_venta']))? 'is-invalid': null ?>" name="precio_venta" value="<?=$this->producto->precio_venta?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['precio_venta'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['precio_venta'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="text" class="form-control <?= (isset($this->errores['stock']))? 'is-invalid': null ?>" name="stock" value="<?=$this->producto->stock?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['stock'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['stock'] ?>
                    </span>
                <?php endif; ?>
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