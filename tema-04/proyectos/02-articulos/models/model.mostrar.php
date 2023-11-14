<?php
    /*
        Modelo: modelEditar.php
        Descripción: editar los detalles de un artículo

        Método GET:
            - id del articulo que quiero editar
    */
    setlocale(LC_MONETARY,"es_ES"); // Indicamos

    # Cargamos los datos a partir de los métodos estáticos de la clase
    $categorias = ArrayArticulos::getCategorias(); // getCategorias -> Método estático
    $marcas = ArrayArticulos::getMarcas(); // getMarcas -> Método estático

    # Cargamos los datos
    $articulos = new ArrayArticulos();

    $articulos->getDatos();

    # Debemos buscar en la tabla el id del artículo a editar
    $idMostrar = $_GET['indice'];

    # Usamos la funcion buscar de ArrayArticulos
    $articulo = $articulos->buscar($idMostrar);

?>