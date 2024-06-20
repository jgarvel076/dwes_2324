<?php

class Ventas extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['main'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'index');
        } else {
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            $this->view->title = "Tabla de ventas";
            $this->view->ventas = $this->model->get();
            $this->view->render('ventas/main/index');
        }
    }

    function new()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['new'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $this->view->venta = new Venta();

            if (isset($_SESSION['error'])) {
                $this->view->error = $_SESSION['error'];
                $this->view->venta = unserialize($_SESSION['venta']);
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['error'], $_SESSION['venta'], $_SESSION['errores']);
            }

            $this->view->title = "Añadir - Gestión ventas";
            $this->view->render('ventas/new/index');
        }
    }

    public function create($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['new'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $cliente_id = filter_var($_POST["cliente_id"] ?? '', FILTER_SANITIZE_NUMBER_INT);
            $producto_id = filter_var($_POST["producto_id"] ?? '', FILTER_SANITIZE_NUMBER_INT);
            $cantidad = filter_var($_POST["cantidad"] ?? '', FILTER_SANITIZE_NUMBER_INT);
            $total = filter_var($_POST["total"] ?? '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $venta = new Venta(null, $cliente_id, $producto_id, $cantidad, $total);

            $errores = [];

            if (empty($cliente_id)) {
                $errores['cliente_id'] = "Campo obligatorio";
            }

            if (empty($producto_id)) {
                $errores['producto_id'] = "Campo obligatorio";
            }

            if (empty($cantidad) || $cantidad <= 0) {
                $errores['cantidad'] = "Debe ser un número positivo";
            }

            if (empty($total) || $total <= 0) {
                $errores['total'] = "Debe ser un número positivo";
            }

            if (!empty($errores)) {
                $_SESSION['venta'] = serialize($venta);
                $_SESSION['error'] = 'Formulario no validado';
                $_SESSION['errores'] = $errores;
                header('Location:' . URL . 'ventas/new');
            } else {
                $this->model->create($venta);
                $_SESSION['mensaje'] = 'Venta creada correctamente';
                header("Location:" . URL . "ventas");
            }
        }
    }

    function edit($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['edit'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $id = $param[0];
            $this->view->id = $id;
            $this->view->title = "Formulario editar venta";
            $this->view->venta = $this->model->getVenta($id);

            if (isset($_SESSION["error"])) {
                $this->view->error = $_SESSION["error"];
                $this->view->venta = unserialize($_SESSION['venta']);
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['error'], $_SESSION['venta'], $_SESSION['errores']);
            }

            $this->view->render('ventas/edit/index');
        }
    }

    function update($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['edit'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $cliente_id = filter_var($_POST["cliente_id"] ?? '', FILTER_SANITIZE_NUMBER_INT);
            $producto_id = filter_var($_POST["producto_id"] ?? '', FILTER_SANITIZE_NUMBER_INT);
            $cantidad = filter_var($_POST["cantidad"] ?? '', FILTER_SANITIZE_NUMBER_INT);
            $total = filter_var($_POST["total"] ?? '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $venta = new Venta(null, $cliente_id, $producto_id, $cantidad, $total);
            $id = $param[0];
            $ventaOriginal = $this->model->getVenta($id);

            $errores = [];

            if (strcmp($cliente_id, $ventaOriginal->cliente_id) !== 0 && empty($cliente_id)) {
                $errores['cliente_id'] = "Campo obligatorio";
            }

            if (strcmp($producto_id, $ventaOriginal->producto_id) !== 0 && empty($producto_id)) {
                $errores['producto_id'] = "Campo obligatorio";
            }

            if (strcmp($cantidad, $ventaOriginal->cantidad) !== 0 && (empty($cantidad) || $cantidad <= 0)) {
                $errores['cantidad'] = "Debe ser un número positivo";
            }

            if (strcmp($total, $ventaOriginal->total) !== 0 && (empty($total) || $total <= 0)) {
                $errores['total'] = "Debe ser un número positivo";
            }

            if (!empty($errores)) {
                $_SESSION['venta'] = serialize($venta);
                $_SESSION['error'] = 'Formulario no validado';
                $_SESSION['errores'] = $errores;
                header('location:' . URL . 'ventas/edit/' . $id);
            } else {
                $this->model->update($venta, $id);
                $_SESSION['mensaje'] = 'Venta actualizada correctamente';
                header("Location:" . URL . "ventas");
            }
        }
    }

    function show($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['show'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $id = $param[0];
            $this->view->title = "Formulario Venta Mostrar";
            $this->view->venta = $this->model->getVenta($id);
            $this->view->render('ventas/show/index');
        }
    }

    function order($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['order'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $criterio = $param[0];
            $this->view->title = "Tabla Ventas";
            $this->view->ventas = $this->model->order($criterio);
            $this->view->render('ventas/main/index');
        }
    }

    function filter($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['filter'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $campo = $param[0];
            $valor = $param[1];
            $this->view->title = "Tabla Ventas";
            $this->view->ventas = $this->model->filter($campo, $valor);
            $this->view->render('ventas/main/index');
        }
    }

    function delete($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header('location:' . URL . 'login');
        } else if (!in_array($_SESSION['id_rol'], $GLOBALS['ventas']['delete'])) {
            $_SESSION['mensaje'] = "No tienes privilegios para realizar dicha operación";
            header('location:' . URL . 'ventas');
        } else {
            $id = $param[0];
            $this->model->delete($id);
            $_SESSION['mensaje'] = 'Venta eliminada correctamente';
            header('location:' . URL . 'ventas');
        }
    }

}
?>
