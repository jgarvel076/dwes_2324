<?php

/*
    No respetará la propiedad de encapsulamiento.
*/

class Producto
{

    public $id;
    public $nombre;
    public $descripcion;
    public $ean_13;
    public $categoria_id;
    public $proveedor_id;
    public $precio_coste;
    public $precio_venta;
    public $stock;
    public $stock_min;
    public $stock_max;
    public $estado;

    


    public function __construct(
        $id = null, 
        $nombre = null,
        $descripcion = null,
        $ean_13 = null,
        $categoria_id = null,
        $proveedor_id = null,
        $precio_coste = null,
        $precio_venta = null,
        $stock = null,
        $stock_min = null,
        $stock_max = null,
        $estado = null,

        

    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->ean_13 = $ean_13;
        $this->categoria_id = $categoria_id;
        $this->proveedor_id = $proveedor_id;
        $this->precio_coste = $precio_coste;
        $this->precio_venta = $precio_venta;
        $this->stock = $stock;
        $this->stock_min = $stock_min;
        $this->stock_max = $stock_max;
        $this->estado = $estado;
        


    }

}

?>