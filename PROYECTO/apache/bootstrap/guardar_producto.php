<?php

session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.html");
    exit;
}

require('functions.php');

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$proveedor_id = $_POST['proveedor'];

// Inicializar la variable de imagen como NULL
$imagen = NULL;

// Procesar imagen solo si se ha subido
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Leer el contenido binario de la imagen
    $imagen = addslashes($imagen); // Escapar datos
}
$nombre = addslashes($nombre);
$precio = addslashes($precio);
$cantidad = addslashes($cantidad);
$proveedor_id = addslashes($proveedor_id);

// Crear la consulta SQL según si se ha subido o no una imagen
if ($imagen) {
    $sql = "INSERT INTO productos (nombre, precio, cantidad, proveedor_id, img) VALUES ('$nombre', '$precio', '$cantidad', '$proveedor_id', '$imagen')";
} else {
    $sql = "INSERT INTO productos (nombre, precio, cantidad, proveedor_id) VALUES ('$nombre', '$precio', '$cantidad', '$proveedor_id')";
}

if (conexionBD($sql)) {
    echo 'Producto añadido exitosamente.';
    header("Location: index.php");
    exit;
} else {
    echo 'Error al añadir el producto.';
    header("Location: añadir_productos.php");
    exit;
}

?>
