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
    <div class="register">
        <img src="image/image5.jpg" alt="no image found" class="register_img">
        <form action="Remove_account.php" class="register_form" method="POST" id="registerForm">
            <h1 class="register_title">Remove form</h1>
            <div class="register_content">

                <div class="register_box">
                    <i class="fa-solid fa-user" id="login_icon"></i>
                    <div class="register_box_input">
                        <input type="text" name="uname" required class="register_input" placeholder="" value="">
                        <label for="" class="register_label">Name</label>
                    </div>
                </div>

                <div class="register_box">
                    <i class="fa-solid fa-user" id="login_icon"></i>
                    <div class="register_box_input">
                        <input type="number" name="uworkid" required class="register_input" placeholder="" value="">
                        <label for="" class="register_label">Work ID</label>
                    </div>
                </div>

                <div class="register_box">
                    <i class="fa-solid fa-envelope" id="login_icon"></i>
                    <div class="register_box_input">
                        <input type="email" name="uemail" required class="register_input" placeholder="" value="">
                        <label for="" class="register_label">Email</label>
                    </div>
                </div>

                <div class="register_box">
                    <i class="fa-solid fa-key" id="login_icon"></i>
                    <div class="register_box_input">
                        <input type="password" name="upassword" required class="register_input" placeholder="" value="">
                        <label for="" class="register_label">Password</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="register_button">Submit</button>
        </form>
    </div>
    </script>
</body>
</html>
