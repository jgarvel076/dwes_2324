<?php
class Calculadora {
    private $valor1;
    private $valor2;
    private $operacion;
    private $resultado;

    public function __construct() {
        $this->valor1 = 0;
        $this->valor2 = 0;
        $this->operacion = null;
        $this->resultado = 0;
    }

    public function suma() {
        $this->operacion = 'suma';
        $this->resultado = $this->valor1 + $this->valor2;
    }

    public function resta() {
        $this->operacion = 'resta';
        $this->resultado = $this->valor1 - $this->valor2;
    }

    public function multiplicacion() {
        $this->operacion = 'multiplicacion';
        $this->resultado = $this->valor1 * $this->valor2;
    }

    public function division() {
        if ($this->valor2 != 0) {
            $this->operacion = 'division';
            $this->resultado = $this->valor1 / $this->valor2;
        } else {
            echo "Error: División por cero.";
        }
    }

    public function potencia() {
        $this->operacion = 'potencia';
        $this->resultado = pow($this->valor1, $this->valor2);
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function setValor1($valor) {
        $this->valor1 = $valor;
    }

    public function setValor2($valor) {
        $this->valor2 = $valor;
    }

    public function getOperacion() {
        return $this->operacion;
    }
}
?>