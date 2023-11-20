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

        <legend>Formulario Edicion Articulo</legend>

        <form action="update.php?id=<?= $id ?>" method="POST">

            <!-- DESCRIPCIÓN -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $articulo['descripcion'] ?>">
            </div>

            <!-- MODELO -->
            <div class="mb-3">
                <label for="autor" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $articulo['modelo'] ?>">
            </div>

            <!-- MARCAS -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" aria-label="SeleccionarMarca" name="marca">

                    <?php foreach ($marcas as $key => $marca): ?>
                        <option value="<?= $key ?>" <?= ($articulo['marca'] == $key) ? 'selected' : null ?>>

                            <?= $marca ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- CATEGORÍAS -->
            <div class="mb-3">
                <label for="categorias" class="form-label">Seleccione Categorias</label>
                <?php foreach ($categorias as $indice => $categoria): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $indice ?>" name="categorias[]"
                            <?= (in_array($indice, $articulo['categoria']) ? 'checked' : null) ?>>
                        <label class="form-check-label" for="">
                            <?= $categoria ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- UNIDADES -->
            <div class="mb-3">
                <label for="precio" class="form-label">Unidades</label>
                <input type="number" class="form-control" name="unidades" step="0.01"
                    value="<?= $articulo['unidades'] ?>">
            </div>

            <!-- PRECIOS -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo['precio'] ?>">
            </div>

            <!-- BOTONES DE ACCIÓN -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>

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