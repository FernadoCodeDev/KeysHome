<?php

// Conexión a la base de datos
include 'includes/Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

// Crear un Email y Password
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";
echo $query;


// Agregar a la base de datos
if (mysqli_query($DB, $query)) {
    echo "Usuario agregado correctamente.";
} else {
    echo "Error al agregar usuario: " . mysqli_error($DB);
}

?>
