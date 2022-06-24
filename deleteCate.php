<?php 
    include('./models/Category.php');
    $id=$_POST['id'];
    $disable=$_POST['disable'];
    
    $category = new Category();
    $rs = $category->delete_category($id, $disable == 1 ? 0 : 1);
    if ($rs == 1) {
        echo 'Xóa thành công!';
        // header('Location: qlloai.php');
    } else {
        echo 'Xóa thất bại!';
        // header('Location: qlloai.php');
    }
?>