<?php include('./header.php') ?>
<?php
if (isset($_SESSION['user'])) {
    echo "<script>window.location.assign('trangchu.php')</script>";
}
require_once './models/User.php';
require_once './utils/Validate.php';
require_once './config/config.php';
$db = new Db();
$db->connect();
$validate = new Validate();
echo $validate->validate_username("");
if (isset($_POST['btn-regis'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    if ($password != $re_password) {
        echo '<script>alert("Mật khẩu không trùng nhau!");</script>';
    } else if (
        0 == $validate->validate_name($name)
        || 0 == $validate->validate_username($username)
        || 0 == $validate->validate_email($email)
        || 0 == $validate->validate_phone($phone)
        || 0 == $validate->validate_address($address)
        || 0 == $validate->validate_password($password)
    ) {
        echo '<script>alert("Dữ liệu không hợp lệ!");</script>';
    } else {
        $user = new User();
        $rs = $user->register($name, $email, $phone, $address, $username, $password);
        
        if($rs == 1) {
            echo '<script>alert("Đăng ký thành công!");</script>';
        } else{
            echo '<script>alert("Đăng ký thất bại!");</script>';
        }
    }
}
?>

<div class="col-lg-register-container">
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3 ml-4">Tạo Tài Khoản Mới</span></h5>
    <div class="bg-light p-30 mb-5">
        <form method="post" class="row" >
            <div class="col-md-6 form-group">
                <label>Họ và tên</label>
                <input class="form-control" name="name" type="text">
            </div>
            <div class="col-md-6 form-group">
                <label>Username</label>
                <input class="form-control" name="username" type="text">
            </div>

            <div class="col-md-6 form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="phone" type="number">
            </div>
            <div class="col-md-6 form-group">
                <label>E-mail</label>
                <input class="form-control" name="email" type="text">
            </div>

            <div class="col-md-6 form-group">
                <label>Mật khẩu</label>
                <input class="form-control" name="password" type="password">
            </div>
            <div class="col-md-6 form-group">
                <label>Địa chỉ</label>
                <input class="form-control" name="address" type="text">
            </div>

            <div class="col-md-6 form-group">
                <label>Nhập lại mật khẩu</label>
                <input class="form-control" name="re_password" type="password">
            </div>
            <div class="col-md-12 form-group">
                <div class="custom-control custom-checkbox">
                    <input type="submit" onclick="regis" name="btn-regis" class="btn btn-info" value="Đăng Ký">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function regis(e) {
        e.preventDefault();
        console.log(123)
    }
</script>
<?php include('./footer.php') ?>