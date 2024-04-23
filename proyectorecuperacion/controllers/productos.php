<?php
require_once 'class/class.producto.php';

class Productos extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        # Creo la propiedad title de la vista
        $this->view->title = "Tabla de productos";

        # Creo la propiedad productos dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get();
        $this->view->productos = $this->model->get();

        $this->view->render('productos/main/index');
    }

    function new()
    {

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión productos";

        # cargo la vista con el formulario nuevo producto
        $this->view->render('productos/new/index');
    }

    function create($param = [])
    {

        # Cargamos los datos del formulario
        $producto = new Producto(
            null,
            $_POST['nombre'],
            $_POST['ean_13'],
            $_POST['descripcion'],
            $_POST['categoria'],
            $_POST['precio_venta'],
            $_POST['stock'],
        );

        # Validación

        # Añadir registro a la tabla
        $this->model->create($producto);

        # Redirigimos al main de productos
        header('location:' . URL . 'productos');
    }

    function edit($param = [])
    {

        # obtengo el id del producto que voy a editar

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Editar - Panel de control productos";

        # obtener objeto de la clase producto
        $this->view->producto = $this->model->read($id);

        # cargo la vista
        $this->view->render('productos/edit/index');

    }

    function update($param = [])
    {
        # Cargo id del producto
        $id = $param[0];

        # Con los detalles del formulario creo objeto producto
        $producto = new producto(
            null,
            $_POST['nombre'],
            $_POST['ean_13'],
            $_POST['descripcion'],
            $_POST['categoria'],
            $_POST['precio_venta'],
            $_POST['stock'],
        );

        $this->model->update($id, $producto);

        header('location:' . URL . 'productos');

    }

    function show($param = [])
    {
        // Obtengo la id del producto que quiero mostrar
        $id = $param[0];

        // Obtengo los datos del producto mediante el modelo
        $producto = $this->model->read($id);

        // Configuro las propiedades de la vista
        $this->view->title = "Detalles del producto";
        $this->view->producto = $producto;

        // Cargo la vista de detalles del producto
        $this->view->render('productos/show/index');

    }


    function order($param = [])
    {

        # Obtengo el criterio de ordenación
        $criterio = $param[0];

        # Creo la propiedad "title" de la vista
        $this->view->title = "Ordenar - Panel de Control productos";

        # Creo la propiedad productos dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get()
        $this->view->productos = $this->model->order($criterio);

        # Cargo la vista principal de productos
        $this->view->render('productos/main/index');

    }

    function filter($param = [])
    {
        //Obtengo la expresión de filtrado
        $expresion = $_GET['expresion'];

        //Cambio la propiedad title de la vista
        $this->view->title = "Buscar - Gestión productos";

        //Creamos la variable productos dentro de la vista
        //Esta variable ejecuta el método get() del modelo productosModel
        $this->view->productos = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('productos/main/index');
    }

    function delete($param = [])
    {
        // Obtengo la id del producto que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id del producto
        $this->model->delete($id);

        // Cargo de nuevo la vista productos actualizada
        header('location:' . URL . 'productos');
    }


}

?>