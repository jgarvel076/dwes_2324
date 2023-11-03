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

función: generar_Tabla()
descripción: genera la tabla de datos con la que vamos a trabajar
parámetros:

salida:
    - tabla de datos

*/

function generar_Tabla()
{
    $tabla = [
        [
            'id' => 1,
            'descripcion' => 'Portatil Acer',
            'modelo' => 'Aspire 3',
            'marca' => 0,
            'categoria' => [1,2],
            'unidades' => 100,
            'precio' => 430.05
        ],
        [
            'id' => 2,
            'descripcion' => 'Pantalla @lhua',
            'modelo' => 'Version 102',
            'marca' => 3,
            'categoria' => [4,0],
            'unidades' => 10.5,
            'precio' => 600.03
        ],
        [
            'id' => 3,
            'descripcion' => 'Pc Sobremesa - Lenovo Intel core',
            'modelo' => 'ideacentre 5105-07',
            'marca' => 1,
            'categoria' => [1,2,3],
            'unidades' => 1.75,
            'precio' => 200.30
        ],
        [
            'id' => 4,
            'descripcion' => 'Portatil LG',
            'modelo' => '340 - Intel I5',
            'marca' => 0,
            'categoria' => [2,3],
            'unidades' => 3.0,
            'precio' => 15.7
        ],
        [
            'id' => 5,
            'descripcion' => 'Placa base ',
            'modelo' => 'ASUS ROG STRIX Z790-F',
            'marca' => 2,
            'categoria' => [2,0],
            'unidades' => 100.50,
            'precio' => 14.5
        ]
    ];

    return $tabla;
}


//-------------------------------------------------------------------------------------------

/*

función: genera_tabla_categoria()
descripcion: generamos la tabla de la categoría 
parámetros:
salida: 
    - tabla actualizada
    
*/

function generar_Tabla_categoria()
{

    $categorias = ['Portatiles', 'PCs sobremesa', 'Componentes', 'Pantallas', 'Impresora'];

    asort($categorias);

    return $categorias;
}



//-------------------------------------------------------------------------------------------

/*

función: genera_tabla_categoria()
descripcion: generamos la tabla de la categoría 
parámetros:
salida: 
    - tabla actualizada
    
*/

function generar_Tabla_marcas()
{

    $marcas = [
        'Xiaomi',
        'Apple',
        'Samsung',
        'HP',
        'Lenovo',
        'Asus',
        'Acer',
        'Dell',
        'Toshiba',
        'Fujitsu'
    ];

    asort($marcas);

    return $marcas;
}



//-------------------------------------------------------------------------------------------
/*

    función: eliminar()
    descripcion: eliminamos un elemento de la tabla
    parámetros: id producto 

*/

//-------------------------------------------------------------------------------------------

// Donde $categoriasArticulo es un array con los índices de las categorías de cada artículo
function mostrarCategoria($categorias, $categoriasArticulo){
    $arrayCategoria = [];

    foreach($categoriasArticulo as $indice){
        $arrayCategoria[] = $categorias[$indice];
    }

    asort ($arrayCategoria);
    return $arrayCategoria;

}

?>