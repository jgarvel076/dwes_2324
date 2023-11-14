<?php
    /*
        Modelo: modelUpdate.php
        Descripción: actualiza los detalle de un articulo

        Método POST 
            - descripcion
            - modelo
            - Marca
            - categorias (valor númerico)
            - unidades
            - precio
        
        Método GET
            - id
    */
// Carga de datos
setlocale(LC_MONETARY, "es_ES"); // Indicamos

# Cargamos los datos a partir de los métodos estáticos de la clase
$categorias = ArrayArticulos::getCategorias(); // getCategorias -> Método estático
$marcas = ArrayArticulos::getMarcas(); // getMarcas -> Método estático

# Creamos un objeto de la clase ArrayArticulos
$articulos = new ArrayArticulos();
# Creamos un objeto de articulo
$articulo = new Articulo();

# Cargo los datos
$articulos->getDatos();

$indice = $_GET['id'];
$articulo = $articulos->buscar($indice);

// Recogemos los datos del formulario

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

// Añadimos el artículo usando la funcion create de ArrayArticulos
$articulos->update($indice, $articulo);

# Generamos una notificación
$notificacion = 'Articulo modificado con éxito';
?>