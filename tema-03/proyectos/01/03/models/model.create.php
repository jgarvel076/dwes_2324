<?php


/*
    Recogemos los datos del nuevo libro y llamamos a la función nuevoLibro().
*/

$libro =
    [
        'id' => $_POST['id'],
        'titulo' => $_POST['titulo'],
        'autor' => $_POST['autor'],
        'genero' => $_POST['genero'],
        'precio' => $_POST['precio']
    ];

//$libros = nuevoLibro($libros, $libro);
global $libros;

// La función nuevoLibro me sale como no definida por lo que opte por medir el array y añadir el nuevo libro en el ultimo espacio,
// aunque en este caso la variable $libros, es decir la matriz de libros me da como no definida 
$ultimovalor = strlen($libros);

$libros[$ultimovalor - 1] = $libro;

?>