<?php

session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.html");
}

session_destroy();
header("Location: login.html");
exit();
?>
