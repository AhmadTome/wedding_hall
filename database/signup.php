<?php


session_start();
require_once ('connection.php');
$conn = getConnection();

$Name = $_POST['Name'];
$Age = $_POST['Age'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];


if ($Name == "" || $Age == "" || $email == "" || $password == "") {
    $_SESSION['Error'] = "فشلت عمليه تسجيل حساب جديد, يرجى ملئ الحقول كاملة";
    header('Location: ../signup.php');
    return;
}

    $query = "INSERT INTO `users`(`name`, `age`, `email`, `password`, `type`, `phone`, `address`) VALUES ('". $Name ."','". $Age ."','". $email ."','". $password ."','user','". $phone ."','". $address ."')";
    $result = $conn->query($query);
    if ($result) {
        echo "تم انشاء الحساب بنجاح";
        $_SESSION['Name'] = $Name;
        $_SESSION['Age'] = $Age;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['type'] = 'user';
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;

        header('Location: ../UserPanel.php');

    } else {
        $_SESSION['Error'] = "فشلت عمليه تسجيل حساب جديد, البريد الالكتروني مستخدم بالفعل";
        header('Location: ../signup.php');
    }






?>
