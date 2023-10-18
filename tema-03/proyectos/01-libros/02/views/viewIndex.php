<!DOCTYPE html>
<html lang="es">

<head>
  <?php include 'views/layouts/head.html' ?>
  <title>Proyecto 3.1 - Gestión de libros</title>

</head>

<body>
  <!-- Capa principal -->
  <div class="container">
    <!-- cabecera documento -->
    <header class="pb-3 mb-4 border-bottom">
      <i class="bi bi-book-half"></i>
      <span class="fs-4">Proyecto 3.1 - Gestión de libros</span>
    </header>

    <legend>Tabla Libros</legend>
    <table class="table">
      <thead>
        <!-- Encabezado Tabla -->
        <tr>
          <!-- <?php foreach (array_keys($libros[0]) as $clave): ?>
            <th><?= $clave ?></th>
          <?php endforeach; ?> -->

          <!-- personalizado -->
          <th>Id</th>
          <th>Titulo</th>
          <th>Autor</th>
          <th>Genero</th>
          <th>Precio</th>
        </tr>
      </thead>
      <!-- Mostramos el cuerpo de la tabla -->
      <tbody>
        <?php foreach ($libros as $libro): ?>
          <tr>
            <!-- Mismo formato a cada campo de la tabla -->
            <?php foreach ($libro as $campo): ?>
              <td>
                <?= $campo ?>
              </td>
            <?php endforeach; ?>

            <!-- <td><?=$libro['id'] ?></td>
            <td><?=$libro['titulo'] ?></td> -->


          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">
            Nº Libros:
            <?= count($libros) ?>
          </td>
        </tr>
      </tfoot>

    </table>

    </form>

    <!-- pie del documento -->

    <?php include 'views/layouts/footer.html' ?>

  </div>

  <!-- javascript bootstrap 512 -->
  <?php include 'views/layouts/javascript.html' ?>
</body>

</html>