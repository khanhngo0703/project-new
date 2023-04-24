<?php
session_start();
require_once 'connect.php';

$sql = "SELECT products.*, collection_name, stylist_name from products inner join collections on products.collection_id = collections.id inner join stylists on products.stylist_id = stylists.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_prd = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_prd = [];
}

if(!isset($_SESSION['loginad'])) {
    header('Location: login.php');
}

if(isset($_GET['logout'])) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <h1 style="text-align: center;">WELCOME TO ADMINCP</h1>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Danh sach san pham</h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a class="btn btn-primary" href="login.php?logout=true">Dang xuat</a>
                <a class="btn btn-primary" href="addprd.php">Them san pham</a>
            </div>
            <table class="table table-reponsive">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Anh</th>
                        <th>Ten SP</th>
                        <th>Gia</th>
                        <th>So luong</th>
                        <th>Collection</th>
                        <th>Stylist</th>
                        <th>Cap nhat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($lst_prd as $prd) :
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><img style="height: 50px;" src="uploads/<?php echo $prd['thumbnail'] ?>"></td>
                            <td><?php echo $prd['product_name'] ?></td>
                            <td><?php echo $prd['price'] ?></td>
                            <td><?php echo $prd['num'] ?></td>
                            <td><?php echo $prd['collection_name'] ?></td>
                            <td><?php echo $prd['stylist_name'] ?></td>
                            <td><a href="updateprd.php?id=<?php echo $prd['id']; ?>" class="btn btn-warning me-2">Update</a>
                                <a onclick="deleteSV(event)" href="deleteprd.php?id=<?php echo $prd['id']; ?>" class="btn btn-danger" id="btn-xoa">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('#btn-xoa').forEach(function(elm, index) {
            elm.addEventListener('click', function(e) {
                console.log(e);
                e.preventDefault();
                let url = e.target.href;
                let isDelete = confirm('Ban co muon xoa khong');
                if (isDelete === true) {
                    window.location.href = url;
                }
            });
        })
    </script>
</body>

</html>