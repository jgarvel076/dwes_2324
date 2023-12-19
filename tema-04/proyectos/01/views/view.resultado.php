<!DOCTYPE html>
<html lang="es">

<head>

    <?php include "views/layouts/head.html" ?>

</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <?php include "views/partials/header.php" ?>

        <legend>Calculadora</legend>

        <form action="calcular.php" method="POST">

            <!-- Valor 1 -->
            <div class="mb3">
                <label for="valor1" class="form-label">Valor 1:</label>
                <input name="valor1" type="number" class="form-control" step="0.01" placeholder="" value="<?= $calcular->getDato1() ?>" disabled>
            </div>

            <!-- Valor 2 -->
            <div class="mb3">
                <label for="valor2" class="form-label">Valor 2:</label>
                <input name="valor2" type="number" class="form-control" step="0.01" placeholder="" value="<?= $calcular->getDato2() ?>" disabled>
            </div>

            <!-- Operación -->
            <div class="mb3">
                <label for="valor2" class="form-label">Operacion :</label>
                <input name="valor2" type="text" class="form-control" step="0.01" placeholder="" value="<?= $calcular->getOperacion() ?>" disabled>
            </div>

            <!-- Total -->
            <div class="mb3">
                <label for="valor2" class="form-label">Total : </label>
                <input name="valor2" type="number" class="form-control" step="0.01" placeholder="" value="<?= $calcular->getTotal() ?>"  disabled>
            </div>

            <br>

            <div class="mb3" role="group">
                <a type="reset" class="btn btn-danger" href="index.php">Volver</a>
            </div>

        </form>

    </div>

    <?php
    'views/partials/footer.html';
    ?>
    <!-- javascript bootstrap 512 -->
    <?php
    include "views/layouts/javascript.html";
    ?>
</body>

</html>