<?php

    class Login Extends Controller {


        public function render() {

            # Iniciar sesion 
            session_start();

            # formulario
            $this->view->email = null;
            $this->view->password = null;

            # mensajes
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);

                if (isset($_SESSION['email'])) {
                    $this->view->email =$_SESSION['email'];
                    unset($_SESSION['email']);
                }

                if (isset($_SESSION['password'])) {
                    $this->view->password =$_SESSION['password'];
                    unset($_SESSION['password']);
                }

            }

            # errores
            if (isset($_SESSION['error'])) {

                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['password'];
                unset($_SESSION['email']);
                unset($_SESSION['password']);


                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);

            }

            $this->view->render('login/index');
        }

    
        # Validación login
    
        public function validate() {

            # Inicio sessión
            session_start();

            # formulario
            $email = filter_var($_POST['email']??='',FILTER_SANITIZE_EMAIL);
	        $password = filter_var($_POST['password']??='',FILTER_SANITIZE_SPECIAL_CHARS);

            # validaciones

            $errores = array();

            #obtengo el usuario a partir del email
	        $user = $this->model->getUserEmail($email);

            if ($user === false) {

                $errores['email'] = "Email no ha sido registrado";
                $_SESSION['errores'] = $errores;
                
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                
                $_SESSION['error'] = "Fallo en la Autentificación";

                header("location:". URL. "login"); 
                
            } else if (!password_verify($password,$user->password)) {

                $errores['password'] = "Password no es correcto";
                $_SESSION['errores'] = $errores;

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                $_SESSION['error'] = "Fallo en la Autentificación";

                header("location:". URL. "login"); 
                
            } else {
                
                # autentificacion
                $_SESSION['id'] = $user->id;
                $_SESSION['name_user'] = $user->name;
                $_SESSION['id_rol'] = $this->model->getUserIdPerfil($user->id);
                $_SESSION['name_rol'] = $this->model->getUserPerfil($_SESSION['id_rol']);

                $_SESSION['mensaje'] = "Usuario ". $user->name. " ha iniciado sesión" ;
                
                header("location:". URL. "clientes");
            }


        }
    }

?>