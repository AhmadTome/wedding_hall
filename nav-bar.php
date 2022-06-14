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
<!---->
<!--<div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:15%; right:0;text-align: right">-->
<!--    <a href="AdminPanel.php" class="w3-bar-item w3-button">الصفحة الرئيسية</a>-->
<!--    <a href="wedding_hall.php" class="w3-bar-item w3-button">حجز الصالة</a>-->
<!--    <a href="cake.php" class="w3-bar-item w3-button">حجز كيك</a>-->
<!--    <a href="adornment.php" class="w3-bar-item w3-button">التزيين</a>-->
<!--    <a href="photographer.php" class="w3-bar-item w3-button">المصور</a>-->
<!--    <a href="AdminPanel.php" class="w3-bar-item w3-button">الفستان</a>-->
<!--    <a href="AdminPanel.php" class="w3-bar-item w3-button">الاكسسوارات</a>-->
<!--    <a href="AdminPanel.php" class="w3-bar-item w3-button">الكوافيرة</a>-->
<!---->
<!---->
<!--    <a href="helper/kill_session.php" class="w3-bar-item w3-button">تسجيل الخروج</a>-->
<!---->
<!---->
<!--</div>-->


<nav class="navbar navbar-expand-sm bg-dark navbar-dark" dir="rtl">


    <a class="navbar-brand" href="UserPanel.php">الصفحة الرئيسية</a>


    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="wedding_hall.php">حجز الصالة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cake.php">حجز كيك</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adornment.php">التزيين</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="photographer.php">المصور</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dress.php">الفستان</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="band.php">الفرقة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dj.php">الديجي</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="hairdresser.php">الكوافيرة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="accessories.php">الاكسسوارات</a>
        </li>

        <?php

        if (isset($_SESSION['type']) && $_SESSION['type'] == 'user') {
            echo '<li class="nav-item">
            <a class="nav-link" href="my-reservations.php">حجوزاتي</a>
        </li>';
        } else if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
            echo '<li class="nav-item">
            <a class="nav-link" href="reservations.php">جميع الحجوزات</a>
        </li>';
        }
        ?>



        <?php
        if (isset($_SESSION['email'])) {
            echo '<li class="nav-item" style="float: left">
            <a class="nav-link" href="helper/kill_session.php">تسجيل خروج</a>
        </li>';
        } else {
            echo '<li class="nav-item" style="float: left">
            <a class="nav-link" href="login.php">تسجيل دخول</a>
        </li>';
        }
        ?>


    </ul>
</nav>


<!--<script>-->
<!--    function myAccFunc() {-->
<!--        var x = document.getElementById("demoAcc");-->
<!--        if (x.className.indexOf("w3-show") == -1) {-->
<!--            x.className += " w3-show";-->
<!--            x.previousElementSibling.className += " w3-green";-->
<!--        } else {-->
<!--            x.className = x.className.replace(" w3-show", "");-->
<!--            x.previousElementSibling.className =-->
<!--                x.previousElementSibling.className.replace(" w3-green", "");-->
<!--        }-->
<!--    }-->
<!---->
<!--    function myDropFunc() {-->
<!--        var x = document.getElementById("demoDrop");-->
<!--        if (x.className.indexOf("w3-show") == -1) {-->
<!--            x.className += " w3-show";-->
<!--            x.previousElementSibling.className += " w3-green";-->
<!--        } else {-->
<!--            x.className = x.className.replace(" w3-show", "");-->
<!--            x.previousElementSibling.className =-->
<!--                x.previousElementSibling.className.replace(" w3-green", "");-->
<!--        }-->
<!--    }-->
<!--</script>-->