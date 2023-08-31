<?php

// Include function page
include_once("lib/function/userfunction.php");


if (isset($_POST["btnLogin"])) {

    $result =  Authentication($_POST['userEmail'], $_POST['userPassword']);
    echo ($result);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Login | Gift Zone</title>
</head>

<body>

    <div class="container">
        <div class="box">

            <body style="background-image: url('images/background 11.jpg');">

                <!--- Login Section --->
                <div class="box-login" id="login">
                    <form action="lib/views/dashboard/user.php" method="POST">
                        <form action="user.php" method="post">
                            <div class="top-header">
                                <h3>Welcome to Gift Zone</h3>
                                <small>We are happy to have you back.</small>
                            </div>
                            <div class="input-group">
                                <div class="input-field">
                                    <input type="text" class="input-box" id="logEmail" required>
                                    <label for="logEmail">loginEmail</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" class="input-box" id="logPassword" required>
                                    <label for="logPassword">loginPassword</label>
                                    <div class="eye-area">
                                        <div class="eye-box" onclick="myLogPassword()">
                                            <i class="fa-regular fa-eye" id="eye"></i>
                                            <i class="fa-regular fa-eye-slash" id="eye-slash"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="remember">
                                    <input type="checkbox" id="formCheck" class="check">
                                    <label for="formCheck"> Remember Me</label>
                                </div>
                                <div class="input-field">
                                    <input type="submit" name="btnLogin" class="input-submit" value="login">
                                </div>
                                <div class="forgot">
                                    <a href="#">Forgot password?</a>
                                </div>
                            </div>

                </div>




                <!---- Registeration Section--->

                <div class="box-register" id="register">
                    <form action="lib/routes/user/registration.php" method="POST">
                        <form action="registration.php" method="post">
                            <div class="top-header">
                                <h3>Sign Up, Now</h3>
                                <small>We are happy to have you with us.</small>
                            </div>
                            <div class="input-group">
                                <div class="input-field">
                                    <input type="text" class="input-box" id="regUser" required>
                                    <label for="regUser">UserName</label>
                                </div>
                                <div class="input-field">
                                    <input type="text" class="input-box" id="regEmail" required>
                                    <label for="regEmail">UserEmail</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" class="input-box" id="regPassword" required>
                                    <label for="regPassword">UserPassword</label>
                                    <div class="eye-area">
                                        <div class="eye-box" onclick="myRegPassword()">
                                            <i class="fa-regular fa-eye" id="eye-2"></i>
                                            <i class="fa-regular fa-eye-slash" id="eye-slash-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="remember">
                                    <input type="checkbox" id="formCheck-2" class="check">
                                    <label for="formCheck-2"> Remember Me</label>
                                </div>
                                <div class="input-field">
                                    <input type="submit" class="input-submit" value="Sign In">
                                </div>
                        </form>
                </div>

        </div>

        <!---- Switch --->

        <div class="switch">
            <a href="#" class="login" onclick="login()">Login</a>
            <a href="#" class="register" onclick="register()">Register</a>
            <div class="btn-active" id="btn"></div>

        </div>

    </div>
    </div>
    <script>
        var x = document.getElementById('login');
        var y = document.getElementById('register');
        var z = document.getElementById('btn');

        function login() {
            x.style.left = "27px";
            y.style.right = "-350px";
            z.style.left = "0px";
        }

        function register() {
            x.style.left = "-350px";
            y.style.right = "25px";
            z.style.left = "150px";
        }

        // view password codes


        function myLogPassword() {

            var a = document.getElementById('logPassword');
            var b = document.getElementById('eye');
            var c = document.getElementById('eye-slash');

            if (a.type === "password") {
                a.type = "text"
                b.style.opacity = "0";
                c.style.opacity = "1";

            } else {
                a.type = "password"
                b.style.opacity = "1";
                c.style.opacity = "0";

            }

        }


        function myRegPassword() {

            var d = document.getElementById('regPassword');
            var b = document.getElementById("eye-2");
            var c = document.getElementById("eye-slash-2");

            if (d.type === "password") {
                d.type = "text"
                b.style.opacity = "0";
                c.style.opacity = "1";

            } else {
                d.type = "password"
                b.style.opacity = "1";
                c.style.opacity = "0";

            }

        }
    </script>
</body>

</html>