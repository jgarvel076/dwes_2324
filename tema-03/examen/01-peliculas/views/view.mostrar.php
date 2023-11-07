<!doctype html>
<html lang="es">
  <head>
    <!-- Incluimos HEAD -->
    <?php include("layouts/layout.head.php") ?>
    <title>Mostrar Película - CRUD Tabla Películas</title>
  </head>
  <body>
    <div class="container">    

      <!-- Incluimos Cabecera -->
      <?php include("partials/partial.cabecera.php") ?> 

      <legend>
        Formulario Nueva Película
      </legend>

      <form action="mostrar.php" method="">
            <!-- Campo ID Oculto-->
            <div class="mb3" hidden> 
                <label class="form-label">Id</label>
                <input name = "id" type="text" class="form-control" value=<?echo $pelicula['id'];?> disabled >
            </div>

            <!-- Campo título -->
            <div class="mb3">
                <label class="form-label">Título</label>
                <input name = "id" type="text" class="form-control" value=<?echo $pelicula['titulo'];?> disabled >
            </div>

            <!-- País Select -->
            <div class="mb-3">
                <label for="pais" class="form-label">País</label>
                <select class="form-select" aria-label="Default select example" name="">
                    <option selected disabled>Seleccione País</option>
                    <!-- Generar dinámicamente select  -->
                </select>
            </div>

            <!-- Campo director -->
            <div class="mb3">
                <label class="form-label">Director</label>
                <input name = "id" type="text" class="form-control" value=<?echo $pelicula['director'];?> disabled >
            </div>

            <!-- Campo Año -->
            <div class="mb3">
                <label class="form-label">Año</label>
                <input name = "id" type="text" class="form-control" value=<?echo $pelicula['año'];?> disabled >
            </div>

             <!-- Categorías -->
             <div class="mb-3">
                <label class="form-label">Géneros</label>
                <div class="form-control">
                    <!-- Generar dinámicamente lista checkbox de géneros -->
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Acción</a></li>
                    <li><a class="dropdown-item" href="#">Aventura</a></li>
                    <li><a class="dropdown-item" href="#">Comedia</a></li>
                    <li><a class="dropdown-item" href="#">Drama</a></li>
                    <li><a class="dropdown-item" href="#">Deportes</a></li>
                    <li><a class="dropdown-item" href="#">Ensayo</a></li>
                    <li><a class="dropdown-item" href="#">Terror</a></li>
                    <li><a class="dropdown-item" href="#">Bélica</a></li>
                    <li><a class="dropdown-item" href="#">Suspense</a></li>
                    <li><a class="dropdown-item" href="#">Histórico</a></li>
                    <li><a class="dropdown-item" href="#">Fantasia</a></li>
                    <li><a class="dropdown-item" href="#">Musical</a></li>
                    </ul>
                </div>
            </div>

            <br>
            <div class="mb3" role="group">
              <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            </div>
      </form>
      <br>
      <br>
      <br>
      <!-- Incluimos Partials footer -->
      <?php include("partials/partial.footer.php") ?>
    </div>

    <!-- Incluimos Partials javascript bootstrap -->
    <?php include("layouts/layout.javascript.php") ?>
  </body>
</html>

-------------------------------------------------
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
