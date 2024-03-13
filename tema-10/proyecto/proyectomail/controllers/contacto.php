<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'auth.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Contacto extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    function render()
    {

        # Iniciamos sesión
        session_start();

        # Comprobamos errores
        if (isset($_SESSION['error']))
        {
            // Añadimos a la vista el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Recuperamos los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']); 
            unset($_SESSION['contacto']);
            unset($_SESSION['errores']);

        # Comprobar si existe el mensaje
        if (isset($_SESSION['mensaje']))
        {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        $this->view->title = "Página de contacto";

        // Renderizar la vista de la página de contacto
        $this->view->render('contacto/index');
    }

    function validar()
    {
        # Iniciamos sesión
        session_start();

        # Comprobamos errores
        if (isset($_SESSION['error']))
        {
            // Añadimos a la vista el mensaje de error
            $this->view->error = $_SESSION['error'];

            // Recuperamos los errores
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['contacto']);
            unset($_SESSION['errores']);
            
            //Autorrellenar el formulario con los detalles del contacto
            $this->view->contacto = unserialize($_SESSION['contacto']);
        }

        # datos del formulario
        $nombre = filter_var($_POST['nombre'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $asunto = filter_var($_POST['asunto'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $textoMensaje = filter_var($_POST['textoMensaje'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

        //Creamos un contacto
        $contacto = new classContacto($nombre, $email, $asunto, $textoMensaje);

        # validación
        // Creamos el array de errores
        $errores = [];

        if (empty($nombre))
        {
            $errores['nombre'] = 'Nombre es obligatorio';
        }

        if (empty($email))
        {
            $errores['email'] = 'Email es obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errores['email'] = 'Email incorrecto';
        }

        if (empty($asunto))
        {
            $errores['asunto'] = 'Asunto es obligatorio';
        }

        if (empty($textoMensaje))
        {
            $errores['mensaje'] = 'Mensaje es obligatorio';
        }

        # comprobar validación
        if (!empty($errores))
        {
            // Errores de validación
            $_SESSION['contacto'] = serialize($contacto);
            $_SESSION['error'] = "Formulario no validado";
            $_SESSION['errores'] = $errores;
            header('Location:' . URL . 'contacto');
            exit();
        } else
        {
            try
            {
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
                $mensajeMail = $mensaje;
                $destinatario = $email;

                $mail->setFrom($remitente, $nombre);
                $mail->addAddress($destinatario);
                $mail->addReplyTo($remitente, $nombre);

                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;

                // Enviar email
                $mail->send();

                // Redirigir a la página de éxito
                $_SESSION['mensaje'] = 'Mensaje enviado correctamente.';

                // Redirigir a la página de contacto
                header('Location:' . URL . 'contacto');
                exit();
            } catch (Exception $e)
            {
                // Manejar excepciones
                $_SESSION['error'] = "Error al enviar el email: {$mail->ErrorInfo}";
                header('Location:' . URL . 'contacto');
                exit();
            }
        }
    }
}
}
