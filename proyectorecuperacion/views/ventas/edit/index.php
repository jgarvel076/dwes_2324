<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>

    <title>Editar Venta</title>
</head>

<body>
    <!-- menú principal -->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera  -->
        <?php include "views/ventas/partials/header.php" ?>
        <!-- Errores -->
        <?php include "template/partials/error.php"?>
        <!-- Formulario -->
        <form action="<?= URL ?>ventas/update/<?= $this->id ?>" method="POST">
            <!-- clientes_id -->
            <div class="mb-3">
                <label for="" class="form-label">Clientes</label>
                <input type="text" class="form-control <?= (isset($this->errores['clientes_id']))? 'is-invalid': null ?>" name="clientes_id" value="<?=$this->venta->clientes_id?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['clientes_id'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['clientes_id'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- importe_total -->
            <div class="mb-3">
                <label for="" class="form-label">Importe</label>
                <input type="text" class="form-control <?= (isset($this->errores['importe_total']))? 'is-invalid': null ?>" name="importe_total" value="<?=$this->venta->importe_total?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['importe_total'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['importe_total'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- estado -->
            <div class="mb-3">
                <label for="" class="form-label">Estado</label>
                <input type="text" class="form-control <?= (isset($this->errores['estado']))? 'is-invalid': null ?>" name="estado" value="<?=$this->venta->estado?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['estado'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['estado'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>ventas" role="button">Cancelar</a>
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