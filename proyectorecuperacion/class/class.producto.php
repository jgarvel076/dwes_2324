<?php

/*
    No respetará la propiedad de encapsulamiento.
*/

class Producto
{

    public $id;
    public $nombre;
    public $ean_13;
    public $descripcion;
    public $categoria_id;
    public $precio_venta;
    public $stock;

    


    public function __construct(
        $id = null, 
        $nombre = null,
        $ean_13 = null,
        $descripcion = null,
        $categoria_id = null,
        $precio_venta = null,
        $stock = null,

        

    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ean_13 = $ean_13;
        $this->descripcion = $descripcion;
        $this->categoria_id = $categoria_id;
        $this->precio_venta = $precio_venta;
        $this->stock = $stock;
        


    }

}

?>