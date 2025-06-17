<?php
require('functions.php');

if (!isset($_GET['id'])) {
    header("HTTP/1.0 400 Bad Request");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT img FROM productos WHERE id = $id LIMIT 1;";
$result = conexionBD($sql);
$row = mysqli_fetch_assoc($result);

if ($row && !empty($row['img'])) {
    header("Content-Type: image/jpeg");
    echo $row['img'];
} else {
    header("HTTP/1.0 404 Not Found");
}
?>
