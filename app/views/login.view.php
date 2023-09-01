<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">

    <!-- JS -->
    <script defer src="<?= ROOT ?>/assets/js/login.js"></script>

    <title>Login | Gift Zone</title>
</head>

<body>

    <div class="container">
        <div class="box">

            <!--- Login Section --->
            <div class="box-login">
                <form action="<?=ROOT?>/" method="post" id="form-login">
                    <div class="top-header">
                        <h3>Welcome to <a href="<?= ROOT ?>" class="link-home"><?= APP_NAME ?></a></h3>
                        <small>We are happy to have you back.</small>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <input type="email" class="input-box" id="email" placeholder=" " required>
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" id="passwd-1" placeholder=" " required>
                            <label for="logPassword">Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="togglePassword(1)">
                                    <i class="fa-regular fa-eye" id="eye-1"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-1"></i>
                                </div>
                            </div>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="formCheck" class="check">
                            <label for="formCheck"> Remember Me</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" name="btnLogin" class="input-submit" value="Login">
                        </div>
                        <div class="forgot">
                            <a href="#">Forgot password?</a>
                        </div>
                    </div>
                </form>
            </div>

            <!---- Registeration Section--->
            <div class="box-register">
                <form action="registration.php" method="post" id="form-login">
                    <div class="top-header">
                        <h3>Register with <a href="<?= ROOT ?>" class="link-home"><?= APP_NAME ?></a></h3>
                        <small>We are happy to have you with us.</small>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <input type="text" class="input-box" id="fname" placeholder=" " required>
                            <label for="fname">First Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input-box" id="lname" placeholder=" " required>
                            <label for="lname">Last Name</label>
                        </div>
                        <div class="input-field">
                            <input type="email" class="input-box" id="regEmail" placeholder=" " required>
                            <label for="regEmail">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" id="passwd-2" placeholder=" " required>
                            <label for="newPasswd">New Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="togglePassword(2)">
                                    <i class="fa-regular fa-eye" id="eye-2"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input-box" id="passwd-3" placeholder=" " required>
                            <label for="confirmPasswd">Confirm Password</label>
                            <div class="eye-area">
                                <div class="eye-box" onclick="togglePassword(3)">
                                    <i class="fa-regular fa-eye" id="eye-3"></i>
                                    <i class="fa-regular fa-eye-slash" id="eye-slash-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="input-submit" value="Sign Up">
                        </div>
                </form>
            </div>
        </div>

        <!---- Switch --->
        <div class="switch">
            <a href="#" class="switch-login" onclick="toggleForm(1)">Login</a>
            <a href="#" class="switch-register" onclick="toggleForm(2)">Register</a>
            <div class="switch-active"></div>
        </div>

    </div>

</body>

</html>