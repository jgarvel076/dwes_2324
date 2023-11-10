<?php

function buscar_en_tabla($tabla = [], $columna, $valor)
{
    $columna_valores = array_column($tabla, $columna);
    return array_search($valor, $columna_valores, false);

}

function generar_tabla()
{
    $tabla = [
        [
            'id' => 1,
            'descripcion' => 'Portátil - HP 15-DB0074NS',
            'modelo' => 'HP 15-DB0074NS',
            'marca' => 0,
            'categorias' => [2, 3, 4],
            'unidades' => 120,
            'precio' => 379
        ],
        [
            'id' => 2,
            'descripcion' => 'Portátil - AMD A4-9125, 8GB RAM, 125GB',
            'modelo' => 'HP 255 G7, 15.6',
            'marca' => 3,
            'categorias' => [1, 3, 2],
            'unidades' => 200,
            'precio' => 20.5
        ],
        [
            'id' => 3,
            'descripcion' => 'PC Sobremesa - Lenovo Intel Core i3-8100',
            'modelo' => 'IdeaCentre 510S-07ICB',
            'marca' => 5,
            'categorias' => [1, 3],
            'unidades' => 50,
            'precio' => 12.95
        ],
        [
            'id' => 4,
            'descripcion' => 'PC Sobremesa - HP 290 APU AMD Dual-Core A6',
            'modelo' => 'HP 290-a0002ns',
            'marca' => 4,
            'categorias' => [2, 4],
            'unidades' => 120,
            'precio' => 15.95
        ],


    ];
    return $tabla;

}

function generar_categorias()
{
    $categorias = [
        'Portátil',
        'PC sobremesa',
        'Componente',
        'Pantalla',
        'Impresora'
    ];

    return $categorias;
}

function generar_tabla_marcas()
{
    $marcas = [
        'Dell',
        'Lenovo',
        'Asus',
        'Acer',
        'Toshiba',
        'Hp',
        'Apple',
        'MSI',
        'Fujitsu',
        'LG'
    ];
    return $marcas;
}

/*

    funcion: eliminar()
    descripción: elimina un elemento de la tabla
    paramteros: 
                - tabla
                - id del elemento que deseo eliminar
    salida: 
                - tabla actualizada

*/

function eliminar($tabla = [], $id)
{

    // Buscar elemento que le corresponde id
    $lista_id = array_column($tabla, 'id');

    // Busco id del libro que deseo eliminar en dicha columna
    $elemento = array_search($id, $lista_id, false);


    unset($tabla[$elemento]);

    return $tabla;
    // Eliminar elemento de la tabla



}


function nuevo($tabla, $registro)
{
    $tabla[] = $registro;
    return $tabla;
}

function update($tabla, $edicion)
{
    $tabla[] = $edicion;
    return $tabla;
}


function mostrarCategorias($categorias = [], $categoriasArticulo = [])
{
    $arrayCategorias = [];
    foreach ($categorias as $indice) {
        $arrayCategorias[] = $categorias[$indice];
    }
    return $arrayCategorias;
}
?>