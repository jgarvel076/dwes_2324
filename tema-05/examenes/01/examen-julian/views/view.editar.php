<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/head.html' ?>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Formulario Editar Libro</legend>

        <!-- Formulario para editar alumno -->
        <form action="update.php?id=<?= $id_editar ?>" method="POST">
            <!-- id oculto -->
            <!-- <label for="titulo" class="form-label">Id</label> -->
            <input type="hydeen" class="form-control" name="id" value="<?= $libro->id ?>" hidden>

            <!-- titulo -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">titulo</label>
                <input type="date" class="form-control" name="fechaNac" value="<?= $libro->titulo ?>">
            </div>
            <!-- autor -->
            <div class="mb-3">
                <label for="dni" class="form-label">autor</label>
                <input type="text" class="form-control" name="dni" value="<?= $libro->autor ?>">
            </div>

            <!-- editorial -->
            <div class="mb-3">
                <label for="email" class="form-label">editorial</label>
                <input type="email" class="form-control" name="email" value="<?= $libro->editorial ?>">
            </div>

            <!-- paginas -->
            <div class="mb-3">
                <label for="email" class="form-label">paginas</label>
                <input type="email" class="form-control" name="email" value="<?= $libro->paginas ?>">
            </div>

            <!-- Unidades -->
            <div class="mb-3">
                <label for="email" class="form-label">Unidades</label>
                <input type="email" class="form-control" name="email" value="<?= $libro->Unidades ?>">
            </div>

            <!-- Coste -->
            <div class="mb-3">
                <label for="email" class="form-label">Coste</label>
                <input type="email" class="form-control" name="email" value="<?= $libro->Coste ?>">
            </div>

            <!-- PVP -->
            <div class="mb-3">
                <label for="email" class="form-label">PVP</label>
                <input type="email" class="form-control" name="email" value="<?= $libro->PVP ?>">
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Restablecer</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>

        </form>

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