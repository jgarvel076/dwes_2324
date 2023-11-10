<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 3.2 - Gestión de articulos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Proyecto 3.2 - Gestión de articulos</span>
        </header>

        <legend>Formulario Nuevo Articulo</legend>

        <!-- Formulario Nuevo Libro -->
        <form action="create.php" method="POST">
            <!-- id -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
                <!-- <div class="form-text">Introduzca identificador del libro</div> -->
            </div>
            <!-- Descripcion -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion">
                <!-- <div class="form-text">Introduzca título libro existente</div> -->
            </div>
            <!-- Modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo">
                <!-- <div class="form-text">Introduzca Autor del libro</div> -->
            </div>
            <!-- marca -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" aria-label="Default select example" name="marca">
                    <option selected disabled>Seleccione una marca</option>
                    <?php foreach ($marcas as $key => $marca): ?>
                        <option value="<?= $key ?>">
                            <?= $marca ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Unidades -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Unidades</label>
                <input type="text" class="form-control" name="unidades">
                <!-- <div class="form-text">Género del libro</div> -->
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01">
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>
            <!-- Categoria -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-select" aria-label="Default select example" name="categoria">
                    <option selected disabled>Seleccione una categoría</option>
                    <?php foreach ($categorias as $key => $categoria): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<? $indice ?>" name="categorias[]">
                            <label class="form-check-label" for="">
                            <?= $categoria ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </select>
            </div>


            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br>
        <br>
        <br>




        <!-- Pié del documento -->

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>