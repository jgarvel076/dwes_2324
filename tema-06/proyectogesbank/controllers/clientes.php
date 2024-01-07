<?php
require_once 'class/class.cliente.php';

class Clientes extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        $this->view->title = "Tabla de clientes";

        $this->view->clientes = $this->model->get();

        $this->view->render('clientes/main/index');
    }

    function new()
    {

        $this->view->title = "Añadir - Gestión clientes";

        $this->view->render('clientes/new/index');
    }

    function create($param = [])
    {

        # Cargamos los datos del formulario
        $cliente = new classCliente(
            null,
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['email'],
            $_POST['telefono'],
            $_POST['ciudad'],
            $_POST['dni'],
        );

        # Validación

        # Añadir registro a la tabla
        $this->model->create($cliente);

        # Redirigimos al main de clientes
        header('location:' . URL . 'clientes');
    }

    function edit($param = [])
    {

        $id = $param[0];

        $this->view->id = $id;

        $this->view->title = "Editar - Panel de control Clientes";

        $this->view->cliente = $this->model->read($id);

        $this->view->render('clientes/edit/index');

    }

    function update($param = [])
    {
        $id = $param[0];

        $cliente = new classCliente(
            null,
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['email'],
            $_POST['telefono'],
            $_POST['ciudad'],
            $_POST['dni'],
        );

        $this->model->update($id, $cliente);

        header('location:' . URL . 'clientes');

    }

    function show($param = [])
    {
        // Obtengo la id del cliente que quiero mostrar
        $id = $param[0];

        // Obtengo los datos del cliente mediante el modelo
        $cliente = $this->model->read($id);

        // Configuro las propiedades de la vista
        $this->view->title = "Detalles del Cliente";
        $this->view->cliente = $cliente;

        // Cargo la vista de detalles del cliente
        $this->view->render('clientes/show/index');

    }


    function order($param = [])
    {

        $criterio = $param[0];

        $this->view->title = "Ordenar - Panel de Control Clientes";

        $this->view->clientes = $this->model->order($criterio);

        $this->view->render('clientes/main/index');

    }

    function filter($param = [])
    {
        //Obtengo la expresión de filtrado
        $expresion = $_GET['expresion'];

        //Cambio la propiedad title de la vista
        $this->view->title = "Buscar - Gestión Clientes";

        //Creamos la variable clientes dentro de la vista
        //Esta variable ejecuta el método get() del modelo clientesModel
        $this->view->clientes = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('clientes/main/index');
    }

    function delete($param = [])
    {
        // Obtengo la id del cliente que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id del cliente
        $this->model->delete($id);

        // Cargo de nuevo la vista clientes actualizada
        header('location:' . URL . 'clientes');
    }


}

?>