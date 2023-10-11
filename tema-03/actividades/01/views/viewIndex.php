<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "views/layouts/head.html" ?>
    <title>Calculadora Conversor Decimal</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-4">Calculadora Conversor Decimal</span>

        </header>

        <legend>Formulario Conversor</legend>
        <form method="POST">

            <!-- Valor decimal -->
            <div class="mb=3">
                <label class="form-label">Valor decimal</label>
                <input type="number" name="ValorDecimal" class="form-control" placeholder=""
                    aria-activedescendant="helpId" step="0.01" value="0.00">
                <small id="helpId" class="text-muted">Introduzca numero en decimal</small>
            </div>

            <!-- botones de acción -->
            <div class="btn-group" role="group">

            <button type="reset" class="btn btn-secondary">Borrar</button>
            <button type="submit" class="btn btn-warning" formaction="binario.php">Binario</button>
            <button type="submit" class="btn btn-success" formaction="octal.php">Octal</button>
            <button type="submit" class="btn btn-primary" formaction="hexadecimal.php">Hexadecimal</button>
            <button type="submit" class="btn btn-danger" formaction="conversor.php">Todas</button>

            </div>
        </form>

        <!-- pie del documento -->

        <?php 
            include "views/layouts/footer.html";
        ?>
    </div>


    <!-- javascript bootstrap 512 -->
    <?php 
        include "views/layouts/javascript.html";
    ?>
</body>

</html>