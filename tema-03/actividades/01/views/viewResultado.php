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
            <legend>Resultados de Conversion</legend>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><b>DECIMAL</b></td>
                                <td><?=$decimal?></td>
                            </tr>
                            <tr>
                                <td><b><?= $operacionNombre ?></b></td>
                                <td><?= $operacion ?> </td>
                            </tr>

                        </tbody>
                    </table>

            <!-- botones de acción -->
            <div class="btn-group" role="group">

                <a class="btn btn-primary" href="index.php" role="button">Volver</a>
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
</div>
</body>