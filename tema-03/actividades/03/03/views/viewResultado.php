<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir head -->
    <title>Formulario DIAS DE LA SEMANA</title>

    <!-- Añadimos el php include para el css bootstrap -->
    <?php
    include "layouts/head.html";
    ?>

</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6"></span>
        </header>

        <?php
        echo 'Bienvenido <BR>';

        $dias_semana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

        // Obtener el índice del día actual (0 para lunes, 1 para martes, etc.)
        $dia_actual = date('N') - 1;

        // Mostrar las entradas para cada día de la semana
        for ($i = 0; $i <= $dia_actual; $i++) {
            echo '<label>' . $dias_semana[$i] . ':</label>';
            echo '<br>';
            echo '<input type="text" name="' . $dias_semana[$i] . '"><br>';
        }
        ?>

        <br>

        <!-- Botón volver -->
        <div class="btn-group" role="group">
            <a class="btn btn-primary" href="index.php" role="button">VOLVER</a>
        </div>
        </form>

        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>