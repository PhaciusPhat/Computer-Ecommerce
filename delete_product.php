<?php 
    include('./models/Product.php');
    $id=$_GET['id'];
    $product = new Product();
    $prducts = $product->get_product_by_id($id);
    $temp;
    foreach ($prducts as $prduct) {
        $temp = $prduct;
    }
    // echo $temp['isDisable'];   
    $rs = $product->delete_product($id, $temp['isDisable'] == 1 ? 0 : 1);
    if ($rs) {
        header('Location: qlsanpham.php');
    } else {
        echo '<script>alert("Có lỗi xảy ra")</script>';
        header('Location: qlsanpham.php');
    }
?>