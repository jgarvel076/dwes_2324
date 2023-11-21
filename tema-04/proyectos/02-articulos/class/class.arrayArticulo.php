<?php
/* 

    class.arrayArticulos.php

    tabla de articulos

    Es un array donde cada elemento es un objeto de la clase Artículo
*/

class ArrayArticulos
{

    private $tabla; //Array que almacena los artículos
    /* Constructor */
    public function __construct()
    {
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



    static public function getCategorias()
    {
        $categorias = [
            'Portátil',
            'PC sobremesa',
            'Componente',
            'Pantalla',
            'Impresora',
            'Teclado',
            'Mouse',
            'Disco Duro'
        ];

        return $categorias;
    }

    static public function getMarcas()
    {
        $marcas = [
            'HP',
            'Dell',
            'Lenovo',
            'Asus',
            'Acer',
            'MSI',
            'Samsung',
            'Apple'
        ];

        return $marcas;
    }

    public function getDatos()
    {

        #Articulo1
        $articulo = new Articulo(
            1,
            'Portátil - HP Omen 15',
            'HP Omen 15',
            0,
            [0,1,3],
            120,
            379
        );

        # Añadir el artículo a la tabla
        $this->tabla[] = $articulo;

        #Articulo2
        $articulo = new Articulo(
            2,
            'Portátil - MSI GS65 Stealth Thin',
            'MSI GS65 Stealth Thin',
            6,
            [0,2,4],
            364,
            20.5
        );

        # Añadir el artículo a la tabla
        $this->tabla[] = $articulo;

        #Articulo3
        $articulo = new Articulo(
            3,
            'PC Sobremesa - Lenovo Intel Core i7-7100',
            'IdeaCentre 950S-27IVB',
            1,
            [0,2,4],
            50,
            12.95
        );

        # Añadir el artículo a la tabla
        $this->tabla[] = $articulo;

        #Articulo4
        $articulo = new Articulo(
            4,
            'Monitor de PC - Samsung C49RG9x',
            'SAMSUNG C49RG9X',
            0,
            [1,3],
            150,
            15.95
        );

        # Añadir el artículo a la tabla
        $this->tabla[] = $articulo;

        #Articulo5
        $articulo = new Articulo(
            5,
            'Mouse - Razer viper Elite',
            'RAZER Viper ELITE',
            0,
            [1,2],
            10,
            15.95
        );

        # Añadir el artículo a la tabla
        $this->tabla[] = $articulo;

    }

    static public function mostrarCategorias($categorias, $categoriasArticulo)
    {
        $arrayCategorias = [];
        foreach ($categoriasArticulo as $indice) {
            $arrayCategorias[] = $categorias[$indice];
        }
        asort($arrayCategorias);
        return $arrayCategorias;
    }


    public function create(Articulo $data){
        $this->tabla[]= $data;
    }
    public function delete($indice){
        unset($this->tabla[$indice]);
        array_values($this->tabla);
    
    }
    public function update($indice, $articulo) {
        // toma un indice y modifica los valores en la tabla de ese indice
        $this->tabla[$indice] = $articulo;
    }

    public function buscar($indice){
        // retornamos los valores de ese indice en la tabla de la clase
        return $this->tabla[$indice]; 
    }
}
?>
