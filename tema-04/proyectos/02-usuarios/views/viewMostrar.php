<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 3.1 - Gestión de articulos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Proyecto 3.1 - Gestión de articulos</span>
        </header>

        <legend>Formulario Edición articulo</legend>

        <!-- Formulario Nuevo articulo -->
        <form action="mostrar.php?id=<?= $id ?>" method="POST">
            <!-- id -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $articulo['id'] ?>" readonly>
                <!-- <div class="form-text">Introduzca identificador del articulo</div> -->
            </div>
            <!-- Título -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $articulo['descripcion'] ?>" readonly>
                <!-- <div class="form-text">Introduzca título articulo existente</div> -->
            </div>
            <!-- modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $articulo['modelo'] ?>" readonly>
                <!-- <div class="form-text">Introduzca modelo del articulo</div> -->
            </div>
            <!-- Género -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" name="categoria" value="<?= $categorias[$articulo['categoria']] ?>" readonly>
                
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Stock</label>
                <input type="number" class="form-control" name="unidades"  value="<?= $articulo['unidades'] ?>" readonly>
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo['precio'] ?>" readonly>
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>


            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
            

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