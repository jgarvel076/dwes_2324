<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 5.1 - Gestión Alumnos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <!-- Notificación -->
        <?php include 'views/partials/notificacion.php' ?>

        <form>
            <div class="mb-3">
                <label class="form-label">Id</label>
                <input type="number" class="form-control" value="<?= $corredor->id ?>" disabled>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?= $corredor->nombre ?>" disabled>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" value="<?= $corredor->email ?>" disabled>
            </div>

            <!-- Ciudad -->
            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input type="text" class="form-control" value="<?= $corredor->ciudad ?>" disabled>
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label class="form-label">Fecha Nacimiento</label>
                <input type="text" class="form-control" value="<?= $corredor->fechaNacimiento ?>" disabled>
            </div>

            <!-- DNI -->
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" value="<?= $corredor->dni ?>" disabled>
            </div>
            <!-- Edad -->
            <div class="mb-3">
                <label class="form-label">Fecha Nacimiento</label>
                <input type="text" class="form-control" value="<?= $corredor->edad ?>" disabled>
            </div>
            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <?php foreach ($clubs as $club): ?>
                    <?php if ($club->id === $corredor->id_club): ?>
                        <input type="text" class="form-control" name="categoria" value="<?= $club->club; ?>" disabled>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <?php foreach ($categorias as $categoria): ?>
                    <?php if ($categoria->id === $corredor->id_categoria): ?>
                        <!-- $data->categoria <- este categoria viene del método get categorias y al igual en el club de arriba -->
                        <input type="text" class="form-control" name="categoria" value="<?= $categoria->categoria; ?>" disabled>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
            </div>

        </form>

        <?php $conexion->cerrar_conexion();
        $alumnos = null; ?>

        <!-- Es necesario poner los br para ver el botón y que no se superponga en footer a este -->
        <br>
        <br>
        <br>
        <br>


        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>