<?php 

    /*
    
    función: buscar_en_tabla 
    descripción: Buscamos un 
    
    */

    function buscar_en_tabla($tabla = [], $columna, $valor){
        $columna_valores = array_column($tabla, $columna);

        return array_search ($valor, $columna_valores, false);
    }

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
    //             unset($libros[$indice]);
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