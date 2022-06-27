<?php

include './header.php';
if (isset($_SESSION['user'])) {
    echo "<script>window.location.assign('trangchu.php')</script>";
}
?>
<?php



require_once './models/User.php';
require_once './utils/Validate.php';


$validate = new Validate();
if (isset($_POST['btn-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new User();
    if (
        0 == $validate->validate_username($username)
        || 0 == $validate->validate_password($password)
    ) {
        echo '<script>alert("Dữ liệu không hợp lệ!");</script>';
    } else {
        $rs = $user->login($username, $password);

        if ($rs == 1) {
            $_SESSION['user'] = $username;
            echo "<script>window.location.assign('qlhoadon.php')</script>";
        } else {
            echo '<script>alert("Đăng nhập thất bại!");</script>';
        }
    }
}
?>



<section class="shop_grid_area section_padding_50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title_signin">
                    <h4>
                        <hr>Đăng nhập
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-12_signin">
            <form method="post">
                <input type="text" id="name" name="username" placeholder="Tên đăng nhập"><br>
                <input type="password" id="matkhau" name="password" placeholder="Mật khẩu"><br>
                <input type="submit" name="btn-login" value="Đăng nhập">
            </form>
        </div>
    </div>
</section>
