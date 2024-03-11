<?php


class users extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    # Método render
    function render($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['main']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        } else {

            # Si existe un mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            $this->view->model = $this->model;
            $this->view->title = "Tabla Usuarios";
            $this->view->users = $this->model->get();
            $this->view->render("users/main/index");
        }
    }

    function nuevo()
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['new']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        # Obtenemos los roles
        $roles = $this->model->getRol();
        $this->view->roles = $roles;

            # Comprobamos si existen errores
        if (isset($_SESSION['error'])) {
            //Añadimos a la vista el mensaje de error
            $this->view->error = $_SESSION['error'];

            //Autorellenamos el formulario
            $this->view->user = unserialize($_SESSION['user']);

            // Recuperamos el array con los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['user']);
        }
        
        $this->view->title = "Añadir - Gestión Usuarios";
        $this->view->render('users/new/index');
    }

    function create($param = [])
    {
        # Iniciamos sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['new']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        # datos del formulario
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        # Cargamos los datos del formulario
        $user = new classuser(
            null,
            $nombre,
            $email,
            $password,
            $rol
        );

        # validación
        $errores = [];

        if (empty($nombre)) {
            $errores['nombre'] = 'Nombre obligatorio';
        } elseif (strlen($nombre) > 20) {
            $errores['nombre'] = 'El nombre no puede tener más de 20 caracteres';
        }

        if (empty($email)) {
            $errores['email'] = 'Email obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email no valido';
        } elseif ($this->model->existeEmail($email, $user->id)) {
            $errores['email'] = 'Email ya registrado';
        }


        if (empty($password)) {
            $errores['password'] = 'Contraseña obligatoria';
        } elseif (!filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $errores['password'] = 'Contraseña no valida';
        }

        // Rol
        if (empty($rol)) {
            $errores['rol'] = 'Rol obligatorio';
        }

        # comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos de nuevo al formulario
            header('Location:' . URL . 'users/new');
            exit();
        } else {

            // Añadir registro a la tabla
            $this->model->create($user);

            // Añadimos a la variable de sesión un mensaje
            $_SESSION['mensaje'] = 'Usuario creado correctamente';
                
            // Redireccionamos a la vista principal de users
            header('location:' . URL . 'users');
        }
    }


    function edit($param = [])
    {
        # Iniciamos sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['edit']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Edit - Panel de control users";

        # obtener objeto de la clase user
        $this->view->user = $this->model->read($id);

        // Obtener los roles
        $this->view->roles = $this->model->getRol();

        // Obtener el rol actual del usuario
        $userRol = $this->model->userRol($id);
        $this->view->rolActual = $userRol->id;

        //Comprobar si el formulario viene de una validación
        //Comprobar si el formulario viene de una validación
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            // Recuperamos el array con los errores
            $this->view->errores = $_SESSION['errores'];

            // Deserializar el objeto classuser solo si no hay errores
            if (!isset($this->view->errores)) {
                # Autorrellenar el formulario con los detalles del user
                $this->view->user = unserialize($_SESSION['user']);
            }

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['user']);
        }


        # cargo la vista
        $this->view->render('users/edit/index');

    }


    function update($param = [])
    {
        # Iniciamos sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['edit']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        # Cargo id
        $id = $param[0];

        $userOG = $this->model->getUser($id);

        # datos del formulario
        $nombre = filter_var($_POST['name'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = filter_Var($_POST['password'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $rol = filter_var($_POST['rol'] ?? '', FILTER_SANITIZE_NUMBER_INT);

        # validación
        $errores = [];

        if (empty($nombre)) {
            $errores['nombre'] = 'Nombre obligatorio';
        } elseif (strlen($nombre) > 20) {
            $errores['nombre'] = 'El nombre no puede tener más de 20 caracteres';
        }

        // Email
        if (empty($email)) {
            $errores['email'] = 'Email obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email no valido';
        } elseif ($this->model->validateEmailUnique($email, $id)) {
            $errores['email'] = 'Email ya registrado';
        }

        // Password
        if (!empty($password) || !empty($password_confirm)) {
            if (empty($password)) {
                $errores['password'] = 'Contraseña obligatoria';
            }
        }

        // Rol
        if (empty($rol)) {
            $errores['rol'] = 'Rol obligatorio';
        }

        # comprobamos la validación
        if (!empty($errores)) {
            // Errores de validación
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos
            header('location:' . URL . 'users/edit/' . $id);
            exit();
        }

        // hashear la contraseña
        if (!empty($password)) {
            $passHash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $passHash = $userOG->password;
        }

        $user = new classuser(
            null,
            $nombre,
            $email,
            $passHash,
            $rol
        );

        $this->model->update($id, $user, $rol);

        $_SESSION['mensaje'] = 'Usuario actualizado';

        header("Location:" . URL . "users");

    }

    function mostrar($param = [])
    {

        session_start();

        $id = $param[0];

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['show']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        $this->view->title = "Formulario Mostrar Usuario";
        $this->view->usuario = $this->model->getUser($id);
        $this->view->rol = $this->model->getRol($id);

        $this->view->render('users/show/index');

    }


    function ordenar($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['order']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        $criterio = $param[0];
        $this->view->title = "Ordenar - Panel de Control users";
        $this->view->users = $this->model->order($criterio);

        $this->view->render('users/main/index');

    }

    function buscar($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['filter']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');
        }

        $expresion = $_GET['expresion'];
        $this->view->title = "Buscar - Gestión users";
        $this->view->users = $this->model->filter($expresion);

        $this->view->render('users/main/index');
    }

    function delete($param = [])
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos si el usuario está autentificado
        if (!isset($_SESSION['id'])) {

            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['users']['delete']))) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'users');

        } else {

            #id del user
            $iduser = $param[0];

            $this->model->delete($iduser);
            $_SESSION['notify'] = 'Usuario eliminado.';

            header("Location:" . URL . "users");
        }
    }


}

?>