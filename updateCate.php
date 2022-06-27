<?php include './admin_header.php' ?>

<?php
include('./models/Category.php');
include('./utils/Validate.php');
$validate = new Validate();
$category = new Category();
$id = $_GET['id'];
$rs = $category->get_category_by_id($id);
foreach ($rs as $r) {
    $_SESSION['update_cate'] = $r;
}
if(isset($_POST['btn-update-category'])){
    $name = $_POST['name'];
    if($validate->validate_name($name) == 0){
        echo '<script>alert("Tên không hợp lệ")</script>';
    }else{
        $rs = $category->update_category($id, $name);
        if($rs == 1){
            echo '<script>alert("Cập nhật thành công!");</script>';
            header('Location: qlloai.php');
        }else{
            echo '<script>alert("Cập nhật thất bại!");</script>';
            header('Location: qlloai.php');
        }
    }
}
?>



<div class="container-fluid">
    <div class="row">
        <?php include './admin_nav.php' ?>
        <div class="col-lg-10 table-responsive p-5">
            <form method="post" class="form-group p-5">
                <label for="">Tên loại sản phẩm </label>
                <input type="text" name="name" id="" class="form-control" value="<?php echo $r['name'] ?>" />
                <button type="submit" class="btn btn-success mt-2" name="btn-update-category">Cập nhật</button>
            </form>
        </div>
    </div>
</div>