<?php
session_start();
require_once ('../connection.php');
$conn = getConnection();

$name = $_POST['name'];
$phone = $_POST['phone'];
$price = $_POST['price'];


$query = "INSERT INTO `photographer`(`name`, `phone`, `price`) VALUES ('". $name ."','". $phone ."','". $price ."')";
$result = $conn->query($query);

?>
