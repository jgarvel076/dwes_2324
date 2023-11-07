<!doctype html>
<html lang="es">

<head>
  
  <?php include("layouts/layout.head.php") ?>
  <title>Tabla Películas</title>
</head>

<body>
  <div class="container">

    
    <?php include("partials/partial.cabecera.php"); ?>

    <legend>
      Tabla Películas
    </legend>

    
    <?php include("partials/partial.menu.php") ?>

    
    <table class="table">
      <thead>
        <tr>
          <?php
          $claves = array_keys($peliculas[0]);
          $claves[] = "Acciones";
          foreach ($claves as $clave): ?>
            <th>
              <?= $clave ?>
            </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        
        <?php foreach ($peliculas as $indice => $pelicula): ?>
          <tr>
            
            <?php foreach ($pelicula as $key => $campo): ?>
              <td>
                <?php if ($key == 'generos'): ?>
                  <?= implode(', ', mostrarGeneros($generos, $campo)) ?>
                <?php else: ?>
                  <?= $campo ?>
                <?php endif ?>
              </td>
            <?php endforeach; ?>

            
            <td>
              <a href="eliminar.php?indice=0<?= $indice ?>" Title="Eliminar"><i class="bi bi-trash-fill"></i></a>
              <a href="editar.php?indice=0<?= $indice ?>" Title="Modificar"><i class="bi bi-pencil-square"></i></a>
              <a href="mostrar.php?indice=0<?= $indice ?>" Title="Mostrar"><i class="bi bi-eye"></i></a>
            </td>


          </tr>
        <?php endforeach; ?>


      </tbody>
    </table>

    
    <?php include("partials/partial.footer.php") ?>

  </div>

  
  <?php include("layouts/layout.javascript.php") ?>

</body>

</html>
