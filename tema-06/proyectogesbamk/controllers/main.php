<?php

    class Main Extends Controller {

        function constructor() {

            parent ::constructor();
            
            
        }

        function render() {

            $this->view->render('main/index');
        }
    }

?>