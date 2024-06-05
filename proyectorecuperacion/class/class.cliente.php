<?php

/*
    No respetará la propiedad de encapsulamiento.
*/

class Cliente
{

    public $id;
    public $nombre;
    public $direccion;
    public $poblacion;
    public $c_postal;
    public $telefono;
    public $email;
    public $nif;
    


    public function __construct(
        $id = null, 
        $nombre = null,
        $direccion = null,
        $poblacion = null,
        $c_postal = null,
        $telefono = null,
        $email = null,
        $nif = null

        

    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->poblacion = $poblacion;
        $this->c_postal = $c_postal;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->nif = $nif;

        


    }

}

?>