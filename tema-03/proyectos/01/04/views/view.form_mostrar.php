<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro Seleccionado</title>
    <?php include "views/layouts/head.html" ?>


</head>

<body>
    <div class="container">
        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-4">Proyecto 3.9 - Gestión de libros</span>

        </header>
        <legend>Libro seleccionado</legend>
        <form>

        <form action="mostrar.php">
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Id: </label>
                <input type="text" class="form-control" name="id" value="<?=$libro['id']?>" disabled>
                
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título: </label>
                <input type="text" class="form-control" name="titulo" value="<?=$libro['titulo']?>" disabled>
                
            </div>
            
            <div class="mb-3">
                <label for="autor" class="form-label">Autor: </label>
                <input type="text" class="form-control" name="autor" value="<?=$libro['autor']?>" disabled>
                
            </div>
            
            <div class="mb-3">
                <label for="genero" class="form-label">Género: </label>
                <input type="text" class="form-control" name="genero" value="<?=$libro['genero']?>" disabled>
                
            </div>
            
            <div class="mb-3">
                <label for="precio" class="form-label">Precio: </label>
                <input type="number" class="form-control" name="precio" value="<?=$libro['precio']?>" disabled>
                
            </div>

            <!-- Botones de acción -->

            <div class="btn-group" role="group">

                <a class="btn btn-primary" href="index.php" role="button">Volver</a>

            </div>


        </form>
    </div>
</body>
</html>