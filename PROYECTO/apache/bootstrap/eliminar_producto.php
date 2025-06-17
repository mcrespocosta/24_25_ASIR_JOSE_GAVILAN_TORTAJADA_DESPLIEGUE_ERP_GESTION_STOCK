<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
}

require('functions.php');

// Obtener ID del producto y eliminarlo
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id > 0) {
    $deleteSQL = "DELETE FROM productos WHERE id = $id";
    conexionBD($deleteSQL);
}

header("Location: index.php");
exit;
