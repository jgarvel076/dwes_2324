<!doctype html>
<html lang="es">
  <head>
    <!-- Incluimos HEAD -->
    <?php include("partials/partial.head.php") ?>
    <title>Modificar Película - CRUD Tabla Películas</title>
  </head>
  <body>
    <div class="container">    

      <!-- Incluimos Cabecera -->
      <?php include("partials/partial.cabecera.php") ?> 

      <legend>
        Modificar Película
      </legend>

      <form action="update.php?indice=<?=$indice ?>" method="POST">
            <!-- Campo ID Oculto
            <div class="mb3" hidden> 
                <label class="form-label">Id</label>
                <input name = "id" type="text" class="form-control" value="<//?= $pelicula['id'] ?>">
            </div> -->

            <!-- Campo título -->
            <div class="mb3">
                <label class="form-label">Título</label>
                <input name = "titulo" type="text" class="form-control" value="<?= $pelicula['titulo'] ?>" required>
            </div>
            
            <!-- Campo director -->
            <div class="mb3">
                <label class="form-label">Director</label>
                <input name = "director" type="text" class="form-control" value="<?= $pelicula['director'] ?>" required>
            </div>

            <!-- Campo nacionalidad -->
            <div class="mb3">
                <label class="form-label">Nacionalidad</label>
                <input name = "nacionalidad" type="text" class="form-control" value="<?= $pelicula['nacionalidad'] ?>" required>
            </div>

            <!-- Campo Año -->
            <div class="mb3">
                <label class="form-label">Año</label>
                <input name = "año" type="number" class="form-control" value="<?= $pelicula['año'] ?>" required>
            </div>

            <!-- Campo generos mediante checkbox -->
            <div class="mb3" form-check>
                <label class="form-label">Géneros</label>
                <div  class="form-control">
                    <?php foreach ($generos as $key => $genero):?>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="generos[]" value="<?=$key?>"  
                             <?= (in_array($key, $pelicula['generos'])? 'checked': ''); ?> 
                            >
                            <label class="form-check-label" for="inlineCheckbox1"><?=$genero ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <br>
            <div class="mb3" role="group">
              <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
      </form>
      <!-- Incluimos Partials footer -->
      <?php include("partials/partial.footer.php") ?>
    </div>

    <!-- Incluimos Partials javascript bootstrap -->
    <?php include("partials/partial.javascript.php") ?>
  </body>
</html>