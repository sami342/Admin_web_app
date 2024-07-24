<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script language="javascript" type="text/javascript">
    window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <div class="login">
        <img src="image/image5.jpg" alt="no image found" class="login__img">
        <form action="logincheck.php" class="login_form" method="POST" encty>
            <h1 class="login_title">Login</h1>
            <div class="login_content">
                <div class="login_box">
                    <i class="fa-solid fa-envelope" id="login_icon"></i>
                    <div class="login_box_input">
                        <input type="email" name="uemail" value="" required class="login_input" placeholder="">
                        <label for="" class="login_label">Email</label>
                    </div>
                </div>

                <div class="login_box">
                    <i class="fa-solid fa-lock" id="login_icon"></i>
                    <div class="login_box_input">
                        <input type="password" name="upassword" value="" required class="login_input" placeholder="">
                        <label for="" class="login_label">Password</label>
                    </div>
                </div>
            </div>

            <div class="login_check">
                <div class="login_check_group">
                <a href="Remove.php" class="login_forget">Remove Account</a>
                </div>
            </div>
            <button class="login_button" name="submit">Login</button>
            <p class="login_register">
                <a href="log.php">Register</a>
            </p>
        </form>
    </div>
<script>
    history.pushState();
    window.onpopstate=function(){
        history.go(1);
    }

</script>

</body>
</html>