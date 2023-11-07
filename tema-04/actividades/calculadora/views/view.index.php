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
                <input type="number" class="form-control" name = "valor1" step="0.01" placeholder="0">
            </div>
            <!-- valor2 -->
            <div class="mb-3">
                <label for="valor1" class="form-label">Valor 2</label>
                <input type="number" class="form-control" name = "valor2" step="0.01" placeholder="0">
            </div>

            <!-- resultado -->
            <div class="mb-3">
                <label for="resultado" class="form-label">Resultado</label>
                <input type="number" class="form-control" step="0.01" name = "resultado" placeholder="0" disabled>
                <!-- <div class="form-text">Introduzca Autor del libro</div> -->
            </div>

            

            <!-- Botones de accion -->
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="sumar">Suma</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="restar">Resta</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="multiplicar">Multiplicacion</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="dividir">División</button>
            <button type="submit" class="btn btn-primary" name="operacion" value="potencia">Potencia</button>

        </form>

        <!-- Pie del documento  -->
        

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>
