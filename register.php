<?php
require_once "admin/connect.php";
$errors = [];

if (isset($_POST['register'])) {
    $fullname = $_POST['FullName'];
    $usersname = $_POST['Username'];
    $email =  $_POST['Email'];
    $phonenumber =  $_POST['PhoneNumber'];
    $password =  $_POST['Password'];
    if (empty($fullname)) {
        $errors[] = 'FullName cannot be left blank';
    }
    if (empty($usersname)) {
        $errors[] = 'UserName cannot be left blank';
    }
    if (empty($email)) {
        $errors[] = 'Email cannot be left blank';
    }
    if (empty($phonenumber)) {
        $errors[] = 'PhoneNumber cannot be left blank';
    }
    if (empty($password)) {
        $errors[] = 'PassWord cannot be left blank';
    }

    $sql = "select * from users where username='$usersname'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $erros[] = " Username is already exists";
    }

    if (count($errors) == 0) {
        $pass_sha1 = sha1($password);

        $sql = "insert into users (fullname,username,email,phone_number,password_hash) values ('$fullname','$usersname','$email','$phonenumber','$pass_sha1')";
        $res = $conn->query($sql);
        if ($res) {
            echo " Sign Up Success.";
            header("Location:index.php");
            exit();
        } else {
            $errors[] = "Registration failed";
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
    <title>Register</title>
</head>

<body>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box register">
            <h2>Registation</h2>
            <?php
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            ?>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon> Full Name</span>
                    <input type="text" name="FullName">
                    <label for="Fullname"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon> Username</span>
                    <input type="text" name="Username">
                    <label for="Username"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon> Email</span>
                    <input type="email" name="Email">
                    <label for="Email"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon> Phone Number</span>
                    <input type="number" name="PhoneNumber">
                    <label for="Phonenumber"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
                    <input type="password" name="Password">
                    <label for="Password"></label>
                </div>
                <div class="remember-forgot">
                    <label>Do you already have an account?<a href="login.php" style="color: brown;">Log in</a></label>
                </div>
                <button type="submit" class="btn" name="register">Register</button>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</html>