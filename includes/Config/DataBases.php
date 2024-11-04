<?php

function conectarDB() : mysqli {
    $servername = "sql101.infinityfree.com"; // Nombre de host de la base de datos
    $username = "si0_37646992"; // Tu nombre de usuario de InfinityFree
    $password = "OOuTfHcoEtUbFj5"; // Tu contraseña de InfinityFree
    $dbname = "if0_37646992_KeysHomesBackend"; // Tu nombre de base de datos de InfinityFree

    $DB = mysqli_connect($servername, $username, $password, $dbname);

    if (!$DB) {
        die("Error: No se pudo conectar a la base de datos. " . mysqli_connect_error());
    } 
    return $DB;
}




//