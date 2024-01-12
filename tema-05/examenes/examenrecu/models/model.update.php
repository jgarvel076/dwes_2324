<?php

/*
    Modelo: model.update.php
*/

# obtener id del alumno
$id_editar = $_GET['id'];

# Cargamos en varibales detalles del  formulario
$id = $_POST['id_libro'];
$isbn = $_POST['isbn'];
$ean = $_POST['ean'];
$titulo = $_POST['titulo'];
$autor_id = $_POST['autor'];
$editorial_id = $_POST['editorial'];
$precio_coste = $_POST['precio_coste'];
$precio_venta = $_POST['precio_venta'];
$stock = $_POST['stock'];
$stock_min = $_POST['stock_min'];
$stock_max = $_POST['stock_max'];
$fecha_edicion = $_POST['fecha_edicion'];
$num_pag = $_POST['num_pag'];

# Creamos un  objeto de la clase Alumno
$libro = new $libro();

# Asignamos valores a las propiedades
$libro->id = null;
$libro->isbn = $isbn;
$libro->ean = $ean;
$libro->titulo = $titulo;
$libro->autor_id = $autor_id;
$libro->editorial_id = $editorial_id;
$libro->precio_coste = $precio_coste;
$libro->precio_venta = $precio_venta;
$libro->stock = $stock;
$libro->stock_min = $stock_min;
$libro->stock_max = $stock_max;
$libro->fecha_edicion = $fecha_edicion;
$libro->num_pag = $num_pag;


# Validación

# actualizamos datos

$libros = new Libros();
$libros->update_libro($libro, $id);


header('location: index.php');

?>