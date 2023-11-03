<?php

/*  
Fichero: funciones.php

    Descripción: Funciones para la gestión completa de una tabla de películas
    
    Autor: Pablo Mateos Palas
*/


function getGeneros()
{

    $generos = [

        "Acción",
        "Aventura",
        "Comedia",
        "Musical",
        "Terror",
        "Bélica",
        "Dramático",
        "Suspense",
        "Histórico",
        "Fantasía"
    ];

    return $generos;
}

function getPeliculas()
{

    $tabla = [
        [
            "id" => 1,
            "titulo" => "Joker",
            "director" => "Todd Phillips",
            "nacionalidad" => "Estados Unidos",
            "generos" => [6, 7],
            "año" => 2019

        ],
        [
            "id" => 2,
            "titulo" => "Mientras dure la guerra",
            "director" => "Alejandro Amenábar",
            "nacionalidad" => "España",
            "generos" => [6, 8],
            "año" => 2019
        ],
        [
            "id" => 3,
            "titulo" => "Terminator.Destino oscuro",
            "director" => "Tim Miller",
            "nacionalidad" => "Estados Unidos",
            "generos" => [0, 9],
            "año" => 2019

        ],
        [
            "id" => 4,
            "titulo" => "La vida es bella",
            "director" => "Roberto Benini",
            "nacionalidad" => "Italia",
            "generos" => [3, 5, 6],
            "año" => 1997

        ],
        [
            "id" => 5,
            "titulo" => "Interstellar",
            "director" => "Christopher Nolan",
            "nacionalidad" => "Estados Unidos",
            "generos" => [1, 6, 7],
            "año" => 2014

        ]
    ];

    return $tabla;

}

function eliminar($tabla, $indice)
{

    unset($tabla[$indice]);
    $tabla = array_values($tabla);
    return $tabla;
}

function nuevo($tabla, $registro)
{
    $tabla[] = $registro;
    return $tabla;
}
 
function actualizar($tabla, $registro, $indice)
{
    $tabla[$indice] = $registro;
    return $tabla;
}


function ordenar($tabla, $campo)
{

    # Creo un array auxiliar con los valores del criterio de ordenación
    $aux = array_column($tabla, $campo);

    array_multisort($aux, SORT_ASC, $tabla);

    return $tabla;
}


function filtrar($tabla, $expresion)
{

    $aux = [];

    foreach ($tabla as $registro) {

        if (in_array($expresion, $registro)) {

            $aux[] = $registro;
        }
    }

    return (empty($aux) ? $tabla : $aux);
}

function nuevo_id($tabla)
{
    $ultimo_id = count($tabla) + 1;

    return $ultimo_id;
}

function listaGeneros($generos, $indiceGeneros)
{
    $aux = [];
    foreach ($indiceGeneros as $genero) {
        $aux[] = $generos[$genero];
    }

    return $aux;
}


?>