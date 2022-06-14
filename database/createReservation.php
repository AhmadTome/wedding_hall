<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$type = $_POST['type'];
$type_id = $_POST['type_id'] ?? null;
$price = $_POST['price'];
$content = $_POST['content'];

$date = new DateTime("now", new DateTimeZone('Asia/Amman') );

$query = "INSERT INTO `reservation`(`type`, `type_id`, `content`, `price`, `user_id`, `created_at`) VALUES ('". $type ."', '". $type_id ."', '". $content ."', '". $price ."', '". $_SESSION['id'] ."', '". $date->format('Y-m-d H:i') ."')";



$result = $conn->query($query);
if ($result) {
    echo "تم الحجز بنجاح";

} else {
    echo 'فشلت عملية الحجز';
}

?>
