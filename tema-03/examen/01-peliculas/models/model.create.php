<?php


    $generos = getGeneros();
    
    $peliculas = getPeliculas();


    $registro = [
            'id' => nuevo_id($peliculas),
            'tiulo' => $_POST['titulo'],
            'pais' => $_POST['pais'],
            'director' => $_POST['director'],
            'generos' => $_POST['generos'],
            'año' => $_POST['año']
    ];
    
    $peliculas[] = $registro;

?>