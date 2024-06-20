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
    $GLOBALS['clientes']['export'] = [1];
    $GLOBALS['clientes']['import'] = [1];
    $GLOBALS['clientes']['pdf'] = [1,2];

    // Permisos productos
    $GLOBALS['productos']['main'] = [1,2,3];
    $GLOBALS['productos']['new'] = [1,2];
    $GLOBALS['productos']['edit'] = [1,2];
    $GLOBALS['productos']['delete'] = [1];
    $GLOBALS['productos']['show'] = [1,2,3];
    $GLOBALS['productos']['filter'] = [1,2,3];
    $GLOBALS['productos']['order'] = [1,2,3];
    $GLOBALS['productos']['export'] = [1];
    $GLOBALS['productos']['import'] = [1];
    $GLOBALS['productos']['pdf'] = [1,2];

        // Permisos ventas
        $GLOBALS['ventas']['main'] = [1,2,3];
        $GLOBALS['ventas']['new'] = [1,2];
        $GLOBALS['ventas']['edit'] = [1,2];
        $GLOBALS['ventas']['delete'] = [1];
        $GLOBALS['ventas']['show'] = [1,2,3];
        $GLOBALS['ventas']['filter'] = [1,2,3];
        $GLOBALS['ventas']['order'] = [1,2,3];
?>