<?php

class Vehiculo {

    private $modelo;
    private $nombre;
    private $matricula;
    private $velocidad;

    public function __constructor() {

        $this->modelo= null;
        $this->nombre= null;
        $this->matricula= null;
        $this->velocidad= 0;
    }


#setters
//modificar los valores de los atributos de un objeto

public function setModelo($modelo) {
    $this->modelo= $modelo;
}

public function setNombre($nombre) {
    $this->nombre= $nombre;
}

public function setMatricula($matricula) {
    $this->matricula= $matricula;
}

public function setVelocidad($velocidad) {
    $this->velocidad= $velocidad;
}

#getters
//obtener los valores asignados a los atributod de un objeto
public function getModelo($modelo) {
    $this->modelo= $modelo;
}

public function getNombre($nombre) {
    $this->nombre= $nombre;
}

public function getMatricula($matricula) {
    $this->matricula= $matricula;
}

public function getVelocidad($velocidad) {
    $this->velocidad= $velocidad;
}


}
?>