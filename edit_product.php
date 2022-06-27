<?php include './admin_header.php' ?>

<?php
include('./models/Product.php');
include('./models/Category.php');
include('./utils/Validate.php');

$product = new Product();
$validate = new Validate();
$category = new Category();
$id = $_GET['id'];
$rs = $product->get_product_by_id($id);
foreach ($rs as $r) {
    $_SESSION['update_pro'] = $r;
}
if (isset($_POST['btn-update-product'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $cateId = $_POST['cateId'];

    $updateImg = false;
    if (
        $validate->validate_name($name) == 0
        || $validate->validate_number($number) == 0
        || $validate->validate_price($price) == 0
    ) {
        echo '<script>alert("Thông tin không hợp lệ")</script>';
    } else {
        if ($image != '') {
            $updateImg = true;
            $target_dir = "uploads/";
            $target_path = basename(strtotime("now") . "_" . $_FILES["image"]["name"]);
            $target_file = $target_dir . $target_path;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo '<script>alert("Thông tin không hợp lệ")</script>';
            }
        } else {
            $image = $_SESSION['update_pro']['image'];
        }
        $rs = $product->update_product($id, $name, $number, $price, $image,  $cateId);
        if ($rs == 1) {
            if ($updateImg)  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            echo '<script>alert("Cập nhật thành công!");</script>';
            header('Location: qlsanpham.php');
        } else {
            echo '<script>alert("Cập nhật thất bại!");</script>';
            header('Location: qlsanpham.php');
        }
    }
}
?>



<div class="container-fluid">
    <div class="row">
        <?php include './admin_nav.php' ?>
        <div class="col-lg-10 table-responsive p-5">
            <form action="" method="post" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label>Sản Phẩm</label>
                            <input class="form-control" name="name" type="text" placeholder="Nhập tên sản phẩm" value="<?php echo $r['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input class="form-control" name="number" type="number" value="<?php echo $r['number'] ?>" placeholder="Nhập Số lượng sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input class="form-control" name="price" type="number" value="<?php echo $r['price'] ?>" placeholder="Nhập Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Loại Sản Phẩm</label>
                            <select class="form-control" name="cateId">
                                <?php
                                $categories = $category->get_all_category();
                                foreach ($categories as $category) {
                                    if ($category['id'] == $r['cateId']) {
                                ?>
                                        <option value="<?php echo $category['id'] ?>" selected><?php echo $category['name'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hình Ảnh</label>
                            <input name="image" type="file">
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success" name="btn-update-product">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>