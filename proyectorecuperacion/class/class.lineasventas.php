<?php

/*
    No respetará la propiedad de encapsulamiento.
*/

class LienasVenta
{

    public $id;
    public $venta_id;
    public $producto_id;
    public $precio;
    public $importe;
    


    public function __construct(
        $id = null, 
        $venta_id = null,
        $producto_id = null,
        $precio = null,
        $importe = null,
        

    ) {
        $this->id = $id;
        $this->venta_id = $venta_id;
        $this->producto_id = $producto_id;
        $this->precio = $precio;
        $this->importe = $importe;


    }

}

?>