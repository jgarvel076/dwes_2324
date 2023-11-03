<!DOCTYPE html>
<html lang="es">

<head>

    <?php include "views/layouts/head.html" ?>

</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <?php include "views/partials/header.php" ?>

        <legend>Formulario Nuevo Articulo</legend>

        <form action="create.php" method="post">



            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="descripcion">
                <label for="descripcionArticulo" class="form-label">Descripcion:</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="modelo">
                <label for="modeloaArticulo" class="form-label">Modelo</label>
            </div>

            <!-- Marcas -->
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="SeleccionarMarca" name="marcas">
                    <option selected disabled>Seleccione categoría</option>
                    <?php foreach ($marcas as $key => $marca): ?>
                        <option value="<?= $key ?>">
                            <?= $marca ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="marcas" class="form-label">Marcas</label>
            </div>

            <!-- Categorias -->
            <div class="mb-3">
                <label for="categorias" class="form-label">Seleccione Categorias</label>
                <?php foreach ($categorias as $indice => $categoria): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $indice ?>" name="categorias[]">
                        <label class="form-check-label" for="">
                            <?= $categoria ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="form-floating mb-3">
                <input type="Number" class="form-control" name="unidades">
                <label for="unidadesArticulos" class="form-label">Unidades</label>
            </div>

            <div class="form-floating mb-3">
                <input type="Number" class="form-control" name="precio">
                <label for="precioArticulo" class="form-label">Precio</label>
            </div>

            <div class="mb-3">

            </div>



            <button type="submit" class="btn btn-primary" formaction="create.php">Enviar</button>

            <button type="reset" class="btn btn-danger">Borrar</button>

            <a class="btn btn-primary" href="index.php" role="button">Volver</a>




        </form>

    </div>

    <?php
    'views/partials/footer.html';
    ?>
    <!-- javascript bootstrap 512 -->
    <?php
    include "views/layouts/javascript.html";
    ?>

</body>

</html>