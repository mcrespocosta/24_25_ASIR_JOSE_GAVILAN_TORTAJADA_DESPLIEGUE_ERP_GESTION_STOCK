<?php

function conexionBD($SQL){

  /*  $server = "l";
    $user = "jose";
    $pass = "1234";
    $database = "midb";
    En local
    */

      $server = "mysql";
    $user = "root";
    $pass = "1234";
    $database = "midb";
    $conexion = mysqli_connect($server, $user, $pass, $database);
    
    if(!$conexion){
        echo "Error: Unable to connect to MySQL.". PHP_EOL;
        echo "Debugging errno: ". mysqli_connect_errno(). PHP_EOL;
        exit;
    }
    mysqli_select_db($conexion, $database);

    $result = mysqli_query($conexion, $SQL);
    mysqli_close($conexion);
    return $result;
}

?>