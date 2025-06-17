<?php

session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
}

require('functions.php');

// Obtener datos del formulario
$id_producto = intval($_POST['id']);
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];

// Inicializar la consulta para actualizar imagen
$imagen_query = "";
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Leer el contenido binario de la imagen
    $imagen = addslashes($imagen); // Escapar datos
    $imagen_query = ", img = '$imagen'";
}
$nombre = addslashes($nombre);
$precio = addslashes($precio);
$cantidad = addslashes($cantidad);

// Crear la consulta SQL para actualizar el producto
$sql = "UPDATE productos SET nombre = '$nombre', precio = '$precio', cantidad = '$cantidad' $imagen_query WHERE id = $id_producto";

if (conexionBD($sql)) {
    echo 'Producto actualizado exitosamente.';
    header("Location: index.php");
    exit;
} else {
    echo 'Error al actualizar el producto.';
    exit;
}

?>
