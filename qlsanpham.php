<?php include './admin_header.php' ?>

<?php
include('./models/Category.php');
include('./models/Product.php');
include('./utils/Validate.php');

$validate = new Validate();
$category = new Category();
$product = new Product();

if (isset($_POST['btn-add-product'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $cateId = $_POST['cateId'];
    $target_dir = "uploads/";
    $target_path =  $_FILES["image"]["name"];
    $target_file = $target_dir . $target_path;
    echo "<script>console.log('$target_file')</script>";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (
        $validate->validate_name($name) == 0
        || $validate->validate_number($number) == 0
        || $validate->validate_price($price) == 0
        || $image == '' || $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo '<script>alert("Thông tin không hợp lệ")</script>';
    } else {
        $rs = $product->add_product($name, $number, $image,  $price, $cateId);
        if ($rs == 1) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            echo '<script>alert("Thêm thành công!");</script>';
            header('Location: qlsanpham.php');
        } else {
            echo '<script>alert("Thêm thất bại!");</script>';
            header('Location: qlsanpham.php');
        }
    }
}
?>

<body>
    <!-- Modal -->
    <div class="modal fade" id="addProModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <input class="form-control" name="name" type="text" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input class="form-control" name="number" type="number" placeholder="Nhập Số lượng sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input class="form-control" name="price" type="number" placeholder="Nhập Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Loại Sản Phẩm</label>
                            <select class="form-control" name="cateId">
                                <?php
                                $categories = $category->get_all_category();
                                foreach ($categories as $category) {
                                ?>
                                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hình Ảnh</label>
                            <input name="image" type="file" placeholder="Nhập tên sản phẩm">
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success" name="btn-add-product">Thêm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row ">
            <?php include './admin_nav.php' ?>
            <div class="col-lg-10 table-responsive p-0">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $products = $product->get_all_product();
                        foreach ($products as $product) {
                        ?>
                            <tr>
                                <td><?php echo $product['name'] ?></td>
                                <td><?php echo $product['number'] ?></td>
                                <td>
                                    <?php
                                    if ($product['isDisable'] == 1) {
                                        echo 'Không bán';
                                    } else {
                                        echo 'bán';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $product['id'] ?>" class="btn btn-info">Sửa</a>
                                    <a href="delete_product.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                    <button style="position:absolute; " data-toggle="modal" data-target="#addProModal" class="btn btn-sm btn-success mt-2 ml-2"><i class="fas fa-plus"></i></button>
                </table>
            </div>
        </div>

    </div>
    </div>
    <!-- Cart End -->





    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>