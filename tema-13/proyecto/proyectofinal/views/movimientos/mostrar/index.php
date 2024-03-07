<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title><?= $this->title ?></title>
</head>

<body>
    <!-- Menú Principal -->
	<?php require_once("template/partials/menu.php") ?>
	<br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <!-- header -->
        <?php include 'views/movimientos/partials/header.php' ?>

        <legend>Detalles de Movimiento</legend>

        <!-- Formulario Mostrar Movimiento -->
        <form>

            <!-- ID -->
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" name="id" value="<?= $this->movimiento->id ?>" disabled>
            </div>

            <!-- ID de la Cuenta -->
            <div class="mb-3">
                <label for="id_cuenta" class="form-label">ID de la Cuenta</label>
                <input type="text" class="form-control" name="id_cuenta" value="<?= $this->movimiento->id_cuenta ?>" disabled>
            </div>

            <!-- Fecha y Hora -->
            <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                <input type="text" class="form-control" name="fecha_hora" value="<?= $this->movimiento->fecha_hora ?>" disabled>
            </div>

            <!-- Concepto -->
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" class="form-control" name="concepto" value="<?= $this->movimiento->concepto ?>" disabled>
            </div>

            <!-- Tipo -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" name="tipo" value="<?= $this->movimiento->tipo ?>" disabled>
            </div>

            <!-- Cantidad -->
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text" class="form-control" name="cantidad" value="<?= $this->movimiento->cantidad ?>" disabled>
            </div>

            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?= $this->movimiento->saldo ?>" disabled>
            </div>

            <!-- Fecha de Creación -->
            <div class="mb-3">
                <label for="create_at" class="form-label">Fecha de Creación</label>
                <input type="text" class="form-control" name="create_at" value="<?= $this->movimiento->create_at ?>" disabled>
            </div>

            <!-- Fecha de Actualización -->
            <div class="mb-3">
                <label for="update_at" class="form-label">Fecha de Actualización</label>
                <input type="text" class="form-control" name="update_at" value="<?= $this->movimiento->update_at ?>" disabled>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>movimientos" role="button">Volver</a>

        </form>

        <br>
        <br>
        <br>

        <!-- Pié del documento -->
        <?php include 'template/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'template/partials/javascript.php' ?>
</body>

</html>