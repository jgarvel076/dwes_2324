<?php
/*

    modelo: model.sumar.php

    permite la operacion suma

*/
# cargo valores del formulario
$valor1 = $_POST['valor1']; // valor de input num1
$valor2 = $_POST['valor2']; // valor de input num2
$operacion = $_POST['operacion'];


# Creo el objeto calculadora
$calcular = new Calculadora($valor1, $valor2, $operacion, null);

# Llamo al metodo que realizara la operacion correspondiente segun sea el caso
switch ($operacion) {
    case 'sumar':
        $calcular->sumar();
        break;
    case 'restar':
        $calcular->restar();
        break;
    case 'multiplicar':
        $calcular->multiplicar();
        break;
    case 'dividir':
        $calcular->dividir();
        break;
    case 'potencia':
        $calcular->potencia();
        break;
    default:
        echo 'Operación no válida';
        break;

}



?>