<?php
session_start();
require_once ('../connection.php');
$conn = getConnection();

$industry = $_POST['industry'];
$price = $_POST['price'];


$query = "INSERT INTO `dress`(`industry`, `price`) VALUES ('". $industry ."','". $price ."')";
$result = $conn->query($query);

?>
