<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();

    }

    public function render()
    {

        # inicio o continuo sesión
        session_start();

        # compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario sin autentificar";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['main']))) {
            $_SESSION['mensaje'] = "Ha intentado realizar operación sin privilegios";
            header('location:' . URL . 'index');
        } else {

            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }


            # Creo la propiedad title de la vista
            $this->view->title = "Home - Panel Control Albumes";

            # Creo la propiedad alumnos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->albumes = $this->model->get();

            $this->view->render('album/main/index');
        }

    }

    public function new()
    {

        # iniciar o continuar  sesión
        session_start();

        # compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Crear un objeto alumno vacio
            $this->view->albumes = new classAlbum();

            # Comprobar si vuelvo de  un registro no validado
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorrellenar formulario con los detalles del  alumno
                $this->view->albumes = unserialize($_SESSION['album']);

                # Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            # etiqueta title de la vista
            $this->view->title = "Añadir - Gestión Alumnos";

            

            # cargo la vista con el formulario nuevo alumno
            $this->view->render('album/new/index');
        }
    }

    public function create($param = [])
    {

        # Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # 1. Seguridad. Saneamos los  datos del formulario
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_EMAIL);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            # 2. Creamos alumno con los datos saneados
            $album = new classAlbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                $carpeta
            );

            # 3. Validación
            $errores = [];

            // Nombre: obligatorio
            if (empty($titulo)) {
                $errores['titulo'] = 'El campo titulo es  obligatorio';
            } else if (strlen($titulo) > 100){
                $errores['titulo'] = "El campo título debe ser inferior a 100 caractéres";
            }

            // Descripcion: obligatorio
            if (empty($descripcion)) {
                $errores['descripcion'] = 'El campo Descripcion es obligatorio';
            }

            // Autor: obligatorio
            if (empty($autor)) {
                $errores['autor'] = 'El campo autor es  obligatorio';
            }

            // fecha: obligatorio
            if (empty($fecha)) {
                $errores['fecha'] = 'El campo fecha es  obligatorio';
            }

            // lugar: obligatorio
            if (empty($lugar)) {
                $errores['lugar'] = 'El campo lugar es  obligatorio';
            }

            // categorias: obligatorio
            if (empty($categoria)) {
                $errores['categoria'] = 'El campo categoria es  obligatorio';
            }

            // carpeta: obligatorio
            if(empty($carpeta)){
                $errores['carpeta'] = 'El campo Carpeta es obligatorio';
            } else if(strpos($carpeta,' ')!== false){
                $errores['carpeta'] = 'El nombre de carpeta no debe tener espacios';
            }

            # 4. Comprobar  validación

            if (!empty($errores)) {
                # errores de validación
                // variables sesión no admiten objetos
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # redireccionamos a new
                header('location:' . URL . 'album/new');


            } else {

                # Añadir registro a la tabla
                $this->model->create($album);

                mkdir("images/".$carpeta);

                # Mensaje
                $_SESSION['mensaje'] = "Album creado correctamente";

                # Redirigimos al main de alumnos
                header('location:' . URL . 'album');

            }

        }
    }

    public function edit($param = [])
    {

        # iniciamos sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # obtengo el id del alumno que voy a editar
            // alumno/edit/4

            $id = $param[0];

            # asigno id a una propiedad de la vista
            $this->view->id = $id;

            # title
            $this->view->title = "Editar - Panel de control Albumes";

            # obtener objeto de la clase alumno
            $this->view->albumes = $this->model->read($id);

            # Comprobar si el formulario viene de una no validación
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorrellenar formulario con los detalles del  alumno
                $this->view->albumes = unserialize($_SESSION['album']);

                # Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            # cargo la vista
            $this->view->render('album/edit/index');

        }
    }

    public function update($param = [])
    {

        # iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # 1. Saneamos datos del formulario FILTER_SANITIZE
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_EMAIL);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            # 2. Creamos el objeto alumno a partir de  los datos saneados del  formuario
            
            $album = new classAlbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                $num_fotos,
                $num_visitas,
                $carpeta
            );

            # Cargo id del alumno que voya a actualizar
            $id = $param[0];

            # Obtengo el  objeto alumno original
            $album_orig = $this->model->read($id);

            # 3. Validación (mismo que arriba)


            $errores = [];

            //Validar nombre
            if (strcmp($titulo, $album_orig->titulo) !== 0) {
                if (empty($titulo)) {
                    $errores['titulo'] = 'El campo titulo es  obligatorio';
                }else if (strlen($titulo) > 100){
                    $errores['titulo'] = "El campo título debe ser inferior a 100 caractéres";
                }
            }

            // Descripcion: obligatorio
            if (strcmp($descripcion, $album_orig->descripcion) !== 0) {
            if (empty($descripcion)) {
                $errores['descripcion'] = 'El campo descripcion es  obligatorio';
            }}

            // Autor: obligatorio
            if (strcmp($autor, $album_orig->autor) !== 0) {
            if (empty($autor)) {
                $errores['autor'] = 'El campo autor es  obligatorio';
            }}

            // fecha: obligatorio
            if (strcmp($fecha, $album_orig->fecha) !== 0) {
            if (empty($fecha)) {
                $errores['fecha'] = 'El campo fecha es  obligatorio';
            }}

            // lugar: obligatorio
            if (strcmp($lugar, $album_orig->lugar) !== 0) {
            if (empty($lugar)) {
                $errores['lugar'] = 'El campo lugar es  obligatorio';
            }}

            // categorias: obligatorio
            if (strcmp($categoria, $album_orig->categoria) !== 0) {
            if (empty($categoria)) {
                $errores['categoria'] = 'El campo categoria es  obligatorio';
            }}

            // carpeta: obligatorio
            if(empty($carpeta)){
                $errores['carpeta'] = 'El campo Carpeta es obligatorio';
            } else if(strpos($carpeta,' ')!== false){
                $errores['carpeta'] = 'El nombre de carpeta no debe tener espacios';
            }

            # 4. Comprobar  validación

            if (!empty($errores)) {
                # errores de validación
                // variables sesión no admiten objetos
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

            # redireccionamos a edit con el id del álbum
            header('location:' . URL . 'album/edit/' . $id);
            
            } else {
                # renombrar la carpeta en el sistema de archivos
                $rutaCarpetaOriginal = 'images/' . $album_orig->carpeta;
                $rutaCarpetaNueva = 'images/' . $carpeta;
                if (rename($rutaCarpetaOriginal, $rutaCarpetaNueva)) {
                    # actualizamos el álbum en la base de datos con el nuevo nombre de la carpeta
                    $carpetaOrig = $album_orig->carpeta;

                    # Actualizo registro
                    $this->model->update($album, $id, $carpetaOrig);

                    # mensaje de éxito
                    $_SESSION['mensaje'] = "Álbum actualizado correctamente";

                    # redirigimos al main de álbumes
                    header('location:' . URL . 'album');
                } else {
                    # Error al renombrar la carpeta
                    $errores['carpeta'] = "El nombre de la carpeta ya existe";
                    $_SESSION['error'] = "Formulario no ha sido validado";
                    $_SESSION['errores'] = $errores;
                    $_SESSION['album'] = serialize($album);
                    header('location:' . URL . 'album/edit/' . $id);
                }

            }
        }
    }

    public function order($param = [])
    {

        # inicio o continúo sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Obtengo criterio de ordenación
            $criterio = $param[0];

            # Creo la propiedad title de la vista
            $this->view->title = "Ordenar - Panel Control Albumes";

            # Creo la propiedad alumnos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->albumes = $this->model->order($criterio);

            # Cargo la vista principal de alumno
            $this->view->render('album/main/index');
        }
    }

    public function filter($param = [])
    {

        # inicio o continúo sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Obtengo expresión de búsqueda
            $expresion = $_GET['expresion'];

            # Creo la propiedad title de la vista
            $this->view->title = "Buscar - Panel Control Album";

            # Filtro a partir de la  expresión
            $this->view->albumes = $this->model->filter($expresion);

            # Cargo la vista principal de alumno
            $this->view->render('album/main/index');
        }
    }

    public function delete($param = [])
    {

        # inicar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # obtenemos id del  alumno
            $id = $param[0];

            # Añadimos el valor del objeto album según id
            $carpeta = $this->model->read($id);

            # eliminar alumno
            $this->model->delete($id,$carpeta->carpeta); //fallo?

            # generar mensaje
            $_SESSION['mensaje'] = 'Album eliminado correctamente';

            # redirecciono al main de alumnos
            header('location:' . URL . 'album');
        }
    }

    public function show($param = [])
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['show']))) {
            $_SESSION['mensaje'] = "Operación sin privilegio";
            header("location:" . URL . "album");
        } else {
            $id = $param[0];
            $album = $this->model->read($id);
            $this->view->title = "ALBUM";
            $this->view->albumes = $album;

            $this->view->render("album/show/index");
        }
    }

    public function add($param = []){

        # iniciar o continuar  sesión
        session_start();

        # compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['add']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Comprobar si vuelvo de  un registro no validado
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
            }

            # etiqueta title de la vista
            $this->view->title = "Subir Archivos - Gestión Album";


            # cargo la vista con el formulario nuevo alumno
            $this->view->render('album/add/index');

            #contador fotos
            $album = $this->model->getAlbum($param[0]);

            $this->model->subirArchivo($_FILES['archivos'], $album->carpeta);

            $numFotos = count(glob("images/" . $album->carpeta . "/*"));

            $this->model->contadorFotos($album->id, $numFotos);

            header("location:" . URL . "album");
        }


    }

}