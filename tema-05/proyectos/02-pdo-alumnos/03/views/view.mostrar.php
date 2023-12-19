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
                <input type="number" class="form-control" value="<?= $alumno->id ?>" disabled>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?= $alumno->nombre ?>" disabled>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" value="<?= $alumno->email ?>" disabled>
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label class="form-label">Télefono</label>
                <input type="number" class="form-control" value="<?= $alumno->telefono ?>" disabled>
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label class="form-label">Población</label>
                <input type="text" class="form-control" value="<?= $alumno->poblacion ?>" disabled>
            </div>
            <!-- Provincia -->
            <div class="mb-3">
                <label for="precio" class="form-label">Provincia </label>
                <input type="text" class="form-control" name="provincia" value="<?= $alumno->provincia; ?>" disabled>
            </div>
            <!-- DNI -->
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" class="form-control" value="<?= $alumno->dni ?>" disabled>
            </div>
            <!-- Edad -->
            <div class="mb-3">
                <label class="form-label">Fecha Nacimiento</label>
                <input type="text" class="form-control" value="<?= $alumno->fechaNac ?>" disabled>
            </div>
            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <?php foreach ($cursos as $curso): ?>
                    <?php if ($curso->id === $alumno->id_curso): ?>
                        <input type="text" class="form-control" name="curso" value="<?= $curso->curso; ?>" disabled>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

        </form>

        <?php $conexion->cerrar_conexion();
        $alumnos = null; ?>


        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>