<?php

    class Errores extends Controller {

        function constructor() {

            parent ::constructor();
            $this->view->mensaje = "Error al cargar el recurso";
            $this->view->render('error/index');
        }

      

    }

?>