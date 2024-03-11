<?php

class Movimientos extends Controller
{
    # Método render
    public function render($param = [])
    {

        # Iniciamos sesión
        session_start();
        
        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        } else {

            # Si existe un mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            $this->view->title = "Tabla Movimientos";
            $this->view->movimientos = $this->model->getMovimientos();
            $this->view->render("movimientos/main/index");
        }
    }

    # Método nuevo
    function nuevo($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['movimientos']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:' . URL . 'movimientos');
        } else {

            # Creamos un objeto vacío
            $this->view->movimiento = new classMovimiento();

            # Comprobamos si existen errores
            if (isset($_SESSION['error'])) {
                //Añadimos a la vista el mensaje de error
                $this->view->error = $_SESSION['error'];

                //Autorellenamos el formulario
                $this->view->movimiento = unserialize($_SESSION['movimiento']);

                // Recuperamos el array con los errores
                $this->view->errores = $_SESSION['errores'];

                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['movimientos']);
            }

            $this->view->title = "Añadir - Gestión Movimientos";
            $this->view->cuentas = $this->model->getCuentas();
            $this->view->render("movimientos/nuevo/index");
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
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['new']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos
            header('location:' . URL . 'movimientos');
        } else {

//-------------------------------------------------------------------------------------------------------------------------------------------------------

        # datos del formulario
            $cuenta = filter_var($_POST['cuenta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha_hora = filter_var($_POST['fecha_hora'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $concepto = filter_var($_POST['concepto'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo = filter_var($_POST['tipo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $cantidad = filter_var($_POST['cantidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $saldo = $this->model->getSaldoCuenta($cuenta);

//----------------------------------------------------------------------------------------------------------------------------------------------------------

            # creamos un objeto
            $movimiento = new classMovimiento(
                null,
                $cuenta,
                $fecha_hora,
                $concepto,
                $tipo,
                $cantidad,
                $saldo
            );

            # validación
            $errores = [];

            if (empty($concepto)) {
                $errores['concepto'] = 'Concepto es obligatorio';
            } else if (strlen($concepto) > 50) {
                $errores['concepto'] = 'Concepto debe ser menor a 50 caracteres';
            }

            if (empty($tipo)) {
                $errores['tipo'] = 'Tipo es obligatorio';
            } else if (!in_array($tipo, ['I', 'R'])) {
                $errores['tipo'] = 'Tipo debe ser I o R';
            }

            if (empty($cantidad)) {
                $errores['cantidad'] = 'Cantidad es obligatorio';
            } else if (!is_numeric($cantidad)) {
                $errores['cantidad'] = 'Cantidad debe ser un numero';
            } else if ($tipo == 'R' && $cantidad > $saldo) {
                $errores['cantidad'] = 'Cantidad erronea';
            }

            # comprobar validación
            if (!empty($errores)) {
                //Errores de validación
                $_SESSION['movimiento'] = serialize($movimiento);
                $_SESSION['error'] = 'Formulario no validado';
                $_SESSION['errores'] = $errores;

                //Redireccionamos de nuevo al formulario
                header('location:' . URL . 'movimientos/nuevo/index');
            } else {

                //Actualizamos el saldo
                if ($tipo == 'I') {
                    $nuevoSaldo = $saldo + $cantidad;
                }
                else {
                    $nuevoSaldo = $saldo - $cantidad;
                }

                //Actualizamos el saldo en el objeto movimiento
                $movimiento->saldo = $nuevoSaldo;

                # Añadimos el registro a la tabla
                $this->model->create($movimiento);

                //Actualizamos el saldo de la cuenta
                $this->model->actualizarSaldo($cuenta, $nuevoSaldo);

                //Crearemos un mensaje, indicando que se ha realizado dicha acción
                $_SESSION['mensaje'] = "Se ha creado el movimiento bancaria correctamente.";

                // Redireccionamos a la vista principal de movimientos
                header("Location:" . URL . "movimientos");
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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['movimientos']['show'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'movimientos');
        } else {
        # id de la cuenta
        $id = $param[0];

            $this->view->title = "Formulario Mostrar Movimiento";
            $this->view->movimiento = $this->model->getMovimiento($id);
            $this->view->cuenta = $this->model->getCuenta($this->view->movimiento->cuenta);

            $this->view->render("movimientos/mostrar/index");
        }
    }

    # Método ordenar
    function ordenar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['movimientos']['order'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:' . URL . 'movimientos');
        } else {

            $criterio = $param[0];
            $this->view->title = "Tabla Movimientos";
            $this->view->movimientos = $this->model->order($criterio);
            $this->view->render("movimientos/main/index");
        }
    }

    # Método buscar
    function buscar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['movimientos']['filter'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:' . URL . 'movimientos');
        } else {


            $expresion = $_GET["expresion"];
            $this->view->title = "Tabla Movimientos";
            $this->view->movimientos = $this->model->filter($expresion);
            $this->view->render("movimientos/main/index");
        }
    }
}