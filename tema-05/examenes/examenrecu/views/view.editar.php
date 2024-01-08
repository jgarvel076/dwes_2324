<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/layout.head.html' ?>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/partial.header.php' ?>

        <legend>Formulario Editar Libro</legend>

        <!-- Formulario para editar libro -->
        <form action="update.php?id=<?= $id_editar ?>" method="POST">
            <!-- id oculto -->
            <!-- <label for="titulo" class="form-label">Id</label> -->
            <input type="hydeen" class="form-control" name="id" value="<?= $libro->id ?>" hidden>

            <!-- título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>

            <!-- isbn -->
            <div class="mb-3">
                <label for="isbn" class="form-label">isbn</label>
                <input type="text" class="form-control" name="isbn" required>
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                <input type="date" class="form-control" name="fecha_edicion" required>
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="" class="form-label">Autor</label>
                <select class="form-select" name="autor_id">
                    <option selected disabled>Seleccione Autor</option>
                    <?php foreach($autores AS $autor):?>
                    <option value="<?=$autor->id?>">
                    <?=$autor->nombre?>
                    </option>
                    <?php endforeach;?>
                </select>
            </div>

            <!-- Editorial -->
            <div class="mb-3">
                <label for="" class="form-label">Editorial</label>
                <select class="form-select" name="editorial_id">
                    <option selected disabled>Seleccione Editorial</option>
                    <?php foreach ($editoriales AS $editorial):?>
                    <option value="<?=$editorial->id?>">
                    <?=$editorial->nombre?>
                    </option>
                    <?php endforeach;?>
                </select>
            </div>

            <!-- Editorial -->
            <div class="mb-3">
                <label for="" class="form-label">Paginas</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" placeholder="0" name="paginas">
            </div>

            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label">Unidades</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" placeholder="0" name="stock">
            </div>

            <!-- precio_coste -->
            <div class="mb-3">
                <label for="" class="form-label">Precio Coste</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" placeholder=0.00 name="precio_coste">
            </div>

            <!-- precio_venta -->
            <div class="mb-3">
                <label for="" class="form-label">Precio Venta</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" placeholder=0.00 name="precio_venta">
            </div>


            <!-- Botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>


        </form>

        <br>
        <br>
        <br>

        <!-- Pié del documento -->
        <?php include 'views/partials/partial.footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/layout.javascript.html' ?>
</body>

</html>