<?php
    /*
        Clase Calculadora
    */
    class Calculadora{
        private $valor1;
        private $valor2;
        private $operacion;
        private $resultado;
        public function __construct(
            $valor1 = 0, 
            $valor2 = 0, 
            $operacion = null , 
            $resultado = 0){
            $this->valor1 = $valor1;
            $this->valor2 = $valor2;
            $this->operacion = $operacion;
            $this->resultado = $resultado;
        }

        public function sumar(){
            $this->resultado = $this->valor1 + $this->valor2;
            $this->operacion = 'Sumar';
            return $this->resultado;
        }

        public function restar(){
            $this->resultado = $this->valor1 - $this->valor2;
            $this->operacion = 'Restar';
            return $this->resultado;
        }

        public function multiplicar(){
            $this->resultado = $this->valor1 * $this->valor2;
            $this->operacion = 'Multiplicar';
            return $this->resultado;
        }

        public function dividir(){
            $this->resultado = $this->valor1 / $this->valor2;
            $this->operacion = 'Dividir';
            return $this->resultado;
        }

        public function potencia(){
            $this->resultado = pow($this->valor1, $this->valor2);
            $this->operacion = 'Potencia';
            return $this->resultado;
        }


        /**
         * Get the value of valor1
         */ 
        public function getValor1()
        {
                return $this->valor1;
        }

        /**
         * Set the value of valor1
         *
         * @return  self
         */ 
        public function setValor1($valor1)
        {
                $this->valor1 = $valor1;

                return $this;
        }

        /**
         * Get the value of valor2
         */ 
        public function getValor2()
        {
                return $this->valor2;
        }

        /**
         * Set the value of valor2
         *
         * @return  self
         */ 
        public function setValor2($valor2)
        {
                $this->valor2 = $valor2;

                return $this;
        }

        /**
         * Get the value of operacion
         */ 
       

        /**
         * Set the value of operacion
         *
         * @return  self
         */ 
        public function setOperacion($operacion)
        {
                $this->operacion = $operacion;

                return $this;
        }

        public function getOperacion()
        {
                return $this->operacion;
        }

        /**
         * Get the value of resultado
         */ 
        public function getResultado()
        {
                return $this->resultado;
        }

        /**
         * Set the value of resultado
         *
         * @return  self
         */ 
        public function setResultado($resultado)
        {
                $this->resultado = $resultado;

                return $this;
        }
    }
?>