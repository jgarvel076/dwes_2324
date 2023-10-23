<!DOCTYPE html>
<html lang="es">

<head>
  <?php include 'views/layouts/head.html' ?>
  <title>Proyecto 3.2 - Gestión de libros</title>
</head>

<body>
  <!-- Capa principal -->
  <div class="container">
    <!-- Cabecera documento -->
    <header class="pb-3 mb-4 border-bottom">
      <i class="bi bi-rocket-takeoff-fill"></i>
      <span class="fs-4">Proyecto 3.2 - Gestión de libros</span>
    </header>
    <legend>Tabla Libros</legend>

    <!-- Menú Principal -->
    <?php include 'views/partials/menu_prin.php' ?>
 
    <!-- Muestra datos de la tabla -->
    <table class="table">
      <!-- Encabezado tabla -->
      <thead>
        <tr>
          <!-- Extraido del array -->
          <!-- <?php foreach (array_keys($libros[0]) as $clave): ?>
            <th>
              <?= $clave ?>
            </th>
          <?php endforeach; ?> -->

          <!-- personalizado -->
          <th>Id</th>
          <th>Título</th>
          <th>Autor</th>
          <th>Género</th>
          <th>Precio</th>
          <th>Acciones</th>


        </tr>
      </thead>
      <tbody>
        <?php foreach ($libros as $libro): ?>
          <tr>
            <?php foreach ($libro as $campo): ?>
              <td>
                <?= $campo ?>
              </td>
            <?php endforeach; ?>
            <!-- boton eliminar  -->
            <td>
              <a href="eliminar.php?id=<?= $libro['id'] ?>" title="Eliminar">
              <i class="bi bi-trash3"></i></a>
            
            <!-- boton editar  -->
            
              <a href="editar.php?id=<?= $libro['id'] ?>" title="Editar">
              <i class="bi bi-pencil-square"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">Nº Libros
            <?= count($libros) ?>
          </td>
        </tr>
      </tfoot>

    </table>


    <!-- Pie del documento  -->
    <?php include 'views/layouts/footer.html' ?>

  </div>

  <!-- javascript bootstrap 532 -->
  <?php include 'views/layouts/javascript.html' ?>
</body>

</html>