<?php

session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.html");
}


require('functions.php');

// Obtener datos del formulario
$user      = $_POST['username'];
$email     = $_POST['email'];
$passhash  = hash("sha512", $_POST['password']);
$nacimiento = $_POST['nacimiento']; 
$rol        = $_POST['rol'];         

// Crear la consulta SQL incluyendo los dos nuevos campos
$sql = "INSERT INTO users (user, paswd, mail, nacimiento, rol) VALUES ('$user', '$passhash', '$email', '$nacimiento', '$rol')";

if (conexionBD($sql)) {
    echo 'Usuario creado exitosamente.';
    header("Location: index.php");

} else {
    echo 'Error al crear el usuario.';
    header("Location: form_crear_users.html");
    exit;
}


?>
