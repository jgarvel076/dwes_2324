<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 4.1 - Calculadora POO</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera documento -->
        <?php include 'views/partials/header.php'; ?>

        <legend>Calculadora</legend>
    

        <!-- Muestra datos de la tabla -->
        <form action="calcular.php" method="POST">
            

            <!-- valor1 -->
            <div class="mb-3">
                <label for="valor1" class="form-label">Valor 1</label>
                <input type="number" class="form-control" step="0.01" value="<?= $calcular->getValor1() ?>" disabled>
            </div>
            <!-- valor2 -->
            <div class="mb-3">
                <label for="valor1" class="form-label">Valor 2</label>
                <input type="number" class="form-control"step="0.01" value="<?= $calcular->getValor2() ?>" disabled>
            </div>

            <!-- Operacion -->
            <div class="mb-3">
                <label for="valor1" class="form-label">Operacion</label>
                <input type="text" class="form-control"step="0.01" value="<?= $calcular->getOperacion() ?>" disabled>
            </div>

            <!-- resultado -->
            <div class="mb-3">
                <label for="resultado" class="form-label">Resultado</label>
                <input type="number" class="form-control" step="0.01" value="<?= $calcular->getResultado() ?>" disabled>
                <!-- <div class="form-text">Introduzca Autor del libro</div> -->
            </div>

            

            <!-- Botones de accion -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

        </form>

        <!-- Pie del documento  -->
        

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>