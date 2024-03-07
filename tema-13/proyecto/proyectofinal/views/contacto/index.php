<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Bootstrap -->
    <?php require_once("template/partials/head.php"); ?>
    <title>Contacto - Gesbank</title>
</head>

<body>
    <?php require_once "template/partials/menuBar.php"; ?>
    <br><br><br>

    <!-- Capa principal -->
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <div class="container">
                <h4 class="display-7">Formulario Contacto</h4>
                <p class="lead">Proyecto Gesbank</p>
            </div>
        </header>

        <!-- Comprobamos errores -->
        <?php include 'template/partials/error.php' ?>
        <?php include 'template/partials/notify.php' ?>

        <!--Formulario-->
        <form action="<?= URL ?>contacto/validar" method="POST">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre"
                    value="<?= isset($this->contacto->nombre) ? $this->contacto->nombre : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!--Mail-->        
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                    value="<?= isset($this->contacto->email) ? $this->contacto->email : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!--Asunto-->
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" name="asunto"
                    value="<?= isset($this->contacto->asunto) ? $this->contacto->asunto : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['asunto'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['asunto'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!--Mensaje-->
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" name="mensaje" rows="5"><?= isset($this->contacto->mensaje) ? $this->contacto->mensaje : '' ?></textarea>
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['mensaje'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['mensaje'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Botones de acción -->
            <div class="mb-3">
                <a href="<?= URL ?>" class="btn btn-secondary" role="button">Cancelar</a>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <br><br>

    <?php require_once "template/partials/footer.php" ?>
    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>