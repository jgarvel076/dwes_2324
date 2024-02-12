<?php

//Cabecera
    $header = "Mime-Version: 1.0"."\n";
    $header .= "Content-Type: text/html; charset-iso-8859-1"."\n";
    $header .= "From: Julian Garcia Velazquez <jgarvel076@g.educaand.es>\n";
    $header .= "X-Mailer: PHP/" . phpversion();

//Parametros
    $destino = "jgarvel076@g.educaand.es";
    $asunto = "Prueba de envío de correo electrónico con PHP";
    $mensaje = "<h2>Este es un mensaje HTML</h2>";

//Enviar el correo
    if (mail($destino, $asunto, $mensaje, $header)) {
        echo "Mensaje enviado correstamente";
    }