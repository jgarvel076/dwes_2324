<?php

class Clientes extends Controller
{

    # Método principal
    public function render($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['main'])){
            // mostramos mensaje
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Cargamos el index
            header('location:'.URL.'index');
        } else {
            # mostramos mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            $this->view->title = "Tabla Clientes";

            $this->view->clientes = $this->model->get();

            $this->view->render("clientes/main/index");
        }
    }

    # Método nuevoe
    public function nuevo($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // Añadimo el siguiente aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'clientes');
        } else {
            # Creamos un objeto 
            $this->view->cliente = new Cliente();

            # Comprobamos errores
            if (isset($_SESSION['error'])) {
                // Añadimos a la vista el mensaje de error
                $this->view->error = $_SESSION['error'];

                // Autorellenamos el formulario
                $this->view->cliente = unserialize($_SESSION['cliente']);

                // Recuperamos los errores
                $this->view->errores = $_SESSION['errores'];

                unset($_SESSION['error']);
                unset($_SESSION['cliente']);
                unset($_SESSION['errores']);


            }

            $this->view->title = "Formulario nuevo cliente ";

            $this->view->render("clientes/nuevo/index");
        }
    }

    # Método create. 
    public function create($param = [])
    {
        # Inicio sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['new'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista  de clientes
            header('location:'. URL .'clientes');
        } else {
        # datos del formulario
        $nombre = filter_var($_POST["nombre"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST["apellidos"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST["telefono"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);

        # creamos el cliente
        $cliente = new Cliente(
            null,
            $apellidos,
            $nombre,
            $telefono,
            $ciudad,
            $dni,
            $email,
            null,
            null
        );

        # validación
        // Creamos el array de errores
        $errores = [];

        if (empty($apellidos)) {
            $errores['apellidos'] = "Campo obligatorio";
        } else if (strlen($apellidos) > 45) {
            $errores['apellidos'] = "Superaste el limite de caracteres";
        }

        if (empty($nombre)) {
            $errores['nombre'] = "Campo obligatorio";
        } else if (strlen($nombre) > 20) {
            $errores['nombre'] = "Superaste el limite de caracteres";
        }

        $tel = [
            'options' => [
                'regexp' => '/^[0-9]{9}$/'
            ]
        ];

        if (!empty($telefono) && !filter_var($telefono, FILTER_VALIDATE_REGEXP, $tel)) {
            $errores['telefono'] = "Debe ser numerico y tener 9 caracteres";
        }

        if (empty($ciudad)) {
            $errores['ciudad'] = "Campo obligatorio";
        } else if (strlen($ciudad) > 20) {
            $errores['ciudad'] = "Superaste el limite de caracteres";
        }

        $dniRegexp = [
            'options' => [
                'regexp' => '/^[0-9]{8}[A-Z]$/'
            ]
        ];

        if (empty($dni)) {
            $errores['dni'] = "Campo obligatorio";
        } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $dniRegexp)) {
            $errores['dni'] = "Formato DNI incorrecto";
        } else if (!$this->model->validateUniqueDni($dni)) {
            $errores['dni'] = "El DNI introducido ya ha sido registrado";
        }

        if (empty($email)) {
            $errores['email'] = "Campo obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Formato Email no válido";
        } else if (!$this->model->validateUniqueEmail($email)) {
            $errores['email'] = "El correo electrónico introducido ya está registrado";
        }

        # comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            $_SESSION['cliente'] = serialize($cliente);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos nuevamente al formulario nuevo
            header('Location:' . URL . 'clientes/nuevo');
        } else {
            // Añadimos el registro a la base de datos
            $this->model->create($cliente);

            // Creamos el mensaje personalizado
            $_SESSION['mensaje'] = 'Cliente creado correctamente';

            // Redirigimos a la vista principal de clientes
            header("Location:" . URL . "clientes");
        }
    }
    }

    # Método delete. 
    public function delete($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            //aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['delete'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'. URL .'clientes');
        } else {
        $id = $param[0];
        $this->model->delete($id);
        $_SESSION['mensaje'] = "Cliente eliminado correctamente";
        header("Location:" . URL . "clientes");
        }
    }

    # Método editar. 
    public function editar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            //aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['edit'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'clientes');
        } else {
        # Obtenemos el id
        $id = $param[0];
        $this->view->id = $id;

        $this->view->title = "Formulario  editar cliente";

        $this->view->cliente = $this->model->getCliente($id);

        # Comprobamos si existen errores
        if (isset($_SESSION["error"])) {
            // Añadimos a la vista el mensaje de error
            $this->view->error = $_SESSION["error"];

            // Autorellenamos el formulario
            $this->view->cliente = unserialize($_SESSION['cliente']);

            // errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['cliente']);
            unset($_SESSION['errores']);
        }

        # Cargamos la vista del cliente
        $this->view->render("clientes/editar/index");
    }
    }

    # Método update
    public function update($param = [])
    {

        # Inicio sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            //aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['edit'])){
 
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'. URL .'clientes');
        } else {

        # datos del formulario
        $nombre = filter_var($_POST["nombre"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST["apellidos"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST["telefono"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);

        # Creamos el cliente
        $cliente = new Cliente(
            null,
            $apellidos,
            $nombre,
            $telefono,
            $ciudad,
            $dni,
            $email,
            null,
            null
        );

        # Cargamos el id 
        $id = $param[0];

        # Obtenemos el cliente 
        $clienteOriginal = $this->model->getCliente($id);

        # Validación
        $errores = [];

        if (strcmp($apellidos, $clienteOriginal->apellidos) !== 0) {
            if (empty($apellidos)) {
                $errores['apellidos'] = "Campo obligatorio";
            } else if (strlen($apellidos) > 45) {
                $errores['apellidos'] = "Superaste el limite de caracteres";
            }
        }

        if (strcmp($nombre, $clienteOriginal->nombre) !== 0) {
            if (empty($nombre)) {
                $errores['nombre'] = "Campo obligatorio";
            } else if (strlen($nombre) > 20) {
                $errores['nombre'] = "Superaste el limite de caracteres";
            }
        }

        if (strcmp($telefono, $clienteOriginal->telefono)) {
            $tel = [
                'options' => [
                    'regexp' => '/^[0-9]{9}$/'
                ]
            ];

            if (!empty($telefono) && !filter_var($telefono, FILTER_VALIDATE_REGEXP, $tel)) {
                $errores['telefono'] = "Debe ser numerico y tener 9 caracteres";
            }
        }

        if (strcmp($ciudad, $clienteOriginal->ciudad) !== 0) {
            // Ciudad. Obligatorio, tamaño máximo de 20
            if (empty($ciudad)) {
                $errores['ciudad'] = "Campo obligatorio";
            } else if (strlen($ciudad) > 20) {
                $errores['ciudad'] = "Superaste el limite de caracteres";
            }
        }

        if (strcmp($dni, $clienteOriginal->dni) !== 0) {
            $dniRegexp = [
                'options' => [
                    'regexp' => '/^[0-9]{8}[A-Z]$/'
                ]
            ];

            if (empty($dni)) {
                $errores['dni'] = "Campo obligatorio";
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $dniRegexp)) {
                $errores['dni'] = "Formato DNI incorrecto";
            } else if (!$this->model->validateUniqueDni($dni)) {
                $errores['dni'] = "El DNI introducido ya ha sido registrado";
            }
        }

        if (strcmp($email, $clienteOriginal->email) !== 0) {
            if (empty($email)) {
                $errores['email'] = "Campo obligatorio";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "Formato Email no válido";
            } else if (!$this->model->validateUniqueEmail($email)) {
                $errores['email'] = "El correo electrónico introducido ya está registrado";
            }
        }

        if (!empty($errores)) {
            // Errores 
            $_SESSION['cliente'] = serialize($cliente);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            header('location:' . URL . 'clientes/editar/' . $id);
        } else {
            // Actualizamos el registro
            $this->model->update($cliente, $id);

            // Añadimos a la variable de sesión un mensaje
            $_SESSION['mensaje'] = 'Cliente actualizado correctamente';

            // Redireccionamos a clientes
            header("Location:" . URL . "clientes");
        }
    }
    }


    # Método mostrar
    public function mostrar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            //aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['show'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes
            header('location:'.URL.'clientes');
        } else {
        $id = $param[0];
        $this->view->title = "Formulario Cliente Mostar";
        $this->view->cliente = $this->model->getCliente($id);
        $this->view->render("clientes/mostrar/index");
        }
    }

    # Método ordenar
    public function ordenar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            //aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['order'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'clientes');
        } else {
        $criterio = $param[0];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->order($criterio);
        $this->view->render("clientes/main/index");
        }
    }

    # Método buscar

    public function buscar($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            // aviso al usuario: 
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            // login
            header('location:' . URL . 'login');
        } else if(!in_array($_SESSION['id_rol'],$GLOBALS['clientes']['filter'])){

            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";

            // Redireccionamos a la vista de clientes 
            header('location:'.URL.'clientes');
        } else {
        $expresion = $_GET["expresion"];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->filter($expresion);
        $this->view->render("clientes/main/index");
        }
    }

    public function exportar()
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['clientes']['export']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        $clientes = $this->model->getCSV()->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="clientes.csv"');

        $ficheroExport = fopen('php://output', 'w');

        foreach ($clientes as $cliente) {
            $fecha = date("Y-m-d H:i:s");

            $cliente['create_at'] = $fecha;
            $cliente['update_at'] = $fecha;

            $cliente = array(
                'apellidos' => $cliente['apellidos'],
                'nombre' => $cliente['nombre'],
                'email' => $cliente['email'],
                'telefono' => $cliente['telefono'],
                'ciudad' => $cliente['ciudad'],
                'dni' => $cliente['dni'],
                'create_at' => $cliente['create_at'],
                'update_at' => $cliente['update_at']
            );

            fputcsv($ficheroExport, $cliente, ';');
        }

        fclose($ficheroExport);
    }

    public function importar()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "El usuario debe autenticarse";
            header("location:" . URL . "login");
            exit();
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['clientes']['import']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo_csv"]) && $_FILES["archivo_csv"]["error"] == UPLOAD_ERR_OK) {
            $file = $_FILES["archivo_csv"]["tmp_name"];

            $handle = fopen($file, "r");

            if ($handle !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $apellidos = $data[0];
                    $nombre = $data[1];
                    $email = $data[2];
                    $telefono = $data[3];
                    $ciudad = $data[4];
                    $dni = $data[5];

                    //Método para verificar email y dni único.
                    if ($this->model->validateUniqueEmail($email) && $this->model->validateDNI($dni)) {
                        //Si no existe, crear un nuevo cliente
                        $cliente = new classCliente();
                        $cliente->apellidos = $apellidos;
                        $cliente->nombre = $nombre;
                        $cliente->email = $email;
                        $cliente->telefono = $telefono;
                        $cliente->ciudad = $ciudad;
                        $cliente->dni = $dni;

                        //Usamos create para meter el cliente en la base de datos
                        $this->model->create($cliente);
                    } else {
                        //Error de cliente existente
                        echo "Error, este cliente existe";
                    }
                }

                fclose($handle);
                $_SESSION['mensaje'] = "Importación realizada correctamente";
                header('location:' . URL . 'clientes');
                exit();
            } else {
                $_SESSION['error'] = "Error con el archivo CSV";
                header('location:' . URL . 'clientes');
                exit();
            }
        } else {
            $_SESSION['error'] = "Seleccione un archivo CSV";
            header('location:' . URL . 'clientes');
            exit();
        }
    }

    //PDF

    function pdf()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "El usuario debe autenticarse";
            header("location:" . URL . "login");
            exit();
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['clientes']['pdf']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
            exit();
        }

        //Obtenemos los clientes
        $clientes = $this->model->get();

        $pdf = new pdfClientes();

        //Escribimos en el PDF
        $pdf->contenido($clientes);

        // Salida del PDF
        $pdf->Output();
    }
}
