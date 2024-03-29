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

        <legend>Formulario Nuevo Movimiento</legend>

        <!-- Formulario Nuevo Movimiento -->
        <form action="<?= URL ?>movimientos/create" method="POST">

            <!-- Id_cuenta -->
            <div class="mb-3">
                    <label for="cuenta" class="form-label">Cuenta del Movimiento</label>
                    <select class="form-select <?= (isset($this->errores['cuenta'])) ? 'is-invalid' : null ?>" name="cuenta" id="cuenta">
                        <option selected disabled>Seleccione un cliente</option>
                        <?php foreach ($this->cuentas as  $cuenta) : ?>
                            <option value="<?= $cuenta->id ?>"  <?= ($cuenta->id == $this->movimiento->id_cuenta) ? 'selected' : null ?>>
                                <?= $cuenta->num_cuenta ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            <!-- Fecha y Hora -->
            <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                <input type="datetime-local" class="form-control" name="fecha_hora">
            </div>

            <!-- Concepto -->
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" class="form-control" name="concepto" maxlength="50">
            </div>

            <!-- Tipo -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" name="tipo">
                    <option value="I">Ingreso</option>
                    <option value="R">Reintegro</option>
                </select>
            </div>

            <!-- Cantidad -->
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" step="0.01">
            </div>


            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>movimientos" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary" onclick="return validarMovimiento()">Enviar</button>

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