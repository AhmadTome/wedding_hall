<?php
session_start();

//if (!isset($_SESSION['email'])) {
//    header('Location:login.php');
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>H&Ď Wedding Äccessories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .main-section {
        position: relative;
        background: linear-gradient(#919ca6, #98a1a9, rgba(0, 0, 0, .7)), url(imgs/banner-admin.jpg);
        height: auto;
        min-height: 600px;
        width: 100%;
        background-size: cover;
        padding: 0px 30px 15px 30px;
    }

    .main-section i {
        font-size: 35px;
        color: #fff;
        position: absolute;
        left: 50%;
        bottom: 15px;
        transform: translateX(-50%);
    }

    .main-section .section-part {
        color: #fff;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    @-webkit-keyframes blinker {
        from {
            opacity: 1.0;
        }
        to {
            opacity: 0.0;
        }
    }

    .blink {
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.6s;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: ease-in-out;
        -webkit-animation-direction: alternate;
    }

    .w3-bar-block .w3-bar-item {
        text-align: right !important;
    }
</style>
<body>



<nav class="navbar navbar-expand-sm bg-dark navbar-dark" dir="rtl">


    <a class="navbar-brand" href="AdminPanel.php">الصفحة الرئيسية</a>


    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="add_wedding_hall.php">إضافه صالة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_cake.php">إضافة كيك</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_adornment.php">اضافة تزيين</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_photographer.php">اضافة مصور</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_dress.php">إضافة فستان</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_band.php">إضافة فرقة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_dj.php">إضافة ديجي</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_hairdresser.php">إضافة كوافيرة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_accessories.php">إضافة اكسسوارات</a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="../reservations.php">جميع الحجوزات</a>
        </li>


        <?php
        if (isset($_SESSION['email'])) {
            echo '<li class="nav-item" style="float: left">
            <a class="nav-link" href="../helper/kill_session.php">تسجيل خروج</a>
        </li>';
        } else {
            echo '<li class="nav-item" style="float: left">
            <a class="nav-link" href="../login.php">تسجيل دخول</a>
        </li>';
        }
        ?>


    </ul>
</nav>


