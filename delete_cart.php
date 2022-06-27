<?php 
    include './models/Cart.php';
    
    $cart = new Cart();

    $rs = $cart->delete_cart($_GET['userId'], $_GET['productId']);
    if ($rs) {
        header('location: giohang.php');
    } else {
        echo "Xóa thất bại";
    }
?> 