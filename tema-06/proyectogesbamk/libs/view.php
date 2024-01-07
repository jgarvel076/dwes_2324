<?php

    class View {

        function constructor() {
   

        }

        function render($nombre) {

            require 'views/' . $nombre . '.php';
        }

    }

?>