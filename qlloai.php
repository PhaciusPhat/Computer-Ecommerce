<?php
include('./admin_header.php') ?>

<body>

    <?php
    include('./models/Category.php');
    include('./utils/Validate.php');
    $validate = new Validate();
    $category = new Category();

    if (isset($_POST['btn-add-category'])) {
        $name = $_POST['name'];
        if ($validate->validate_name($name) == 0) {
            echo '<script>alert("Tên không hợp lệ")</script>';
        } else {
            $rs = $category->add_category($name);
            if ($rs == 1) {
                echo '<script>alert("Thêm thành công!");</script>';
                header('Location: qlloai.php');
            } else {
                echo '<script>alert("Thêm thất bại!");</script>';
                header('Location: qlloai.php');
            }
        }
    }

    ?>

    <!-- Modal -->
    <div class="modal fade" id="addCateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm Loại Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label>Loại Sản Phẩm</label>
                            <input class="form-control" name="name" type="text" placeholder="Nhập tên loại sản phẩm">
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success" name="btn-add-category">Thêm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row">
            <?php include './admin_nav.php' ?>
            <div class="col-lg-10 table-responsive p-0">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mã Loai</th>
                            <th>Tên Loại</th>
                            <th>Trạng thái</th>
                            <th>Xóa</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $categories = $category->get_all_category();
                        foreach ($categories as $category) {
                        ?>
                            <tr>
                                <td class="align-middle" name="id"><?php echo $category['id'] ?></td>
                                <td class="align-middle" name="name"><?php echo $category['name'] ?></td>
                                <td class="align-middle" name="disable"><?php echo $category['disable'] == 1 ? "khóa" : "bán"  ?></td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger" onclick="delete_category(<?php echo $category['id'] ?>,<?php echo $category['disable'] ?>)">
                                        <i class="fa fa-times"></i></button>
                                </td>
                                <td class="align-middle">
                                    <a href="updateCate.php?id=<?php echo $category['id'] ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <button style="position:absolute; " class="btn btn-sm btn-success mt-2 ml-2" data-toggle="modal" data-target="#addCateModal"><i class="fas fa-plus"></i></button>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->

</body>
<script>
    function delete_category(id, disable) {
        $.ajax({
            url: './deleteCate.php',
            type: 'POST',
            data: {
                id: id,
                disable: disable
            },
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    }
</script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<script src="js/main.js"></script>