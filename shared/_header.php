<?php
session_start();
require_once 'admin/connect.php';

$sql = "SELECT * FROM collections";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_clt = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_clt = [];
}

if (isset($_GET['action'])) {
    $tam = $_GET['action'];
} else {
    $tam = '';
}

if ($tam == 'quanlysp') {
    require_once 'shop.php';
}

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylemen.css">
    <link rel="stylesheet" href="css/stylecontact.css">
    <link rel="stylesheet" href="css/style_prd-details.css">

</head>

<body>
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header_logo">
                        <a href="index.html">Fashion Shop</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header_menu">
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <?php
                            foreach ($lst_clt as $clt) :
                            ?>
                                <li><a href="shop.php?action=quanlysp&id=<?php echo $clt['id']; ?>"><?php echo $clt['collection_name'];  ?></a></li>

                            <?php
                            endforeach
                            ?>
                            <li><a href="#">Shop</a></li>
                            <li><a href="#">Pages</a></li>
                            <li><a href="contact.php">Contact</a></li>


                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header_right">
                        <div class="header_right_auth">
                            <a href="register.php"><button class="btn btn-warning">Register</button></a>
                            <a href="login.php"><button class="btn btn-warning">LogIn</button></a>
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                            <a href="login.php?logout=true"><button class="btn btn-warning">Logout</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>