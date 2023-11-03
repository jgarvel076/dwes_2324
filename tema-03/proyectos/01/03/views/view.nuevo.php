<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "views/layouts/head.html" ?>
    <title>Proyecto 3.1 - Gestión Libros</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-4">Proyecto 3.1 - Gestión de libros</span>

        </header>
        <legend>Formulario Nuevo Libro</legend>

        <form method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="id">
                <label for="idLibro" class="form-label">Id</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="titulo">
                <label for="tituloLibro" class="form-label">Titulo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="autor">
                <label for="autorLibro" class="form-label">Autor</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="genero">
                <label for="generopLibro" class="form-label">Género</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="precio">
                <label for="precioLibro" class="form-label">Precio</label>
            </div>
            
            <button type="submit" class="btn btn-primary" formaction="create.php">Submit</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
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