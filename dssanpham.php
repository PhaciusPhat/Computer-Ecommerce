<?php include './header.php' ?>
<?php

include('./models/Product.php');
$product = new Product();
$cateId = $_GET['cateId'] ?? null;
if ($cateId) {
    $products = $product->get_all_product_by_cate_id($cateId);
} else {
    $products = $product->get_all_enable_product();
}
?>
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3 ml-2">loại sản phẩm</span></h5>
            <div class="bg-light p-4 mb-30 d-flex flex-column align-item-center text-center">
                <a href="dssanpham.php">Tất cả</a>
                <?php
                foreach ($categories as $category) {
                ?>
                    <a href="dssanpham.php?cateId=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- Price End -->
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="./uploads/<?php echo $product['image'] ?>" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="chitietsanpham.php?id=<?php echo $product['id'] ?>"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="chitietsanpham.php?id=<?php echo $product['id'] ?>"><?php echo $product['name'] ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <?php echo number_format($product['price'], 0, '', ',') . "đ";  ?>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<?php include 'footer.php'; ?>