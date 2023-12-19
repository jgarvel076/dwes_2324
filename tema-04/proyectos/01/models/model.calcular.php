<?php 

    /*
    
        Modelo: model.calcular.php

        permite la operación sumar 

    */

    # Cargo los datos obtenidos del formulario 

    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $operacion = $_POST['operacion'];

    # Creo el objeto calculadora
    $calcular = new Calculadora($valor1, $valor2, $operacion, null);

    switch ($operacion){
        case 'sumar' : $calcular->suma(); break;
        case 'restar' : $calcular->resta(); break;
        case 'dividir' : $calcular->division(); break;
        case 'multiplicar' : $calcular->multiplicacion(); break;
        case 'potenciar' : $calcular->potencia(); break;
        default: echo 'Operación no válida'; break;
    }

?>