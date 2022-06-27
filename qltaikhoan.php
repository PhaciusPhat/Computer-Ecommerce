<?php include('./admin_header.php') ?>

<?php
$user = new User();
?>

<body>
    <div class="container-fluid">
        <div class="row "> <?php include './admin_nav.php' ?>
            <div class="col-lg-10 table-responsive p-0">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Username</th>
                            <th>Họ Và Tên</th>
                            <th>E-mail</th>
                            <th>Số điện thoại</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $users = $user->get_all_user();
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['name'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['phone'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</body>
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