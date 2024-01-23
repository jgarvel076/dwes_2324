<?php

class Alumno extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        session_start();

        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        $this->view->title = "Home - Alumnos";

        $this->view->alumnos = $this->model->get();

        $this->view->render('alumno/main/index');
    }

    function new()
    {
        session_start();

        $this->view->alumno = new classAlumno();

        # Compruebo si existe algún error 
        if (isset($_SESSION['error'])) {

            $this->view->error = $_SESSION['error'];


            $this->view->alumno = unserialize($_SESSION['alumno']);


            $this->view->errores = $_SESSION['errores'];

            # Borramos datos de la variables a posterior de su uso
            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['alumnos']);
        }



        $this->view->title = "Añadir - Alumnos";

        $this->view->cursos = $this->model->getCursos();

        $this->view->render('alumno/new/index');
    }

    function create($param = [])
    {

        # Iniciamos sesión
        session_start();

        # Saneamos datos 
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        # Cargamos los datos
        $alumno = new classAlumno(
            null,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            null,
            $poblacion,
            null,
            null,
            $dni,
            $fechaNac,
            $id_curso
        );

        # --------------------------------------------------------------------
        # Validación
        $errores = [];

        # Nombre valor obligatorio
        if (empty($nombre)) {
            $errores['nombre'] = 'El campo es obligatorio';
        }

        # Apellidos valor obligatorio
        if (empty($apellidos)) {
            $errores['apellidos'] = 'El campo es obligatorio';
        }

        # Validación Email
        if (empty($email)) {
            $errores['email'] = 'El campo es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El formato no válido';
        } else if (!$this->model->validarEmailUnico($email)) {
            $errores['email'] = 'El email ya ha sido registrado';
        }

        $options = [
            'options' => [ # ESTOS PARÁMETROS DEBEN LLAMARSE ASÍ
                'regexp' => '/^(\d{8})([a-zA-Z])$/'
            ]
        ];

        #Validación dni
        if (empty($dni)) {
            $errores['dni'] = 'El campo es obligatorio';
        } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
            $errores['dni'] = 'El formato del dni no es válido';
        } else if (!$this->model->validarDniUnico($dni)) {
            $errores['dni'] = 'El dni ya ha sido registrado';
        }

        # Validación id_curso
        if (empty($id_curso)) {
            $errores['id_curso'] = 'Debe seleccionar un curso';
        } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
            $errores['id_curso'] = 'Curso no válido';
        } else if (!$this->model->validarCurso($id_curso)) {
            $errores['id_curso'] = 'Curso no existe';
        }

        # Comprobamos validacion
        if (!empty($errores)) {
            $_SESSION['alumno'] = serialize($alumno); # serializamos para tornar el objeto a string
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            header('location:' . URL . 'alumno/new');
        } else {
            $this->model->create($alumno);

            $_SESSION['mensaje'] = "Alumno creado correctamente";

            header('location:' . URL . 'alumno');
        }
        #------------------------------------------------------------------------

    }

    function edit($param = [])
    {
        $id = $param[0];

        $this->view->id = $id;


        $this->view->title = "Editar - Alumnos";


        $this->view->alumno = $this->model->read($id);


        $this->view->cursos = $this->model->getCursos();


        $this->view->render('alumno/edit/index');
    }

    public function update($param = [])
    {
        $id = $param[0];

        $alumno = new classAlumno(

            null,
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['email'],
            $_POST['telefono'],
            null,
            $_POST['poblacion'],
            null,
            null,
            $_POST['dni'],
            $_POST['fechaNac'],
            $_POST['id_curso']

        );

        # Actualizamos base de datos 
        $this->model->update($alumno, $id);

        header('location:' . URL . 'alumno');
    }

    public function order($param = [])
    {
        # Criterio de ordenación
        $criterio = $param[0];

        $this->view->title = "Ordenar - Alumnos";

        $this->view->alumnos = $this->model->order($criterio);

        $this->view->render('alumno/main/index');
    }

    public function filter($param = [])
    {

        # Expresión para buscar
        $expresion = $_GET['expresion'];

        $this->view->title = "Buscar - Alumnos";

        $this->view->alumnos = $this->model->filter($expresion);

        $this->view->render('alumno/main/index');
    }
}

?>