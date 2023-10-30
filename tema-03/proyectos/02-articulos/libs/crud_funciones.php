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


function generar_Tabla()
{
    $tabla = [
        [
            'id' => 1,
            'descripcion' => 'Portatil ASUS',
            'modelo' => 'A17',
            'categoria' => 0,
            'unidades' => 100,
            'precio' => 430
        ],
        [
            'id' => 2,
            'descripcion' => 'Pantalla MSI',
            'modelo' => 'DRAGON',
            'categoria' => 3,
            'unidades' => 10,
            'precio' => 900
        ],
        [
            'id' => 3,
            'descripcion' => 'HP Sobremesa',
            'modelo' => 'MODERN',
            'categoria' => 1,
            'unidades' => 15,
            'precio' => 500
        ],
        [
            'id' => 4,
            'descripcion' => 'Portatil LG',
            'modelo' => '917',
            'categoria' => 0,
            'unidades' => 9,
            'precio' => 15
        ],
        [
            'id' => 5,
            'descripcion' => 'Placa base ',
            'modelo' => 'MSI',
            'categoria' => 2,
            'unidades' => 960,
            'precio' => 14
        ]
    ];

    return $tabla;
}


function generar_Tabla_categoria()
{

    $categorias = ['Portatiles', 'PCs sobremesa', 'Componentes', 'Pantallas', 'Impresora'];

    return $categorias;
}



?>