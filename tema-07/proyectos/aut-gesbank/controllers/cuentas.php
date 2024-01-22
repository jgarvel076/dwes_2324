<?php

class Cuentas extends Controller
{

    # Método render

    function render($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Autentificacion del Usuario";

            // login
            header('location:' . URL . 'login');
        } else {

        # Si existe un mensaje, lo mostramos
        if(isset($_SESSION['mensaje'])){
            // Añadimos a la vista el mensaje
            $this->view->mensaje = $_SESSION['mensaje'];
            // Destruimos el mensaje
            unset($_SESSION['mensaje']);
        }
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas = $this->model->get();
        $this->view->render("cuentas/main/index");
    }
    }

    # Método nuevo
    function nuevo($param = [])
    { 
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Autentificacion del Usuario";

            // login
            header('location:' . URL . 'login');
        } else {

        # Creamos un objeto vacío
        $this->view->cuenta = new Cuenta();

        # Comprobamos si existen errores
        if(isset($_SESSION['error'])){
            // Añadimos a la vista el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Autorellenamos el formulario
            $this->view->cuenta = unserialize($_SESSION['cuenta']);

            // Recuperamos el array con los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cuenta']);
        }

        $this->view->title = "Formulario añadir cuenta";

        $this->view->clientes= $this->model->getClientes();

        $this->view->render("cuentas/nuevo/index");
    }
    }

    # Método create
    function create($param = [])
    {
       # Iniciamos sesión
       session_start();

       # Comprobamos si el usuario está autentificado
       if (!isset($_SESSION['id'])) {
           // Añadimo el siguiente aviso al usuario: 
           $_SESSION['mensaje'] = "Usuario debe autentificarse";

           // login
           header('location:' . URL . 'login');
       } else {

        #datos del formulario
        $num_cuenta = filter_var($_POST['num_cuenta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($_POST['id_cliente']??='',FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??='',FILTER_SANITIZE_SPECIAL_CHARS);

        # Creamos un objeto de la clase "Cuenta"
        $cuenta = new Cuenta(
            null,
            $num_cuenta,
            $id_cliente,
            $fecha_alta,
            date("d-m-Y H:i:s"),
            0,
            $saldo,
            null,
            null
        );

        # Validación
        $errores = [];

        $cuenta_regexp=[
            'options' => [
                'regexp' => '/^[0-9]{20}$/'
            ]
        ];
        if(empty($num_cuenta)){
            $errores['num_cuenta'] = 'Campo Obligatorio, añada un número de cuenta';
        } else if (!filter_var($num_cuenta,FILTER_VALIDATE_REGEXP,$cuenta_regexp)){
            $errores['num_cuenta'] = 'Formato no valido, deben ser 20 caracteres númericos';
        } else if (!$this->model->validateUniqueNumCuenta($num_cuenta)){
            $errores['num_cuenta'] = "El número de cuenta ya está registrado";
        }

        if(empty($id_cliente)){
            $errores['id_cliente'] = 'Campo Obligatorio, seleccione un cliente';
        } else if(!filter_var($id_cliente,FILTER_VALIDATE_INT)){
            $errores['id_cliente'] = 'Deberá introducir un valor númerico en este campo';
        } else if(!$this->model->validateCliente($id_cliente)){
            $errores['id_cliente']= 'No existe el cliente indicado';
        }

        if(empty($fecha_alta)){
            $errores['fecha_alta']='Campo Obligatorio, añada una fecha';
        } else if (!$this->model->validateFecha($fecha_alta)){
            $errores['fecha_alta']='La fecha no tiene el formato correcto';
        }

        # Comprobar validación
        if(!empty($errores)){
            // Errores de validación
            $_SESSION['cuenta'] = serialize($cuenta);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos de nuevo al formulario
            header('location:'.URL.'cuentas/nuevo/index');
        } else{
            # Añadimos el registro a la tabla
            $this->model->create($cuenta);

            // Crearemos un mensaje, indicando que se ha realizado dicha acción
            $_SESSION['mensaje']="Se ha creado la cuenta bancaria correctamente.";

            // Redireccionamos a la vista principal de cuentas
            header("Location:" . URL . "cuentas");
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
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Autentificacion del Usuario";

            // login
            header('location:' . URL . 'login');
        } else {
        $id=$param[0];
        $this->model->delete($id);
        header("Location:" . URL . "cuentas");
        }
    }

    # Método editar

    function editar($param = [])
    {
        # Iniciamos o continuamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            //login
            header('location:' . URL . 'login');
        } else {
        # Obtengo el id de la cuenta a editar
        $id = $param[0];

        $this->view->id = $id;

        if(isset($_SESSION['error'])){
            // Añadimos a la vista en el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Autorellenamos el formulario
            $this->view->cuenta = unserialize($_SESSION['cuenta']);

            // Recuperamos los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cuenta']);

        }


        $this->view->title = "Formulario editar cuenta";

        $this->view->clientes = $this->model->getClientes();
        $this->view->cuenta = $this->model->getCuenta($id);
        
        $this->view->render("cuentas/editar/index");
    }
    }

    # Método update

    function update($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else {

        #datos del formulario
        $num_cuenta = filter_var($_POST['num_cuenta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($_POST['id_cliente']??='',FILTER_SANITIZE_NUMBER_INT);
        $num_movimientos = filter_var($_POST['num_movtos']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaUltMovimiento= filter_var($_POST['fecha_ul_mov']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_alta = filter_var($_POST['fecha_alta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        
        # Creamos el objeto cuenta
        $cuenta = new Cuenta(
            null,
            $num_cuenta,
            $id_cliente,
            $fecha_alta,
            $fechaUltMovimiento,
            $num_movimientos,
            $saldo,
            null,
            null
        );

        // Cargamos el id de la cuenta a actualizar
        $id = $param[0];

        # Obtenemos el objeto original de la clase Cuenta
        $original = $this->model->getCuenta($id);
       

        # Validación
        
        $errores = [];

        // Validar el numero de cuenta
        if (strcmp($num_cuenta,$original->num_cuenta) !==0){
            $cuenta_regexp=[
                'options' => [
                    'regexp' => '/^[0-9]{20}$/'
                ]
            ];
            if(empty($num_cuenta)){
                $errores['num_cuenta'] = 'Campo Obligatorio, añada un número de cuenta';
            } else if (!filter_var($num_cuenta,FILTER_VALIDATE_REGEXP,$cuenta_regexp)){
                $errores['num_cuenta'] = 'Formato no valido, deben ser 20 caracteres númericos';
            } else if (!$this->model->validateUniqueNumCuenta($num_cuenta)){
                $errores['num_cuenta'] = "El número de cuenta ya está registrado";
            }
        }

        // Validar el cliente
        if(strcmp($id_cliente,$original->id_cliente) !== 0){
            if(empty($id_cliente)){
                $errores['id_cliente'] = 'Campo Obligatorio, seleccione un cliente';
            } else if(!filter_var($id_cliente,FILTER_VALIDATE_INT)){
                $errores['id_cliente'] = 'Deberá introducir un valor númerico en este campo';
            } else if(!$this->model->validateCliente($id_cliente)){
                $errores['id_cliente']= 'No existe el cliente indicado';
            }
        }

        // Validar la fecha de alta
        if(strcmp($fecha_alta,$original->fecha_alta) !==0){
            if(empty($fecha_alta)){
                $errores['fecha_alta']='Campo Obligatorio, añada una fecha';
            } else if (!$this->model->validateFecha($fecha_alta)){
                $errores['fecha_alta']='La fecha no tiene el formato correcto';
            }
        }

        // Validamos la fecha de último movimiento
        if(strcmp($fechaUltMovimiento,$original->fecha_ul_mov)){
            if(!empty($fechaUltMovimiento && !$this->model->validateFecha($fechaUltMovimiento))){
                $errores['fecha_ul_mov']='La fecha no tiene el formato correcto';
            }
        }

        # Comprobar validación
        if(!empty($errores)){
            // Errores de validación
            $_SESSION['cuenta'] = serialize($cuenta);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos
            header('location:' . URL . 'cuentas/editar/'.$id);
        } else {
            // Actualizamos el registro de la base de datos
            $this->model->update($cuenta, $id);

            // Creamos el mensaje personalizado
            $_SESSION['mensaje'] = 'Se ha actualizado la cuenta con éxito';
            
            // Redireccionamos a la vista principal de cuentas
            header("Location:" . URL . "cuentas");
        }
    }
    }

    
    # Método mostrar
    function mostrar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            //login
            header('location:' . URL . 'login');
        } else {
        # id de la cuenta
        $id = $param[0];

        $this->view->title = "Formulario Cuenta Mostar";
        $this->view->cuenta = $this->model->getCuenta($id);
        $this->view->cliente = $this->model->getCliente($this->view->cuenta->id_cliente);

        $this->view->render("cuentas/mostrar/index");
        }
    }

    # Método ordenar

    function ordenar($param=[])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            //login
            header('location:' . URL . 'login');
        } else {
        $criterio=$param[0];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas=$this->model->order($criterio);
        $this->view->render("cuentas/main/index");
        }
    }

    # Método buscar
 
    function buscar($param=[])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            //login
            header('location:' . URL . 'login');
        } else {
        $expresion=$_GET["expresion"];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas= $this->model->filter($expresion);
        $this->view->render("cuentas/main/index");
        }
    }
}
