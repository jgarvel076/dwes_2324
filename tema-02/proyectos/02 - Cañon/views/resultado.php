<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 2.2 - Lanzamiento proyectiles</title>

    <!-- css bootstrap 532 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons bootstrap 1.11.1-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>
<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
     <span class="fs-4">Proyecto 2.2 - Lanzamiento proyectiles</span>

        </header>

        <legend>Formulario Lanzamiento proyectiles</legend>
        <table class="table">
            <tbody>
                <tr>
                    <th>Valores Iniciales:</th>
                    <td></td>

                </tr>
                <tr>
                    <td>Velocidad inicial</td>
                    <td><?=$velocidadInicial?> m/s</td>
                </tr>
                <tr>
                    <td>Angulo Lanzamiento</td>
                    <td><?=$anguloLanzamiento?> º</td>
                </tr>
                <tr>
                    <th>Resultados:</th>
                    <td></td>

                </tr>
                <tr>
                    <td>Angulo Radianes</td>
                    <td><?=$angulo?> Radianes</td>
                </tr>
                <tr>
                    <td>Velocidad inicial X</td>
                    <td><?=$Vox?> m/s</td>
                </tr>
                <tr>
                    <td>Velocidad inicial Y</td>
                    <td><?=$Voy?> m/s</td>
                </tr>
                <tr>
                    <td>Alcance Maximo</td>
                    <td><?=$Xmax?> m</td>
                </tr>
                <tr>
                    <td>Tiempo de Vuelo</td>
                    <td><?=$t?> s</td>
                </tr>
                <tr>
                    <td>Altura Maxima</td>
                    <td><?=$Ymax?> m</td>
                </tr>
            </tbody>
        </table>
            <!-- botones de acción -->
            <div class="btn-group" role="group">

                <a class="btn btn-primary" href="index.html" role="button">Volver</a>
            </div>
        </form>

        <!-- pie del documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted"> 
                    &copy Julián García Velázqez - DWES - 2º DAW - Curso 23/24
                </span>
            </div>
        </footer>
    </div>


    <!-- javascript bootstrap 512 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>