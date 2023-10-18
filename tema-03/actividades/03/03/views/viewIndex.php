<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir head -->
    <title>Actividad 3.3 - Apartado 3 - Tema 03</title>

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
            <span class="fs-6"></span>
        </header>

        <legend>Formulario</legend>
        <form method="post" action="acceso.php">
            <!-- Formulario -->
            <div class="mb-3">
                <label class="form-label" >Nombre</label>
                <input class="form-control" name="nombreUsuario">
            </div>
            <div class="mb-3">
                <label class="form-label" >Correo </label>
                <input type="email" class="form-control" aria-describedby="emailHelp" name="email">
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label class="form-label" >Contraseña</label>
                <input type="password" class="form-control" name="contrasena">
            </div>
            <div class="mb-3">
                <label class="form-label" >Confirmación Contraseña</label>
                <input type="password" class="form-control" name="contrasenaConfirmada">
            </div>

            <!-- Botones de acción  -->

            <br>
            <button type="submit" class="btn btn-primary" formaction="acceso.php">Entrar</button>
            <button type="reset" class="btn btn-secondary">Borrar</button>

        </form>

        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>