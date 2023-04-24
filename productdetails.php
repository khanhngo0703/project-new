<?php
include "shared/_header.php";

$id = $_GET['id'];

$sql = "SELECT * FROM `products` p INNER JOIN collections c on p.collection_id = c.id INNER JOIN stylists s on p.collection_id = s.id WHERE p.id = $id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_productdetails = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<?php
foreach ($lst_productdetails as $productdetails) :
?>
    <div class="container">
        <div>
            <img class="pic" src="admin/uploads/<?php echo $productdetails['thumbnail']; ?>">
        </div>
        <form action="addcart.php?id=<?php echo $productdetails['id']; ?>" method="post">
            <div>
                <div class="detail">
                    <p>Product Name: <?php echo $productdetails['product_name']; ?></p>
                </div>
                <div class="detail">
                    <p>Product price: <?php echo $productdetails['price'] . 'đ'; ?></p>
                </div>
                <div class="detail">
                    <p>Quantity: <?php echo $productdetails['num']; ?></p>
                </div>
                <div class="detail">
                    <p>Designer name: <?php echo $productdetails['stylist_name']; ?></p>
                </div>
                <div class="detail">
                    <p>Collection: <?php echo $productdetails['collection_name']; ?></p>
                </div>
                <!-- <div class="detail">
                <p>Shirt size : 4 SIZE S/M/L/XL.</p>
            </div>
            <div class="detail">
                <p>Product material : Made of 95% cotton and 5% spandex, round neckline. The shirt has soft, cool fabric, feels smooth in the hand. Creates a youthful and dynamic feeling when used</p>
            </div>
            <div class="detail">
                <p>Product care tips : -When washing clothes inside out, do not soak . Do not use bleach to wash</p>
            </div> -->
                <div class="col-lg-3">
                    <div class="header_right">
                        <div class="header_right_auth">
                            <input type="submit" name="addprd" class="btn btn-warning" value="Add to Cart">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

<?php
endforeach;
?>

<?php
include "shared/_footer.php";
?>