<?php
session_start();
require_once 'admin/connect.php';
$erros = [];
if (isset($_POST['login'])) {
    $email = $_POST['Email'];
    $pass = sha1($_POST['Password']);
    if (empty($email)) {
        $erros[] = "Email is required";
    }
    if (empty($pass)) {
        $erros[] = "Password is required";
    }
    if (count($erros) == 0) {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password_hash = '$pass'";

        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $_SESSION['loggedin'] = $email;
            header('Location: index.php');
        } else {
            $erros[] = "Email or Password is incorrect";
            header('Location: login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_register-login.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon> Email</span>
                    <input type="email" name="Email">
                    <label for="Email"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
                    <input type="password" name="Password">
                    <label for="Password"></label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password</a>
                </div>
                <div class="new-to-page">
                    <label style="margin-left: 55px;">New to Fashion Shop?<a href="register.php">Register</a></label>
                </div>
                <button type="submit" class="btn" name="login">Login</button>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</html>