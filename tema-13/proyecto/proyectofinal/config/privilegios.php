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
    $GLOBALS['movimientos']['main'] = [1, 2, 3];
    $GLOBALS['movimientos']['new'] = [1, 2];
    $GLOBALS['movimientos']['edit'] = [1, 2];
    $GLOBALS['movimientos']['delete'] = [1];
    $GLOBALS['movimientos']['show'] = [1, 2, 3];
    $GLOBALS['movimientos']['filter'] = [1, 2, 3];
    $GLOBALS['movimientos']['order'] = [1, 2, 3];

    //Permisos usuarios
    $GLOBALS['users']['main'] = [1];
    $GLOBALS['users']['new'] = [1];
    $GLOBALS['users']['delete'] = [1];
    $GLOBALS['users']['edit'] = [1];
    $GLOBALS['users']['show'] = [1];
    $GLOBALS['users']['filter'] = [1];
    $GLOBALS['users']['order'] = [1];    

?>