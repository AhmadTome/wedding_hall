<?php
session_start();
require_once ('../connection.php');
chdir("../../");
$conn = getConnection();
$json = [];


for ($i=0;$i<count($_FILES['in']['name']); $i++) {
    upload($_FILES['in']['name'][$i], $_FILES['in']['tmp_name'][$i]);
    array_push($json, array("name" => $_FILES['in']['name'][$i], "type" => "داخلي"));
}

for ($i=0;$i<count($_FILES['out']['name']); $i++) {
    upload($_FILES['out']['name'][$i], $_FILES['out']['tmp_name'][$i]);
    array_push($json, array("name" => $_FILES['out']['name'][$i], "type" => "خارجي"));
}





$name = $_POST['name'];
$area = $_POST['area'];
$number_of_chair = $_POST['number_of_chair'];
$price = $_POST['price'];


$query = "INSERT INTO `wedding_hall`(`name`, `number_of_chair`, `area`, `imgs_details`, `price`) VALUES ('". $name ."', '". $number_of_chair ."', '". $area ."', '". json_encode($json, JSON_UNESCAPED_UNICODE) ."' ,'". $price ."')";

$result = $conn->query($query);

header('Location: ../../admin/add_wedding_hall.php');


function upload($name, $temp_name)
{

    $destination_path = getcwd();

    $target_path = $destination_path . '/imgs/'. basename( $name);

    //$target_dir = "uploads/";
    //$target_file = $target_dir . basename($name);

    if (move_uploaded_file($temp_name, $target_path)) {
        echo "The file ". htmlspecialchars( basename( $name)). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}







?>
