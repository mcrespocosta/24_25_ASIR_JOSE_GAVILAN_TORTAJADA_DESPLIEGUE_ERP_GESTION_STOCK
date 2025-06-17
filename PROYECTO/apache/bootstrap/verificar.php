<?php
session_start();
require('functions.php');

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];
$passhash = hash("sha512", $password);

// Consulta para buscar usuario por email
$sql = "SELECT user, paswd, rol, nacimiento FROM users WHERE mail = '$email'";

$result = conexionBD($sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['paswd'] == $passhash) {
        $_SESSION['nombre'] = $row['user'];
        $_SESSION['email'] = $email;
        $_SESSION['rol'] = $row['rol'];
        $_SESSION['nacimiento'] = $row['nacimiento'];
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit;
    } else {
        echo "Contraseña incorrecta.";
        header("refresh:5; url=login.html");
    }
} else {
    echo "No existe usuario con ese correo.";
    header("refresh:5; url=login.html");
}
?>
