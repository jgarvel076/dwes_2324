<!DOCTYPE html>
<html lang="es">

<head>

    <?php include "views/layouts/head.html" ?>

</head>

<body>

    <div class="container">

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


            <div class="form-floating mb-3">
                <select class="form-select" aria-label="SeleccionarCategoria" name="categoria">
                    <option disabled>Categorías</option>
                    <?php foreach ($categorias as $key => $categoria): ?>
                    <option value="<?=$key ?>"><?= $categoria ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="categoriaArticulos" class="form-label">Categoria</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="unidades">
                <label for="unidadesArticulos" class="form-label">Unidades</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="precio">
                <label for="precioArticulo" class="form-label">Precio</label>
            </div>



            <button type="submit" class="btn btn-primary" formaction="create.php">Enviar</button>

            <button type="reset" class="btn btn-danger">Borrar</button>

            <a class="btn btn-primary" href="index.php" role="button">Volver</a>




        </form>

    </div>

    <?php
    'views/partials/footer.html';
    ?>

    <?php
    include "views/layouts/javascript.html";
    ?>

</body>

</html>