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

        <legend>Formulario Editar Alumno</legend>

        <!-- Formulario para editar alumno -->
        <form action="update.php?id=<?= $id_editar ?>" method="POST">
            <!-- id oculto -->
            <!-- <label for="titulo" class="form-label">Id</label> -->
            <input type="hydeen" class="form-control" name="id" value="<?= $corredor->id ?>" hidden>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>">
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>">
            </div>

            <!-- Ciudad -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $corredor->ciudad ?>">
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento" value="<?= $corredor->fechaNacimiento ?>">
            </div>

            <!-- Sexo -->
            <div class="mb-3">
                <label class="form-label">Sexo</label>
                <div class="form-control">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" value="H"
                            <?= ($corredor->sexo === 'H') ? 'checked' : null ?>>
                        <label class="form-check-label">Hombre</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" value="M"
                            <?= ($corredor->sexo === 'M') ? 'checked' : null ?>>
                        <label class="form-check-label">Mujer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" value=""
                            <?= ($corredor->sexo === '') ? 'checked' : null ?>>
                        <label class="form-check-label">Sin Especificar</label>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $corredor->email ?>">
            </div>

            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>">
            </div>

            <!-- Categoria Select -->
            <div class="mb-3">
                <label for="id_curso" class="form-label">Categorias</label>
                <select class="form-select" aria-label="Default select example" name="id_categoria">
                    <option selected disabled>Seleccione Categoría</option>
                    <?php foreach ($categorias as $data): ?>
                        <option value="<?= $data->id ?>" <?= ($data->id == $corredor->id_categoria) ? 'selected' : null ?>>
                            <!-- $data->categoria <- este categoria viene del método get categorias y al igual en el club de abajo -->
                            <?= $data->categoria ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Club Select -->
            <div class="mb-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-select" aria-label="Default select example" name="id_club">
                    <option selected disabled>Seleccione Club</option>
                    <?php foreach ($clubs as $data): ?>
                        <option value="<?= $data->id ?>" <?= ($data->id == $corredor->id_club) ? 'selected' : null ?>>
                            <?= $data->club ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
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