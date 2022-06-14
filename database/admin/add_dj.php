<?php
session_start();
require_once ('../connection.php');
$conn = getConnection();

$name = $_POST['name'];
$rate = $_POST['rate'];
$price = $_POST['price'];


$query = "INSERT INTO `dj`(`name`, `rate`, `price`) VALUES ('". $name ."','". $rate ."' ,'". $price ."')";
$result = $conn->query($query);

?>
