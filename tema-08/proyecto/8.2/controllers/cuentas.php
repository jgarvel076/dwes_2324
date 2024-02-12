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

    #Metodo importar
    function importarCSV() {
        // Iniciar la sesión
        session_start();
    
        // Verificar que el usuario esté autenticado y tenga los privilegios necesarios
        if (!isset($_SESSION['id']) || !in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['filter'])) {
            // Si no está autenticado o no tiene permisos, redirigir al usuario
            $_SESSION['mensaje'] = "Debe autenticarse y tener privilegios para realizar esta operación";
            header('location:' . URL . 'login');
            exit;
        }
    
        // Verificar que se haya subido un archivo CSV
        if (isset($_FILES['csvfile']) && $_FILES['csvfile']['error'] == UPLOAD_ERR_OK) {
            // Mover el archivo CSV a una carpeta temporal
            $uploadPath = 'ruta/temporal/para/csvfiles/';
            $tempFile = tempnam($uploadPath, 'csv');
            move_uploaded_file($_FILES['csvfile']['tmp_name'], $tempFile);
    
            // Conectar a la base de datos MariaDB
            $db = new mysqli('localhost', 'username', 'password', 'gesbank');
            if ($db->connect_error) {
                die("Error de conexión: " . $db->connect_error);
            }
    
            // Importar los datos del CSV a la base de datos
            $query = '';
            if ($_SESSION['tablaActual'] === 'Clientes') {
                $query = "LOAD DATA INFILE '{$tempFile}' INTO TABLE clientes FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' IGNORE  1 LINES";
            } elseif ($_SESSION['tablaActual'] === 'Cuentas') {
                $query = "LOAD DATA INFILE '{$tempFile}' INTO TABLE cuentas FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' IGNORE  1 LINES";
            }
    
            if ($db->query($query)) {
                $_SESSION['mensaje'] = "Importación de datos completada con éxito.";
            } else {
                $_SESSION['mensaje'] = "Error durante la importación de datos: " . $db->error;
            }
    
            // Eliminar el archivo CSV temporal
            unlink($tempFile);
    
            // Desconectar de la base de datos
            $db->close();
        } else {
            $_SESSION['mensaje'] = "No se subió ningún archivo CSV válido.";
        }
    
        // Redirigir a la página principal de clientes o cuentas, según corresponda
        header('location:' . URL . 'clientes');
    }

    function exportar() {
        // Iniciar la sesión
        session_start();
    
        // Verificar que el usuario esté autenticado y tenga los privilegios necesarios
        if (!isset($_SESSION['id']) || !in_array($_SESSION['id_rol'], $GLOBALS['cuentas']['filter'])) {
            // Si no está autenticado o no tiene permisos, redirigir al usuario
            $_SESSION['mensaje'] = "Debe autenticarse y tener privilegios para realizar esta operación";
            header('location:' . URL . 'login');
            exit;
        }
    
        // Crear el archivo CSV
        $fileName = 'exportacion_detalles_' . date('YmdHis') . '.csv';
        $file = fopen($fileName, 'w');
    
        // Escribir los encabezados en el archivo CSV
        fputcsv($file, array('ID', 'Apellidos', 'Nombre', 'Teléfono', 'Ciudad', 'DNI', 'Email'));
        fputcsv($file, array('', '', '', '', '', 'Num Cuenta', 'ID Cliente', 'Fecha Alta', 'Fecha Último Movimiento', 'Número Movimientos', 'Saldo', 'Creado', 'Modificado'));
    
        // Obtener los datos de la tabla cuentas
        $result = $db->query("SELECT * FROM cuentas");
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, $row);
        }
    
        // Cerrar la conexión a la base de datos
        $db->close();
    
        // Cerrar el archivo CSV
        fclose($file);
    
        // Descargar el archivo CSV
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        readfile($fileName);
    
        // Eliminar el archivo CSV temporal
        unlink($fileName);
    }
}
