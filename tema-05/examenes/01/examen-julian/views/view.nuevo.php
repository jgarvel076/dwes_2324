<!DOCTYPE html>
<html lang="es">

<head>
    <!-- loyout.head -->
    <title>Nuevo - Gestión Libros </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">
        <!-- partial.header -->
        <legend>Formulario Nuevo Libro</legend>

        <form action="" method="">
            <!-- título -->
            <div class="mb-3">
                <label for="titulo" class="form-label"></label>
                <input type="text" class="form-control">
            </div>

            <!-- isbn -->
            <div class="mb-3">
                <label for="isbn" class="form-label"></label>
                <input type="text" class="form-control">
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label"></label>
                <input type="date" class="form-control">
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <select class="form-select">
                    <option selected disabled>Seleccione Autor</option>
                  
                    <option></option>
                  
                </select>
            </div>

            <!-- Editorial -->
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <select class="form-select">
                    <option selected disabled>Seleccione Editorial</option>
                  
                    <option></option>
                  
                </select>
            </div>

            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" value=0>
            </div>

            <!-- precio_coste -->
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" value=0.00>
            </div>

            <!-- precio_venta -->
            <div class="mb-3">
                <label for="" class="form-label">Precio Venta</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" value=0.00>
            </div>


            <!-- Botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br><br><br>

        <!-- partial.footer -->

        <!-- layout.javascript -->

</body>

</html>