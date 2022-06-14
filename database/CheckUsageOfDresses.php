<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$query = "SELECT * FROM `reservation` WHERE `type` = 'dress'";

$result = $conn->query($query);

$reservations = [];

if ($result->num_rows > 0) {
    $count = 0;
    $info = json_decode($_POST['info'], true);
    while ($row = $result->fetch_assoc()) {
        $content = json_decode($row['content'], true);
        if ($info['اللون'] == $content['اللون'] && $info['الحجم'] == $content['الحجم'] && $info['نوع القماش'] == $content['نوع القماش'] && $info['الصناعة'] == $content['الصناعة']) {
            $count++;
        }
    }

    echo $count;
    return;
}

echo 0;
return;