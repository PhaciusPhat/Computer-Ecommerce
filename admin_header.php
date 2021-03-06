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
    <div class="container-fluid bg-dark">
        <div class="row align-items-center py-3 px-xl-5 d-none d-lg-flex">
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
                    session_start();
                    include './models/User.php';
                    $user = new User();
                    if (isset($_SESSION['user'])) {

                        $find_user = $user->get_user_by_username($_SESSION['user']);
                        foreach ($find_user as $key => $value) {
                            $role = $value['role'];
                        }
                        if ($role == 0) {
                            echo "<script>window.location.assign('trangchu.php')</script>";
                        }
                        echo '<button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown">Xin ch??o ' . $_SESSION['user'] . '</button>';
                        echo ' <div class="dropdown-menu">
                            <a class="dropdown-item" href="trangchu.php">Trang ch???</a>
                            <a class="dropdown-item" href="dangxuat.php">????ng xu???t</a>
                        </div>';
                    } else {
                        echo "<script>window.location.assign('trangchu.php')</script>";
                        echo '
                            <button type="button" class="btn-sm btn btn-dark dropdown-toggle" data-toggle="dropdown">????ng nh???p</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="dangnhap.php">????ng nh???p</a>
                                <a class="dropdown-item" href="dangky.php">????ng k??</a>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


</body>