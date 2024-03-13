<?php

class Perfil  extends Controller {
     # Muestra los detalles del perfil antes de eliminar
     public function render() {

        # Iniciamos o continuamos con la sesión
        session_start();

        # Capa autentificación
        if (!isset($_SESSION['id'])) {
            header("location:".URL. "login");
        }

        # Capa mensaje
        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }


        # Obtenemos objeto con los detalles del usuario
        $this->view->user = $this->model->getUserId($_SESSION['id']);
        $this->view->title = 'Perfil de Usuario - Gestión Gesbank - MVC';

        $this->view->render('perfil/main/index');
       
    }

     # Editar los detalles
     public function edit() {

        # Iniciamos sesión
        session_start();

        # Capa de autentificación
        if (!isset($_SESSION['id'])) { 

            header('location:'.URL. 'login');

        }

        # Comprobamos si existe mensaje
        if (isset($_SESSION['mensaje'])) {

            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);

        }

        # Obtenemos objeto User
        $this->view->user = $this->model->getUserId($_SESSION['id']);

        # Capa no validación formulario
        if (isset($_SESSION['error'])) {

            # Mensaje de error
            $this->view->error = $_SESSION['error'];
            unset($_SESSION['error']);

            # Variables de autorrelleno
            $this->view->user = unserialize($_SESSION['user']);
            unset($_SESSION['user']);

            # Tipo de error
            $this->view->errores = $_SESSION['errores'];
            unset($_SESSION['errores']);

        }

        $this->view->title = 'Modificar Perfil Usuario - Gestión Gesbank';
        $this->view->render('perfil/edit/index');

    }

    # Valida el formulario de modificación de perfil
    public function valperfil() {

        # Iniciamos sesión
        session_start();

        # Capa autentificación
        if (!isset($_SESSION['id'])) {

            header("location:".URL. "login");
        }

        # Saneamos el formulario
        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null,FILTER_SANITIZE_EMAIL);

        # Obtenemos objeto con los detalles del usuario
        $user = $this->model->getUserId($_SESSION['id']);

        # Validaciones
        $errores = [];

        if (strcmp($user->name, $name) !== 0) {
            if (empty($name)) { 
                $errores['name'] = "Nombre de usuario es obligatorio";
            } else if ((strlen($name) < 5) || (strlen($name) > 50)) {
                $errores['name'] = "Nombre de usuario ha de tener entre 5 y 50 caracteres";
            } else if (!$this->model->validateName($name)) {
                $errores['name'] = "Nombre de usuario ya ha sido registrado";
            }
        }

      // email
      if (strcmp($user->email, $email) !== 0) {
        if (empty($email)) {
            $errores['email'] = "Email es obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Email incorrecto";
        } elseif (!$this->model->validateEmail($email)) {
            $errores['email'] = "Email ya registrado";
        }
    }

        $user = new User(
            $user->id,
            $name,
            $email,
            null
        );


        if (!empty($errores)) {
            $_SESSION['errores'] = $errores;
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = "Formulario con errores de validación";

            header('location:'.URL.'perfil/edit');

        } else {

           # Actualizamos perfil
           $this->model->update($user);

           try {
               // Configurar PHPMailer
               $mail = new PHPMailer(true);
               $mail->CharSet = "UTF-8";
               $mail->Encoding = "quoted-printable";

               $mail->Username = USUARIO; 
               $mail->Password = PASS; 

               $mail->SMTPDebug = 2;
               $mail->isSMTP();
               $mail->Host = 'smtp.gmail.com';
               $mail->SMTPAuth = true;
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
               $mail->Port = 587; 

                // Configurar contenido email
                $remitente = USUARIO;
                $asuntoMail = $asunto;
                $asuntoMail = "Modificacion de su perfil";
                $mensajeMail =
                   "Su perfil ha cambiado recientemente a estos nuevos datos: <br><br>"
                   . "Nuevo Nombre: " . $name . "<br>"
                   . "Nuevo Email: " . $email . "<br>";

                $mail->setFrom($remitente, $nombre);
                $mail->addAddress($destinatario);
                $mail->addReplyTo($remitente, $nombre);

                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;

                // Enviar email
                $mail->send();
            }    catch (Exception $e) {
                // Manejar excepciones
                $_SESSION['error'] = 'Error al enviar el mensaje: ' . $e->getMessage();
            }

           $_SESSION['name_user'] = $name;
           $_SESSION['mensaje'] = 'Usuario modificado correctamente';

           header('location:' . URL . 'perfil');
        }

    }

    # Modificación del password
    public function pass() {

        # Iniciamos sesión
        session_start();

        # Capa de autentificación
        if (!isset($_SESSION['id'])) { 

            header('location:'.URL. 'login');

        }

        # Comprobamos si existe mensaje
        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        # Capa no validación formulario
        if (isset($_SESSION['error'])) {

            # Mensaje de error
            $this->view->error = $_SESSION['error'];
            unset($_SESSION['error']);

            # Tipo de error
            $this->view->errores = $_SESSION['errores'];
            unset($_SESSION['errores']);

        }

        # título página
        $this->view->title = "Modificar password";
        $this->view->render('perfil/pass/index');


    }

    # Validación cambio password
        # Valida el formulario de modificación de perfil
        public function valperfil() {

            # Iniciamos sesión
            session_start();
    
            # Capa autentificación
            if (!isset($_SESSION['id'])) {
    
                header("location:".URL. "login");
            }
    
            # Saneamos el formulario
            $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= null,FILTER_SANITIZE_EMAIL);
    
            # Obtenemos objeto con los detalles del usuario
            $user = $this->model->getUserId($_SESSION['id']);
    
            # Validaciones
            $errores = [];
    
            if (strcmp($user->name, $name) !== 0) {
                if (empty($name)) { 
                    $errores['name'] = "Nombre de usuario es obligatorio";
                } else if ((strlen($name) < 5) || (strlen($name) > 50)) {
                    $errores['name'] = "Nombre de usuario ha de tener entre 5 y 50 caracteres";
                } else if (!$this->model->validateName($name)) {
                    $errores['name'] = "Nombre de usuario ya ha sido registrado";
                }
            }
    
          // email
          if (strcmp($user->email, $email) !== 0) {
            if (empty($email)) {
                $errores['email'] = "Email es obligatorio";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "Email incorrecto";
            } elseif (!$this->model->validateEmail($email)) {
                $errores['email'] = "Email ya registrado";
            }
        }
    
            $user = new User(
                $user->id,
                $name,
                $email,
                null
            );
    
    
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $_SESSION['user'] = serialize($user);
                $_SESSION['error'] = "Formulario con errores de validación";
    
                header('location:'.URL.'perfil/edit');
    
            } else {
    
               # Actualizamos perfil
               $this->model->update($user);
    
               try {
                   // Configurar PHPMailer
                   $mail = new PHPMailer(true);
                   $mail->CharSet = "UTF-8";
                   $mail->Encoding = "quoted-printable";
    
                   $mail->Username = USUARIO; 
                   $mail->Password = PASS; 
    
                   $mail->SMTPDebug = 2;
                   $mail->isSMTP();
                   $mail->Host = 'smtp.gmail.com';
                   $mail->SMTPAuth = true;
                   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                   $mail->Port = 587; 
    
                    // Configurar contenido email
                    $remitente = USUARIO;
                    $asuntoMail = $asunto;
                    $asuntoMail = "Modificacion de su perfil";
                    $mensajeMail =
                       "Su perfil ha cambiado recientemente a estos nuevos datos: <br><br>"
                       . "Nuevo Nombre: " . $name . "<br>"
                       . "Nuevo Email: " . $email . "<br>";
    
                    $mail->setFrom($remitente, $nombre);
                    $mail->addAddress($destinatario);
                    $mail->addReplyTo($remitente, $nombre);
    
                    $mail->isHTML(true);
                    $mail->Subject = $asunto;
                    $mail->Body = $mensaje;
    
                    // Enviar email
                    $mail->send();
                }    catch (Exception $e) {
                    // Manejar excepciones
                    $_SESSION['error'] = 'Error al enviar el mensaje: ' . $e->getMessage();
                }
    
               $_SESSION['name_user'] = $name;
               $_SESSION['mensaje'] = 'Usuario modificado correctamente';
    
               header('location:' . URL . 'perfil');
            }
    
        }
    public function delete() {

        # Iniciamos sesión
        session_start();

        # Capa autentificación
        if (!isset($_SESSION['id'])) {

            header("location:".URL. "login");

        } else {

            try {
               
                // Configurar PHPMailer
                $mail = new PHPMailer(true);
                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";
 
                $mail->Username = USUARIO; 
                $mail->Password = PASS; 
 
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587; 
 
                 // Configurar contenido email
                 $remitente = USUARIO;
                 $asuntoMail = $asunto;
                 $asuntoMail = "Borrado de su perfil";
                 $mensajeMail ="Su perfil ha sido eliminado. <br><br>";
 
                 $mail->setFrom($remitente, $nombre);
                 $mail->addAddress($destinatario);
                 $mail->addReplyTo($remitente, $nombre);
 
                 $mail->isHTML(true);
                 $mail->Subject = $asunto;
                 $mail->Body = $mensaje;
 
                 // Enviar email
                 $mail->send();
             }    catch (Exception $e) {
                 // Manejar excepciones
                 $_SESSION['error'] = 'Error al enviar el mensaje: ' . $e->getMessage();
             }

            # Elimino perfil de usuario
            $this->model->delete($_SESSION['id']);

            # Destruyo la sesión
            session_destroy();

            # Salgo de la aplicación
            header('location:' . URL . 'index');
        }
       
    }

}