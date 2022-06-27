<?php include './header.php';
include './models/Product.php';
include './utils/Validate.php';
include './models/Cart.php';
include './models/User.php';
$user = new User();
$validate = new Validate();
$cart = new Cart();
$id = $_GET['id'];
$product = new Product();

$rs = $product->get_product_by_id($id);
foreach ($rs as $r) {
}
if (isset($_POST['btn-add-cart'])) {
    if (!isset($_SESSION['user'])) {
        echo '<script>alert("Bạn phải đăng nhập để thực hiện chức năng này!");</script>';
    } else {
        foreach ($user->get_user_by_username($_SESSION['user']) as $current_user) {
        }

        $number = $_POST['number'];
        if ($validate->validate_number($number) == 0) {
            echo '<script>alert("Số lượng không hợp lệ!");</script>';
        } else {
            $listCart = $cart->get_cart();
            $check = 0;
            foreach ($listCart as $c) {
                if ($c['productId'] == $id && $c['userId'] == $current_user['id']) {
                    $check = 1;
                    $rs = $cart->update_cart($current_user['id'], $id, $number);
                    break;
                }
            }
            if ($check == 0) {
                $rs = $cart->add_cart($current_user['id'], $id, $number);
            }
            if ($rs == 1) {
                echo '<script>alert("Thêm vào giỏ hàng thành công!");</script>';
            } else {
                echo '<script>alert("Thêm vào giỏ hàng thất bại!");</script>';
            }
        }
    }
}
?>


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <?php
        if ($r['number'] > 0) {
            echo '
            <div class="col-lg-5 mb-30">
                <img class="w-100 h-100" src="./uploads/' . $r['image'] . '" alt="Image">
            </div>
    
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    
                    <h3>' . $r['name'] . '</h3>
                    <h3 class="font-weight-semi-bold mb-4">' . number_format($r['price'], 0, '', ',') . "đ" . '</h3>
    
                    <form method="post" class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <input type="number" class="form-control bg-secondary border-0 text-center" name="number" value="1">
                        </div>
                        <button type="submit" name="btn-add-cart"
                        class="btn btn-primary px-3">
                            <i class="fas fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                    ';
        } else {
            echo '
            <div class="col-lg-5 mb-30">
                <img class="w-100 h-100" src="./uploads/' . $r['image'] . '" alt="Image">
            </div>
    
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    
                    <h3>' . $r['name'] . '</h3>
                    <h3 class="font-weight-semi-bold mb-4">' . number_format($r['price'], 0, '', ',') . "đ" . '</h3>
    
                    <form method="post" class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <input type="number" class="form-control bg-secondary border-0 text-center" name="number" value="1">
                        </div>
                        <button type="submit" name="btn-add-cart"
                        class="btn btn-primary px-3" disabled>
                            hết Hàng
                        </button>
                    </form>
                    ';
        }

        ?>
    </div>
</div>
<!-- Shop Detail End -->



<?php include './footer.php' ?>