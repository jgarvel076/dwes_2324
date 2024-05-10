<?php

class Clientes extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    function render()
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

        # Creo la propiedad title de la vista
        $this->view->title = "Tabla de clientes";

        # Creo la propiedad clientes dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get();
        $this->view->clientes = $this->model->get();

        $this->view->render('clientes/main/index');
        }
    }

    function new()
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

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión clientes";

        # cargo la vista con el formulario nuevo cliente
        $this->view->render('clientes/new/index');
        }
    }

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
        $direccion = filter_var($_POST["direccion"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST["telefono"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $c_postal = filter_var($_POST['c_postal'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $nif = filter_var($_POST['nif'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        # creamos el cliente
        $cliente = new Cliente(
            null,
            $nombre,
            $direccion,
            $poblacion,
            $c_postal,
            $telefono,
            $email,
            $nif
        );

        # validación
        // Creamos el array de errores
        $errores = [];

        

        if (empty($nombre)) {
            $errores['nombre'] = "Campo obligatorio";
        } else if (strlen($nombre) > 20) {
            $errores['nombre'] = "Superaste el limite de caracteres";
        }

        if (empty($direccion)) {
            $errores['direccion'] = "Campo obligatorio";
        } else if (strlen($direccion) > 45) {
            $errores['direccion'] = "Superaste el limite de caracteres";
        }
        
        if (empty($poblacion)) {
            $errores['poblacion'] = "Campo obligatorio";
        } else if (strlen($poblacion) > 20) {
            $errores['poblacion'] = "Superaste el limite de caracteres";
        }

        $codigopostal = [
            'options' => [
                'regexp' => '/^[0-9]{5}$/'
            ]
        ];
        
        if (!empty($c_postal) && !filter_var($c_postal, FILTER_VALIDATE_REGEXP, $codigopostal)) {
            $errores['c_postal'] = "Debe ser numerico y tener 5 caracteres";
        }

        $tel = [
            'options' => [
                'regexp' => '/^[0-9]{9}$/'
            ]
        ];

        if (!empty($telefono) && !filter_var($telefono, FILTER_VALIDATE_REGEXP, $tel)) {
            $errores['telefono'] = "Debe ser numerico y tener 9 caracteres";
        }

        if (empty($email)) {
            $errores['email'] = "Campo obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Formato Email no válido";
        } else if (!$this->model->validateUniqueEmail($email)) {
            $errores['email'] = "El correo electrónico introducido ya está registrado";
        }

        $nifRegexp = [
            'options' => [
                'regexp' => '/^[0-9]{8}[A-Z]$/'
            ]
        ];

        if (empty($nif)) {
            $errores['nif'] = "Campo obligatorio";
        } else if (!filter_var($nif, FILTER_VALIDATE_REGEXP, $nifRegexp)) {
            $errores['nif'] = "Formato nif incorrecto";
        } else if (!$this->model->validateUniquenif($nif)) {
            $errores['nif'] = "El nif introducido ya ha sido registrado";
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

    function edit($param = [])
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
        # cargo la vista
        $this->view->render('clientes/edit/index');
    }
    }

    function update($param = [])
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
        $direccion = filter_var($_POST["direccion"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST["telefono"] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $c_postal = filter_var($_POST['c_postal'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $nif = filter_var($_POST['nif'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        # creamos el cliente
        $cliente = new Cliente(
            null,
            $nombre,
            $direccion,
            $poblacion,
            $c_postal,
            $telefono,
            $email,
            $nif
        );

        # Cargamos el id 
        $id = $param[0];

        # Obtenemos el cliente 
        $clienteOriginal = $this->model->getCliente($id);

        # Validación
        $errores = [];
        

        if (strcmp($nombre, $clienteOriginal->nombre) !== 0) {
            if (empty($nombre)) {
                $errores['nombre'] = "Campo obligatorio";
            } else if (strlen($nombre) > 20) {
                $errores['nombre'] = "Superaste el limite de caracteres";
            }
        }

        if (strcmp($direccion, $clienteOriginal->direccion) !==0){
            if (empty($direccion)) {
                $errores['direccion'] = "Campo obligatorio";
            } else if (strlen($direccion) > 45) {
                $errores['direccion'] = "Superaste el limite de caracteres";
            }
        }
        
        if (strcmp($poblacion, $clienteOriginal->poblacion) !==0){
            if (empty($poblacion)) {
                $errores['poblacion'] = "Campo obligatorio";
            } else if (strlen($poblacion) > 20) {
                $errores['poblacion'] = "Superaste el limite de caracteres";
            }
        }

        if (strcmp($c_postal, $clienteOriginal->c_postal)) {
            $codigopostal = [
                'options' => [
                    'regexp' => '/^[0-9]{5}$/'
                ]
            ];

            if (!empty($c_postal) && !filter_var($c_postal, FILTER_VALIDATE_REGEXP, $codigopostal)) {
                $errores['c_postal'] = "Debe ser numerico y tener 5 caracteres";
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

        if (strcmp($email, $clienteOriginal->email) !== 0) {
            if (empty($email)) {
                $errores['email'] = "Campo obligatorio";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "Formato Email no válido";
            } else if (!$this->model->validateUniqueEmail($email)) {
                $errores['email'] = "El correo electrónico introducido ya está registrado";
            }
        }

        if (strcmp($nif, $clienteOriginal->nif) !== 0) {
            $nifRegexp = [
                'options' => [
                    'regexp' => '/^[0-9]{8}[A-Z]$/'
                ]
            ];

            if (empty($nif)) {
                $errores['nif'] = "Campo obligatorio";
            } else if (!filter_var($nif, FILTER_VALIDATE_REGEXP, $nifRegexp)) {
                $errores['nif'] = "Formato nif incorrecto";
            } else if (!$this->model->validateUniquenif($nif)) {
                $errores['nif'] = "El nif introducido ya ha sido registrado";
            }
        }

        

        # comprobar validación
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

    function show($param = [])
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

        // Cargo la vista de detalles del cliente
        $this->view->render('clientes/show/index');

    }
    }


    function order($param = [])
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

        # Cargo la vista principal de clientes
        $this->view->render('clientes/main/index');

    }
    }

    

    function filter($param = [])
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

        //Creamos la variable clientes dentro de la vista
        //Esta variable ejecuta el método get() del modelo clientesModel
        $this->view->clientes = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('clientes/main/index');
    }
    }

    function delete($param = [])
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

    public function export()
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
                'nombre' => $cliente['nombre'],
                'direccion' => $cliente['direccion'],
                'poblacion' => $cliente['poblacion'],
                'c_postal' => $cliente['c_postal'],
                'telefono' => $cliente['telefono'],
                'email' => $cliente['email'],
                'nif' => $cliente['nif']
            );

            fputcsv($ficheroExport, $cliente, ';');
        }

        fclose($ficheroExport);
    }

    public function import()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
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
                    $nombre = $data[1];
                    $direccion = $data[2];
                    $poblacion = $data[3];
                    $c_postal = $data[4];
                    $telefono = $data[5];
                    $email = $data[6];
                    $nif = $data[7];

                    //Método para verificar email y dni único.
                    if ($this->model->validateUniqueEmail($email) && $this->model->validateUniquenif($nif)) {
                        //Si no existe, crear un nuevo cliente
                        $cliente = new classCliente();
                        $cliente->nombre = $nombre;
                        $cliente->direccion = $direccion;
                        $cliente->poblacion = $poblacion;
                        $cliente->c_postal = $c_postal;
                        $cliente->telefono = $telefono;
                        $cliente->email = $email;
                        $cliente->nif = $nif;

                        //Usamos create para meter el cliente en la base de datos
                        $this->model->create($cliente);
                    } else {
                        //Error de cliente existente
                        echo "Error, este cliente existente";
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
}

?>