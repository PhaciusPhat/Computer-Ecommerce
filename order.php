<?php
session_start();
include('./utils/Validate.php');
include('./models/Order.php');
include('./models/User.php');
include('./models/Product.php');
include('./models/Cart.php');


$order = new Order();
$user = new User();
$validate = new Validate();
$cart = new Cart();
$product = new Product();
$arr = $_POST['arr'];
$arr = json_decode($arr);
$address = $_POST['address'];
if ($validate->validate_address($address) == 0) {
    echo 'Địa chỉ không hợp lệ';
} else {
    $total = 0;
    $date = getdate();

    $check = true;
    if (count($arr) == 0) {
        echo 'không có gì trong giỏ hàng';
        $check = false;
    }
    foreach ($arr as $item) {
        $check_product = $product->get_product_by_id($item[0]);
        foreach ($check_product as $p) {
            if ($item[1] < 1) {
                echo 'Số lượng sản phẩm không hợp lệ';
                $check = false;
                break;
            }
            if ($p['number'] < $item[1]) {
                $check = false;
                echo 'Sản phẩm ' . $p['name'] . ' không đủ số lượng';
                break;
            }
        }
        $total += $item[2] * $item[1];
    }

    if ($check) {
        $rsUser = $user->get_user_by_username($_SESSION['user']);
        foreach ($rsUser as $user) {
        }
        foreach ($arr as $item) {
            $check_product = $product->get_product_by_id($item[0]);
            foreach ($check_product as $p) {
                $checkUpdate = $product->update_number_product($p['id'], $p['number'] - $item[1]);
                if ($checkUpdate == 0) {
                    echo 'Cập nhật số lượng thất bại';
                    $check = false;
                    break;
                }
            }
            $check = $cart->delete_cart($user['id'], $item[0]);
            $total += $item[2] * $item[1];
        }
        if ($check == 0) {
            echo 'Lỗi';
        }

        $timestamp = strtotime("now");
        $rs = $order->create_order($total, $timestamp, $user['id'], $address);
        $findOrder = $order->find_order_by_name_timestamp($user['id'], $timestamp);
        foreach ($findOrder as $or) {
        }
        foreach ($arr as $item) {
            $check_create = $order->create_order_detail($item[0], $or['id'], $item[1], $item[2]);
            if ($check_create == 0) {
                $check=false;
                echo 'Lỗi';
                break;
            }
        }
        if ($rs == 1) {
            echo 'đặt hàng thành công!';
            // header('Location: qlloai.php');
        } else {
            echo 'đặt hàng thất bại!';
            // header('Location: qlloai.php');
        }

        // // echo $total;
    }
}
