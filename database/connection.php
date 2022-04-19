<?php

function getConnection(){
    $servername = "localhost";
    $username = "weddings";
    $password = "";

    $conn = mysqli_connect($servername, "root",$password, $username,"3306");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn,"utf8");

    return $conn;
}
?>
