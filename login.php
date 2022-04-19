<?php
session_start();

include ('header.php');
?>

<body>

<div class="wrapper fadeInDown">
    <div id="formContent" style="zoom: 0.9">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first" style="margin: 10px;">
            <img src="imgs/logo.jpg" id="icon" alt="User Icon" style="border-radius: 500px;"/>
        </div>



        <!-- Login Form -->
        <form action="database/login.php" method="post">
            <input type="text" id="login" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="********">
            <input type="submit" class="btn btn-primary fadeIn fourth" value="Log In" style="color: white">
        </form>
        <p class="text-right" style="color: red">
            <?php
            if (isset($_SESSION['Error'])) {
                echo $_SESSION['Error'];
                unset($_SESSION['Error']);

            }
            ?>
        </p>

        <div id="formFooter">
            <a class="btn btn-success" href="signup.php">Sign Up?</a>
        </div>

    </div>
</div>


</body>
