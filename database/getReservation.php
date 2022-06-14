<?php
session_start();
require_once ('connection.php');
$conn = getConnection();

$start_at = $_GET['start_at'] == '' ? '1970-01-01' : $_GET['start_at'];
$end_at = $_GET['end_at'] == '' ? '2099-01-01' : $_GET['end_at'];

$query = "SELECT * From `reservation` where `created_at` between '". $start_at ."' and '". $end_at ."'";

$result = $conn->query($query);

$reservations = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($reservations,
            [
                "id" => $row["id"],
                "type" => $row["type"],
                "type_id" => $row["type_id"],
                "content" => $row["content"],
                "price" => $row["price"],
                "created_at" => $row["created_at"]
            ]
        );
    }
}

echo json_encode($reservations);
return json_encode($reservations);