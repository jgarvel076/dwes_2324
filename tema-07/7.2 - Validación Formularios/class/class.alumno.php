<?php

    class classAlumno {

        public $id;
        public $nombre;
        public $apellidos;
        public $email;
        public $telefono;
        public $direccion;
        public $poblacion;
        public $provincia;
        public $nacionalidad;
        public $dni;
        public $fechaNac;
        public $id_curso;

        public function __construct(
            $id     = null,
            $nombre = null,
            $apellidos= null,
            $email= null,
            $telefono= null,
            $direccion= null,
            $poblacion= null,
            $provincia= null,
            $nacionalidad= null,
            $dni= null,
            $fechaNac= null,
            $id_curso= null
        ) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->poblacion = $poblacion;
            $this->provincia = $provincia;
            $this->nacionalidad = $nacionalidad;
            $this->dni = $dni;
            $this->fechaNac = $fechaNac;
            $this->id_curso = $id_curso;

        }

        # Función para el calculo de la edad al recibir la fecha de nacimiento
        public function edad(){
            $fechaNacimiento = new DateTime($this->fechaNac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;
            return $edad;
        }

    }

?>