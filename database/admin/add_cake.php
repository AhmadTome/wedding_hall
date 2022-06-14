<?php
session_start();
require_once ('../connection.php');
$conn = getConnection();

$taste = $_POST['taste'];
$price = $_POST['price'];


$query = "INSERT INTO `cake`(`taste`, `price`) VALUES ('". $taste ."','". $price ."')";
$result = $conn->query($query);

?>
