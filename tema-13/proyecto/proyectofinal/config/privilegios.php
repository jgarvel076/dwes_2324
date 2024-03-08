<?php
    /**
     * # Perfiles
     * 1 - Administrador
     * 2 - Editor
     * 3 - Registrado
     * 
     * # Definimos los privilegios como variables globales
     * Index: administrador, editor, registrado
     * nuevo: administrador, editor
     * Editar: administrador, editor
     * Eliminar: administrador
     * Mostrar: administrador, editor, registrado
     * Buscar: administrador, editor, registrado
     * Ordenar: administrador, editor, registrado 
     * 
     */

    // Permisos clientes
    $GLOBALS['clientes']['main'] = [1,2,3];
    $GLOBALS['clientes']['new'] = [1,2];
    $GLOBALS['clientes']['edit'] = [1,2];
    $GLOBALS['clientes']['delete'] = [1];
    $GLOBALS['clientes']['show'] = [1,2,3];
    $GLOBALS['clientes']['filter'] = [1,2,3];
    $GLOBALS['clientes']['order'] = [1,2,3];
    $GLOBALS['clientes']['import'] = [1,2];
    $GLOBALS['clientes']['export'] = [1,2,3];
    $GLOBALS['clientes']['import'] = [1,2];
    $GLOBALS['clientes']['export'] = [1,2];
    $GLOBALS['clientes']['pdf'] = [1,2];

    // Permisos cuentas
    $GLOBALS['cuentas']['main'] = [1,2,3];
    $GLOBALS['cuentas']['new'] = [1,2];
    $GLOBALS['cuentas']['edit'] = [1,2];
    $GLOBALS['cuentas']['delete'] = [1];
    $GLOBALS['cuentas']['show'] = [1,2,3];
    $GLOBALS['cuentas']['filter'] = [1,2,3];
    $GLOBALS['cuentas']['order'] = [1,2,3];
    $GLOBALS['cuentas']['import'] = [1,2];
    $GLOBALS['cuentas']['export'] = [1,2,3];
    $GLOBALS['cuentas']['pdf'] = [1,2];
    $GLOBALS['cuentas']['tablaMovimientos'] = [1,2,3];

    //Permisos movientos
    $GLOBALS['movimiento']['main'] = [1, 2, 3];
    $GLOBALS['movimiento']['new'] = [1, 2];
    $GLOBALS['movimiento']['edit'] = [1, 2];
    $GLOBALS['movimiento']['delete'] = [1];
    $GLOBALS['movimiento']['show'] = [1, 2, 3];
    $GLOBALS['movimiento']['filter'] = [1, 2, 3];
    $GLOBALS['movimiento']['order'] = [1, 2, 3];

    //Permisos usuarios
    $GLOBALS['user']['main'] = [1];
    $GLOBALS['user']['new'] = [1];
    $GLOBALS['user']['delete'] = [1];
    $GLOBALS['user']['edit'] = [1];
    $GLOBALS['user']['show'] = [1];
    $GLOBALS['user']['filter'] = [1];
    $GLOBALS['user']['order'] = [1];    

?>