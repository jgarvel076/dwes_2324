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
                <input name="valor1" type="number" class="form-control" step="0.01" placeholder="0">
            </div>

            <!-- Valor 2 -->
            <div class="mb3">
                <label for="valor2" class="form-label">Valor 2:</label>
                <input name="valor2" type="number" class="form-control" step="0.01" placeholder="0">
            </div>

            <br>

            <div class="mb3" role="group">
                <button type="reset" class="btn btn-danger">Borrar</button>

                <br>
                <br>

                <button type="submit" class="btn btn-primary" name="operacion" value="sumar">Sumar</button>
                <button type="submit" class="btn btn-primary" name="operacion" value="restar">Restar</button>
                <button type="submit" class="btn btn-primary" name="operacion" value="dividir">Dividir</button>
                <button type="submit" class="btn btn-primary" name="operacion" value="multiplicar">Multiplicar</button>

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