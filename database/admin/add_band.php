<?php
session_start();
require_once ('../connection.php');
$conn = getConnection();

$name = $_POST['name'];
$price = $_POST['price'];


$query = "INSERT INTO `band`(`name`, `price`) VALUES ('". $name ."','". $price ."')";
$result = $conn->query($query);

?>
