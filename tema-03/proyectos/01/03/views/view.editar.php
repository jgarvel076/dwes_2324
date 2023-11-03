<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "views/layouts/head.html" ?>
    <title>Proyecto 3.8 - Gestión Libros</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-4">Proyecto 3.8 - Gestión de libros</span>

        </header>
        <legend>Formulario Edicion Libro</legend>

        <form method="post">
            <div class="form-floating mb-3">
                <label for="idLibro" class="form-label">ID</label>
                <label for="idLibro" class="form-label">
                    <?= $libroEditar['id'] ?>
                </label>
            </div>
            <div class="form-floating mb-3">
                <label for="idLibro" class="form-label">TITULO: </label>
                <label for="tituloLibro" class="form-label">
                    <?= $libroEditar['titulo'] ?>
                </label>
            </div>
            <div class="form-floating mb-3">
                <label for="idLibro" class="form-label">AUTOR: </label>
                <label for="autorLibro" class="form-label">
                    <?= $libroEditar['autor'] ?>
                </label>
            </div>
            <div class="form-floating mb-3">
                <label for="idLibro" class="form-label">GENERO: </label>
                <label for="generopLibro" class="form-label">
                    <?= $libroEditar['genero'] ?>
                </label>
            </div>
            <div class="form-floating mb-3">
                <label for="idLibro" class="form-label">PRECIO: </label>
                <label for="precioLibro" class="form-label">
                    <?= $libroEditar['precio'] ?>
                </label>
            </div>

            <button type="text" class="btn btn-secondary" formaction="index.php">Cancelar</button>
            <button type="text" class="btn btn-secondary" formaction="update.php">Actualizar</button>
        </form>

    </div>

    <?php
    'views/layouts/footer.html';
    ?>
    <!-- javascript bootstrap 512 -->
    <?php
    include "views/layouts/javascript.html";
    ?>
</body>

</html>