<!DOCTYPE html>
<html lang="es">
<head>
    <!-- layout.head -->
    <?php include 'views/lauyots.head.html';?>

    <title>Gestión libros - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- partial.header -->
        <?php include 'views/partials/header.php';?>
            
        <!-- partial.menu -->
        <?php include 'views/partials/menu.php'; ?>
       
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th class="text-end">Unidades</th>
                        <th class="text-end">Coste</th>
                        <th class="text-end">PVP</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <!-- En el foreach incluyo un objeto de la clase pdostatement -->
                    <?php foreach($libros as $libro):?>
                    <?php  ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <th><?=$libro->id?></th>
                            <td><?=$libro->autor?></td>
                            <td><?=$libro->editorial?></td>
                            <td class="text-end"><?=$libro->unidades?></td>
                            <td class="text-end"><?=$libro->coste?></td>
                            <td class="text-end"><?=$libro->PVR?></td>
                            <td><?=$libro->acciones?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                                <a href="" title="Eliminar" ><i class="bi bi-trash-fill" onclick="return confirm('Confimar elimación del libro')"></i></a>
                                <a href="" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                                <a href="" title="Mostrar"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php ?>  
                <?php endforeach; ?> 
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros </td></tr>
                </tfoot>
            </table>
        </div>
    </div>
     <!-- Cerramos la conexion -->
     <?php $libros = null;$conexion->cerrarConexion()?>
        <br>
        <br>
        <br>
        <!-- Pie de documento -->
        <?php include 'views/partials/footer.php';?>
    </div>

    <!-- partial.footer -->
    <?php include 'views/partials/footer.php';?>

    <!-- layout.javascript -->
    <?php include("layouts/layouts.javascript.html");?>
    
 
</body>
</html>
