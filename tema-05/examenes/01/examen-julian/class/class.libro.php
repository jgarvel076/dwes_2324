<?php

    /*
        clase Libro

        Incluirá un atributo por cada columna de la tabla libro
        No cumple la propiedad de encapsulamiento pero si es preciso definir el constructor

    */

    class libro{
        public $id;
        public $isbn;
        public $ean;
        public $titulo;
        public $autor_id;
        public $editorial_id;
        public $precio_coste;
        public $precio_venta;
        public $stock;
        public $stock_min;
        public $stock_max;
        public $fecha_edicion;
    }


?>
