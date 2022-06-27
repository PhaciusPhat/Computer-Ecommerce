<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>405Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="trangchu.php" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">405</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
            </div>
            <div class="col-lg-4 col-6 text-right">
                <div class="btn-group">
                    <?php
                    include './models/Category.php';
                    if (isset($_SESSION['user'])) {
                        echo '<button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Xin chào ' . $_SESSION['user'] . '</button>';
                        echo ' <div class="dropdown-menu">
                            <a class="dropdown-item" href="trangchu.php">Trang chủ</a>
                            <a class="dropdown-item" href="dangxuat.php">Đăng xuất</a>
                        </div>';
                    } else {
                        echo '
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Đăng nhập</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="dangnhap.php">Đăng nhập</a>
                                <a class="dropdown-item" href="dangky.php">Đăng ký</a>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Danh mục</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <?php
                        $category = new Category();
                        $categories = $category->get_all_category();
                        foreach ($categories as $cate) {
                            echo '<a class="nav-item nav-link text-dark" href="dssanpham.php?cateId=' . $cate['id'] . '">' . $cate['name'] . '</a>';
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">405</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="trangchu.php" class="nav-item nav-link ">Trang chủ</a>
                            <a href="dssanpham.php" class="nav-item nav-link">Sản phẩm</a>
                            <?php
                            if (isset($_SESSION['user'])) {
                                echo ' <a href="dshoadon.php" class="nav-item nav-link">Lịch sử đơn hàng</a>';
                            }
                            ?>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="giohang.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Navbar End -->
</body>