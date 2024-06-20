<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap  -->
    <?php require_once("template/partials/head.php");  ?>

    <title>Editar Cliente</title>
</head>

<body>
    <!-- menú principal -->
    <?php require_once "template/partials/menu.php"; ?>
    <!-- capa principal -->
    <div class="container">
        <!-- cabecera  -->
        <?php include "views/clientes/partials/header.php" ?>
        <!-- Errores -->
        <?php include "template/partials/error.php"?>
        <!-- Formulario -->
        <form action="<?= URL ?>clientes/update/<?= $this->id ?>" method="POST">
            <!-- nombre -->
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control <?= (isset($this->errores['nombre']))? 'is-invalid': null ?>" name="nombre" value="<?=$this->cliente->nombre?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- direccion -->
            <div class="mb-3">
                <label for="" class="form-label">Direccion</label>
                <input type="text" class="form-control <?= (isset($this->errores['direccion']))? 'is-invalid': null ?>" name="direccion" value="<?=$this->cliente->direccion?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['direccion'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['direccion'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- poblacion -->
            <div class="mb-3">
                <label for="" class="form-label">Poblacion</label>
                <input type="text" class="form-control <?= (isset($this->errores['poblacion']))? 'is-invalid': null ?>" name="poblacion" value="<?=$this->cliente->poblacion?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['poblacion'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['poblacion'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- c_postal -->
            <div class="mb-3">
                <label for="" class="form-label">Codigo postal</label>
                <input type="text" class="form-control <?= (isset($this->errores['c_postal']))? 'is-invalid': null ?>" name="c_postal" value="<?=$this->cliente->c_postal?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['c_postal'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['c_postal'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- telefono -->
            <div class="mb-3">
                <label for="" class="form-label">Telefono</label>
                <input type="text" class="form-control <?= (isset($this->errores['telefono']))? 'is-invalid': null ?>" name="telefono" value="<?=$this->cliente->telefono?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['telefono'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['telefono'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- email -->
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control <?= (isset($this->errores['email']))? 'is-invalid': null ?>" name="email" value="<?=$this->cliente->email?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- NIF -->
            <div class="mb-3">
                <label for="" class="form-label">NIF</label>
                <input type="text" class="form-control <?= (isset($this->errores['nif']))? 'is-invalid': null ?>" name="nif" value="<?=$this->cliente->nif?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['nif'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nif'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once "template/partials/footer.php" ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once "template/partials/javascript.php" ?>
</body>
</html>