<?php

/*
    No respetará la propiedad de encapsulamiento.
*/

class Venta
{

    public $id;
    public $cliente_id;
    public $importe_total;
    public $estado;
    


    public function __construct(
        $id = null, 
        $cliente_id = null,
        $importe_total = null,
        $estado = null,

        

    ) {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->importe_total = $importe_total;
        $this->estado = $estado;

        


    }

}

?>