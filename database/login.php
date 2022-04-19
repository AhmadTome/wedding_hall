<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$email = $_POST['email'];
$password= $_POST['password'];

$query = "SELECT * FROM `users` WHERE `email` = '". $email ."' and `password` = '". $password ."'";


$result = $conn->query($query);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    if ($row['email'] == $email &&  $row['password'] == $password) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['Name'] = $row['name'];
        $_SESSION['Age'] = $row['age'];
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        if ($row['type'] == "admin") {
            header('Location: ../home.php');
        } else {
            header('Location: ../UserPanel.php');
        }
    }else {
        $_SESSION['Error'] = "البريد الالكتروني او الرقم السري غير صحيح, يرجى المحاولة مرة اخرى";
        header('Location: ../login.php');
    }

}
else {

    $_SESSION['Error'] = "البريد الالكتروني او الرقم السري غير صحيح, يرجى المحاولة مرة اخرى";
    header('Location: ../login.php');
}
?>
