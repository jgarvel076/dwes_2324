<?php

class Productos extends Controller
{

    # Método render
    function render($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['main'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'index');
        } else {

        # Si existe un mensaje
        if(isset($_SESSION['mensaje'])){
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        $this->view->title = "Tabla productos";
        $this->view->productos = $this->model->get();
        $this->view->render("productos/main/index");
    }
    }

    # Método new
    function new($param = [])
    { 
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'productos');
        } else {

        # Creamos un objeto vacío
        $this->view->producto = new Producto();

        # Comprobamos si existen errores
        if(isset($_SESSION['error'])){
            // Añadimos a la vista el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Autorellenamos el formulario
            $this->view->producto = unserialize($_SESSION['producto']);

            // Recuperamos el array con los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['producto']);
        }


        $this->view->title = "Formulario añadir producto";

        //$this->view->clientes= $this->model->getClientes();

        $this->view->render("productos/new/index");
    }
    }

    # Método create

    function create($param = [])
    {
       # Iniciamos sesión
       session_start();

       # Comprobamos si el usuario está autentificado
       if (!isset($_SESSION['id'])) {
           // aviso al usuario: 
           $_SESSION['mensaje'] = "Usuario debe autentificarse";

           // login
           header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'productos');
        } else {

        # datos del formulario
        $nombre = filter_var($_POST['nombre']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $ean_13 = filter_var($_POST['ean_13']??='',FILTER_SANITIZE_NUMBER_INT);
        $descripcion = filter_var($_POST['descripcion']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_var($_POST['categoria']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $precio_venta = filter_var($_POST['precio_venta']??='',FILTER_SANITIZE_NUMBER_INT);
        $stock = filter_var($_POST['stock']??='',FILTER_SANITIZE_NUMBER_INT);

        # creamos un objeto
        $producto = new Producto(
            null,
            $nombre,
            $ean_13,
            $descripcion,
            $categoria,
            $precio_venta,
            $stock
        );

        # validación
        $errores = [];

        if (empty($nombre)) {
            $errores['nombre'] = "Campo obligatorio";
        } else if (strlen($descripcion) > 20) {
            $errores['nombre'] = "Superaste el limite de caracteres";
        }

        $ean = [
            'options' => [
                'regexp' => '/^[0-9]{13}$/'
            ]
        ];

        if (!empty($ean_13) && !filter_var($ean_13, FILTER_VALIDATE_REGEXP, $ean)) {
            $errores['ean_13'] = "Debe ser numerico y tener 5 caracteres";
        }

        if (empty($descripcion)) {
            $errores['descripcion'] = "Campo obligatorio";
        } else if (strlen($descripcion) > 80) {
            $errores['descripcion'] = "Superaste el limite de caracteres";
        }

        if (empty($categoria)) {
            $errores['categoria'] = "Campo obligatorio";
        } else if (strlen($categoria) > 20) {
            $errores['categoria'] = "Superaste el limite de caracteres";
        }

        # comprobar validación
        if(!empty($errores)){
            // Errores de validación
            $_SESSION['producto'] = serialize($producto);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos de new al formulario
            header('location:'.URL.'productos/new/index');
        } else{
            # Añadimos el registro a la tabla
            $this->model->create($producto);

            // Crearemos un mensaje, indicando que se ha realizado dicha acción
            $_SESSION['mensaje']="Se ha creado la producto bancaria correctamente.";

            // Redireccionamos a la vista principal de productos
            header("Location:" . URL . "productos");
        }
    }
    }

    # Método delete
    function delete($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['delete'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'productos');
        } else {
        $id=$param[0];
        $this->model->delete($id);
        header("Location:" . URL . "productos");
        }
    }

    # Método edit

    function edit($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['edit'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'productos');
        } else {
        # Obtengo el id 
        $id = $param[0];

        $this->view->id = $id;

        # Comprobamos el formulario 
        if(isset($_SESSION['error'])){
            // Añadimos a la vista en el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Autorellenamos el formulario
            $this->view->producto = unserialize($_SESSION['producto']);

            // Recuperamos el array con los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['producto']);

        }

        $this->view->title = "Formulario edit producto";

        $this->view->producto = $this->model->getProducto($id);
        
        $this->view->render("productos/edit/index");
    }
    }

    # Método update
    function update($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['edit'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'productos');
        } else {

        # datos del formulario
        $nombre = filter_var($_POST['nombre']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $ean_13 = filter_var($_POST['ean_13']??='',FILTER_SANITIZE_NUMBER_INT);
        $descripcion = filter_var($_POST['descripcion']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_var($_POST['categoria']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $precio_venta = filter_var($_POST['precio_venta']??='',FILTER_SANITIZE_NUMBER_INT);
        $stock = filter_var($_POST['stock']??='',FILTER_SANITIZE_NUMBER_INT);

        # creamos un objeto
        $producto = new Producto(
            null,
            $nombre,
            $ean_13,
            $descripcion,
            $categoria,
            $precio_venta,
            $stock
        );

        // Cargamos el id 
        $id = $param[0];

        # Obtenemos el objeto 
        $original = $this->model-getProducto($id);
       

        # validación

        $errores = [];

        if (strcmp($nombre,$original->nombre) !==0){
            if (empty($nombre)) {
                $errores['nombre'] = "Campo obligatorio";
            } else if (strlen($nombre) > 20) {
                $errores['nombre'] = "Superaste el limite de caracteres";
            }
        }

        if(strcmp($ean_13,$original->ean_13) !== 0){
            $ean = [
                'options' => [
                    'regexp' => '/^[0-9]{13}$/'
                ]
            ];
    
        if (!empty($ean_13) && !filter_var($ean_13, FILTER_VALIDATE_REGEXP, $ean)) {
            $errores['ean_13'] = "Debe ser numerico y tener 5 caracteres";
        }
        }

        if(strcmp($descripcion,$original->descripcion) !==0){
            if (empty($descripcion)) {
                $errores['descripcion'] = "Campo obligatorio";
            } else if (strlen($descripcion) > 80) {
                $errores['descripcion'] = "Superaste el limite de caracteres";
            }
        }
    
        if(strcmp($categoria,$original->categoria) !==0){
            if (empty($categoria)) {
                $errores['categoria'] = "Campo obligatorio";
            } else if (strlen($categoria) > 20) {
                $errores['categoria'] = "Superaste el limite de caracteres";
            }
        }

        # comprobar validación
        if(!empty($errores)){
            // Errores de validación
            $_SESSION['producto'] = serialize($producto);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            header('location:' . URL . 'productos/edit/'.$id);
        } else {
            $this->model->update($producto, $id);

            $_SESSION['mensaje'] = 'Se ha actualizado la producto con éxito';

            header("Location:" . URL . "productos");
        }
    }
    }

    
    # Método show
    function show($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['show'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'productos');
        } else {
        # id de la producto
        $id = $param[0];

        $this->view->title = "Formulario producto Mostar";
        $this->view->producto = $this->model->getProducto($id);
        //$this->view->cliente = $this->model->getCliente($this->view->producto->ean_13);
       

        $this->view->render("productos/show/index");
        }
    }

    # Método order
    function order($param=[])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['order'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'productos');
        } else {
        $criterio=$param[0];
        $this->view->title = "Tabla productos";
        $this->view->productos=$this->model->order($criterio);
        $this->view->render("productos/main/index");
        }
    }

    # Método buscar
    function filter($param=[])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['productos']['filter'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'productos');
        } else {
        $expresion=$_GET["expresion"];
        $this->view->title = "Tabla productos";
        $this->view->productos= $this->model->filter($expresion);
        $this->view->render("productos/main/index");
        }
    }
}
