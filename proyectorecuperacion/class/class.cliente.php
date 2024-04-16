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
    public $provincia;
    public $nif;
    public $telefono;
    public $movil;
    public $email;
    


    public function __construct(
        $id = null, 
        $nombre = null,
        $direccion = null,
        $poblacion = null,
        $c_postal = null,
        $provincia = null,
        $nif = null,
        $telefono = null,
        $movil = null,
        $email = null,
        

    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->poblacion = $poblacion;
        $this->c_postal = $c_postal;
        $this->provincia = $provincia;
        $this->nif = $nif;
        $this->telefono = $telefono;
        $this->movil = $movil;
        $this->email = $email;
        


    }

}

?>