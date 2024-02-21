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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['main'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'index');
        } else {

        # Si existe un mensaje
        if(isset($_SESSION['mensaje'])){
            $this->view->mensaje = $_SESSION['mensaje'];
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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'cuentas');
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
           // aviso al usuario: 
           $_SESSION['mensaje'] = "Usuario debe autentificarse";

           // login
           header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'cuentas');
        } else {

        # datos del formulario
        $num_cuenta = filter_var($_POST['num_cuenta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($_POST['id_cliente']??='',FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??='',FILTER_SANITIZE_SPECIAL_CHARS);

        # creamos un objeto
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

        # validación
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

        # comprobar validación
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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['delete'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'cuentas');
        } else {
        $id=$param[0];
        $this->model->delete($id);
        header("Location:" . URL . "cuentas");
        }
    }

    # Método editar

    function editar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['edit'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'cuentas');
        } else {
        # Obtengo el id 
        $id = $param[0];

        $this->view->id = $id;

        # Comprobamos el formulario 
        if(isset($_SESSION['error'])){
            // Añadimos a la vista en el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Autorellenamos el formulario
            $this->view->cuenta = unserialize($_SESSION['cuenta']);

            // Recuperamos el array con los errores
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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['edit'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'cuentas');
        } else {

        #datos del formulario
        $num_cuenta = filter_var($_POST['num_cuenta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $id_cliente = filter_var($_POST['id_cliente']??='',FILTER_SANITIZE_NUMBER_INT);
        $num_movimientos = filter_var($_POST['num_movtos']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaUltMovimiento= filter_var($_POST['fecha_ul_mov']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_alta = filter_var($_POST['fecha_alta']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??='',FILTER_SANITIZE_SPECIAL_CHARS);
        
        # creamos el objeto cuenta
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

        // Cargamos el id 
        $id = $param[0];

        # Obtenemos el objeto 
        $original = $this->model->getCuenta($id);
       

        # validación

        $errores = [];

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

        if(strcmp($id_cliente,$original->id_cliente) !== 0){
            if(empty($id_cliente)){
                $errores['id_cliente'] = 'Campo Obligatorio, seleccione un cliente';
            } else if(!filter_var($id_cliente,FILTER_VALIDATE_INT)){
                $errores['id_cliente'] = 'Deberá introducir un valor númerico en este campo';
            } else if(!$this->model->validateCliente($id_cliente)){
                $errores['id_cliente']= 'No existe el cliente indicado';
            }
        }

        if(strcmp($fecha_alta,$original->fecha_alta) !==0){
            if(empty($fecha_alta)){
                $errores['fecha_alta']='Campo Obligatorio, añada una fecha';
            } else if (!$this->model->validateFecha($fecha_alta)){
                $errores['fecha_alta']='La fecha no tiene el formato correcto';
            }
        }

        if(strcmp($fechaUltMovimiento,$original->fecha_ul_mov)){
            if(!empty($fechaUltMovimiento && !$this->model->validateFecha($fechaUltMovimiento))){
                $errores['fecha_ul_mov']='La fecha no tiene el formato correcto';
            }
        }

        # comprobar validación
        if(!empty($errores)){
            // Errores de validación
            $_SESSION['cuenta'] = serialize($cuenta);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            header('location:' . URL . 'cuentas/editar/'.$id);
        } else {
            $this->model->update($cuenta, $id);

            $_SESSION['mensaje'] = 'Se ha actualizado la cuenta con éxito';

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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['show'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'cuentas');
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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['order'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'cuentas');
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
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['cuentas']['filter'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'cuentas');
        } else {
        $expresion=$_GET["expresion"];
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas= $this->model->filter($expresion);
        $this->view->render("cuentas/main/index");
        }
    }

    public function exportar()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['export']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        $cuentas = $this->model->getCSV()->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="cuentas.csv"');

        $ficheroExport = fopen('php://output', 'w');

        // Iterar sobre las cuentas y escribir los datos en el archivo CSV
        foreach ($cuentas as $cuenta) {

            $fecha = date("Y-m-d H:i:s");

            $cuenta['create_at'] = $fecha;
            $cuenta['update_at'] = $fecha;

            $cuenta = array(
                'num_cuenta' => $cuenta['num_cuenta'],
                'id_cliente' => $cuenta['id_cliente'],
                'fecha_alta' => $cuenta['fecha_alta'],
                'fecha_ul_mov' => $cuenta['fecha_ul_mov'],
                'num_movtos' => $cuenta['num_movtos'],
                'saldo' => $cuenta['saldo'],
                'create_at' => $cuenta['create_at'],
                'update_at' => $cuenta['update_at']
            );

            fputcsv($ficheroExport, $cuenta, ';');
        }

        fclose($ficheroExport);
    }

    public function importar()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
            header("location:" . URL . "login");
            exit();
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['import']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo_csv"]) && $_FILES["archivo_csv"]["error"] == UPLOAD_ERR_OK) {
            $file = $_FILES["archivo_csv"]["tmp_name"];

            $handle = fopen($file, "r");

            if ($handle !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $num_cuenta = $data[0];
                    $id_cliente = $data[1];
                    $fecha_alta = $data[2];
                    $fecha_ul_mov = $data[3];
                    $num_movtos = $data[4];
                    $saldo = $data[5];

                    //Método para verificar número de cuenta único.
                    if ($this->model->validateUniqueNumCuenta($num_cuenta)) {
                        // Si no existe, crear una nueva cuenta
                        $cuenta = new classCuenta();
                        $cuenta->num_cuenta = $num_cuenta;
                        $cuenta->id_cliente = $id_cliente;
                        $cuenta->fecha_alta = $fecha_alta;
                        $cuenta->fecha_ul_mov = $fecha_ul_mov;
                        $cuenta->num_movtos = $num_movtos;
                        $cuenta->saldo = $saldo;

                        //Usamos create para meter la cuenta en la base de datos
                        $this->model->create($cuenta);
                    } else {
                        //Error de cuenta existente
                        echo "Error, esta cuenta existente";
                    }
                }

                fclose($handle);
                $_SESSION['mensaje'] = "Importación realizada correctamente";
                header('location:' . URL . 'cuentas');
                exit();
            } else {
                $_SESSION['error'] = "Error con el archivo CSV";
                header('location:' . URL . 'cuentas');
                exit();
            }
        } else {
            $_SESSION['error'] = "Seleccione un archivo CSV";
            header('location:' . URL . 'cuentas');
            exit();
        }
    }

    //pdf

    function pdf()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
            header("location:" . URL . "login");
            exit();
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['pdf']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
            exit();
        }

        //Obtenemos las cuentas con get
        $cuentas = $this->model->get();

        //Instanciamos la clase pdfCuentas
        $pdf = new pdfCuentas();

        //Escribimos en el PDF
        $pdf->contenido($cuentas);

        // Salida del PDF
        $pdf->Output();
    }

}
