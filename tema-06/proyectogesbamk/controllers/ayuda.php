<?php

    class Ayuda extends Controller {

        function constructor() {

            parent ::constructor();
            
        }

        function render() {

            $this->view->render('ayuda/index');
        }
    }

?>