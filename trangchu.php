<?php include './header.php' ?>
<?php include './carousel.php' ?>
<?php
include('./models/Product.php');
$product = new Product();
$products = $product->get_all_enable_product();
?>
<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Best Seller</span></h2>
    <div class="row px-xl-5">
        <?php
        foreach ($products as $product) {
        ?>
            <div class="col-xl-3 col-md-6 col-sm-6 pb-1">
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
<!-- Products End -->

<?php include './footer.php'; ?>