<?php

/**
 * 
 * class.arrayArticulo.php
 * tabla Artículos
 * Es un array donde cada elemento es un objeto de la clase Artículo
 * 
 */

class ArrayArticulo
{
    private $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }
    //Metodo para agregar articulos a la lista

    public function getTabla()
    {
        return $this->tabla;
    }

    public function setTabla($tabla)
    {
        $this->tabla = $tabla;

        return $this;
    }

    static public function getCategorias()
    {
        $categorias = ['Portatiles', 'PCs sobremesa', 'Componentes', 'Pantallas', 'Impresora'];

        asort($categorias);

        return $categorias;
    }

    static public function getMarcas()
    {
        $marcas = [
            'Xiaomi',
            'Apple',
            'Samsung',
            'HP',
            'Lenovo',
            'Asus',
            'Acer',
            'Dell',
            'Toshiba',
            'Fujitsu'
        ];

        asort($marcas);

        return $marcas;
    }

    public function getDatos (){
        
        #Articulo 1
        $articulo = new Articulo(
            1,
            'Portatil Acer',
            'Aspire 3',
            0,
            [1,2],
            100,
            430.05
        );

        # Añadir artículo a la tabla
        $this -> tabla[] = $articulo;

        #Articulo 2
        $articulo = new Articulo(
            2,
            'Pantalla @lhua',
            'Version 102',
            3,
            [4,0],
            10.5,
            600.03
        );

        # Añadir artículo a la tabla
        $this -> tabla[] = $articulo;

        #Articulo 3
        $articulo = new Articulo(
            3,
            'Pc Sobremesa - Lenovo Intel core',
            'ideacentre 5105-07',
            1,
            [1,2,3],
            1.75,
            200.30
        );

        # Añadir artículo a la tabla
        $this -> tabla[] = $articulo;

        #Articulo 4
        $articulo = new Articulo(
            4,
            'Portatil LG',
            '340 - Intel I5',
            0,
            [2,3],
            3.0,
            15.7
        );

        # Añadir artículo a la tabla
        $this -> tabla[] = $articulo;

        #Articulo 5
        $articulo = new Articulo(
            5,
            'Placa base ',
            'ASUS ROG STRIX Z790-F',
            2,
            [2,0],
            100.50,
            14.5
        );

        # Añadir artículo a la tabla
        $this -> tabla[] = $articulo;

    }

    static public function mostrarCategoria($categorias, $categoriasArticulo){
        $arrayCategoria = [];
    
        foreach($categoriasArticulo as $indice){
            $arrayCategoria[] = $categorias[$indice];
        }
    
        asort ($arrayCategoria);
        return $arrayCategoria;
    
    }
}

?>