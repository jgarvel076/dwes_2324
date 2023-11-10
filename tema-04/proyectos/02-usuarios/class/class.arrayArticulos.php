<?php

    /* 
        class.arrayArticulos.php
        
        tabla de Artículos

        Es un array donde cada elemento es un objeto de la clase Articulo
    */

    class ArrayArticulos {
        private $tabla;

        public function __construct($tabla) {
        
            $this->tabla = [];
        
        }


        /**
         * Get the value of tabla
         */ 
        public function getTabla()
        {
                return $this->tabla;
        }

        /**
         * Set the value of tabla
         *
         * @return  self
         */ 
        public function setTabla($tabla)
        {
                $this->tabla = $tabla;

                return $this;
        }

        static public function getCategorias(){
            $categorias = [
                'Portátil',
                'PC sobremesa',
                'Componente',
                'Pantalla',
                'Impresora'
            ];
        
            asort($categorias);
            return $categorias;
            
        }

        static public function getMarcas(){
            $marcas = [
                'Dell',
                'Lenovo',
                'Asus',
                'Acer',
                'Toshiba',
                'Hp',
                'Apple',
                'MSI',
                'Fujitsu',
                'LG'
            ];
        
            asort($marcas);
            return $marcas;
            
        }

        public function getDatos(){

            #Articulo 1
            $articulo = new Articulo(
            1,
            'Portátil - HP 15-DB0074NS',
            'HP 15-DB0074NS',
            0,
            [2, 3, 4],
            120,
            379
            );

            #Añadir articulo a la tabla
            $tabla[] = $articulo;

            #Articulo 2
            $articulo = new Articulo(
            2,
            'Portátil - AMD A4-9125, 8GB RAM, 125GB',
            'HP 255 G7, 15.6',
            3,
            [1, 3, 2],
            200,
            20.5
            );
    
            #Añadir articulo a la tabla
            $tabla[] = $articulo;

            #Articulo 3
            $articulo = new Articulo(
            3,
            'PC Sobremesa - Lenovo Intel Core i3-8100',
            'IdeaCentre 510S-07ICB',
            5,
            [1, 3],
            50,
            12.95
            );
        
            #Añadir articulo a la tabla
            $tabla[] = $articulo;

            #Articulo 4
            $articulo = new Articulo(
            4,
            'PC Sobremesa - HP 290 APU AMD Dual-Core A6',
            'HP 290-a0002ns',
            4,
            [2, 4],
            120,
            15.95
            );
            
            #Añadir articulo a la tabla
            $tabla[] = $articulo;
        }
        
        static public function mostrarCategorias($categorias, $categoriasArticulo) {
            //Podemos declarar este metodo estático porque no modifica ningun atributo de la clase
            $arrayCategorias = [];
        
            foreach($categoriasArticulo as $indice) {
        
                $arrayCategorias[] = $categorias[$indice];
        
            }
        
            asort($arrayCategorias);
            return $arrayCategorias;
        
        }
    }
    
    
?>