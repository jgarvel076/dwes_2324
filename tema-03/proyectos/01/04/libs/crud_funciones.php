<?php

/*

función: buscar_en_tabla 
descripción: Buscamos un elemento de la tabla 

*/

function buscar_en_tabla($tabla = [], $columna, $valor)
{
    $columna_valores = array_column($tabla, $columna);

    return array_search($valor, $columna_valores, false);
}



//-------------------------------------------------------------------------------------------

/*

función: nuevoLibro()
descripción: Creamos una nueva instancia de Libros.
parámetros:
    - tabla
    - nuevo libro 
salida:
    - tabla actualizada

*/

function nuevoLibro($tabla = [], $libro)
{
    // Declaramos una varibale comparador que tendrá el valor de un funciónd e tipo cierre
    // con la cual comparamos los id de los libros, y si está devulve negativa, 
    // significa que el 'id' de a es menor que el 'id' de b, , y $a debería colocarse antes que $b 
    // Si es cero, los 'id' son iguales y no se realiza ningún cambio de orden. 
    // Si es positivo, $a debería colocarse después de $b.  
    $comparador = function($a, $b) {
        return $a['id'] - $b['id'];
    };
    
    // Mediante el método usort ordenamos la matriz mediante el resultado del comparador antes explicado
    usort($tabla, $comparador);

    $idNuevoLibro = $libro['id'];

    // Buscar la posición en la que se debe insertar el nuevo libro
    $posicionInsercion = -1;
    // Si en nuestro bucle foreach encontramos un id mayor al del nuevo libre 
    // la variable posicionInsercion pasará a valer la posición de ese libro 
    // sabiendo así que el libro que hemos introducido va antes de ese libro 
    foreach ($tabla as $indice => $libro) {
        if ($libro['id'] > $idNuevoLibro) {
            $posicionInsercion = $indice;
            break;
        }
    }

    // Por otra parte si anteriormente no se ha encontrado ningún libro con mayro id 
    // la variable posicionInsercion seguirá valiendo -1 y el nuevo libro se añadirá al final.
    if ($posicionInsercion !== -1) {
        return array_splice($tabla, $posicionInsercion, 0, [$libro]);
    } else {
        // Si no detectamos ningún libro con id mayor al nuevo libro 
        // añadimos ese libro a la última posición 
        return $tabla[] = $libro;
    }
}

//-------------------------------------------------------------------------------------------

/*

función: delete()
descripcion: elimina un elemento de la tabla
parámetros:
    - tabla
    - id del elemento que deseo eliminar
salida: 
    - tabla actualizada
    
*/

// Indicamos que el primer argumento es un array 
// function eliminar ($tabla = [], $id){
//     // Creamos un elemento nulo para posteriormente mostrarlo en mensaje
//     $libroEliminado = null;

//     // Comenzamos la búsqueda del libro con el id introducido 
//     foreach ($tabla as $indice => $libro) {
//         if ($libro['id'] == $id) {
//             $libroEliminado = $tabla[$indice];
//             // Gracias al método unset borramos el libro con el id buscado. 
//             unset($tabla[$indice]);
//             break;
//         }
//     }

//     if ($libroEliminado) {
//         return 'El libro con ID ' . $id . ' ("' . $libroEliminado['titulo'] . '") ha sido eliminado. La tabla ha sido actualizada.';
//     } else {
//         return 'No se encontró ningún libro con el ID ' . $id . '. La tabla no ha sido modificada.';
//     }
// }

// function eliminar ($tabla = [], $id){
//     $lista_id = array_column($tabla, 'id');

//     $elemento = array_search($id, $lista_id, false);

//     unset($tabla[$elemento]);

//     return $tabla;
// }

?>