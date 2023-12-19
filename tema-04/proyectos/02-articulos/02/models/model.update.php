<?php

    /*

    Modelo: modelUpdate.php
    Descripción: Actualiza un elemento a la tabla

    */

    setlocale(LC_MONETARY, "es_ES"); // Indicamos

    # Cargamos los datos a partir de los métodos estáticos de la clase
    $categorias = ArrayArticulo::getCategorias(); // getCategorias -> Método estático
    $marcas = ArrayArticulo::getMarcas(); // getMarcas -> Método estático

    $articulos = new ArrayArticulo();
    $articulo = new Articulo();

    # Cargo los datos
    $articulos->getDatos();

    $indice = $_GET['indice'];
    $articulo = $articulos->buscarId($indice);

    # Recogemos los datos del formulario

    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $categoriasArt = $_POST['categorias'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    # Editamos los valores del articulo con los valores

    $articulo->setDescripcion($descripcion);
    $articulo->setModelo($modelo);
    $articulo->setMarca($marca);
    $articulo->setCategorias($categoriasArt);
    $articulo->setUnidades($unidades);
    $articulo->setPrecio($precio);

    $articulos->update($indice, $articulo);

    # Generamos una notificación
    $notificacion = 'Articulo modificado con éxito';

?>