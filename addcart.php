<?php
session_start();

require_once 'admin/connect.php';
require_once 'admin/utils.php';

if (isset($_POST['addprd'])) {
    $id = $_GET['id'];
    $num = 1;
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $lst_newprd = $result->fetch_assoc();
    if ($result) {
        $new_product = array(array(
            'product_name' => $lst_newprd['product_name'],
            'id' => $id,
            'num' => $lst_newprd['num'],
            'price' => $lst_newprd['price'],
            'thumbnail' => $lst_newprd['thumbnail']
        ));

        if (isset($_SESSION['cart'])) {
            $found = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id'] == $id) {
                    $product[] = array(
                        'product_name' => $cart_item['product_name'],
                        'id' => $cart_item['id'],
                        'num' => $num + 1,
                        'price' => $cart_item['price'],
                        'thumbnail' => $cart_item['thumbnail']
                    );

                    $found = true;
                } else {
                    $product[] = array(
                        'product_name' => $cart_item['product_name'],
                        'id' => $cart_item['id'],
                        'num' => $num,
                        'price' => $cart_item['price'],
                        'thumbnail' => $cart_item['thumbnail']
                    );
                }
            }

            if($found == false) {
                $_SESSION['cart'] = array_merge($product, $new_product);
            }else {
                $_SESSION['cart'] = $product;
            }
        }else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location: cart.php');
}
?>