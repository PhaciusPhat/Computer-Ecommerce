<?php include('./admin_header.php') ;
include('./models/Order.php');

$user = new User();
$order = new Order();
?>



<div class="container-fluid">
    <div class="row">
        <?php include './admin_nav.php'?>
        <div class="col-lg-10 table-responsive p-0">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã Hóa Đơn</th>
                        <th>Mã Khách Hàng</th>
                        <th>Tên Khách Hàng</th>
                        <th>Ngày Xuất</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    foreach ($order->get_all_order() as $order) {
                        $rsFind = $user->get_user_by_id($order['userId']);
                        foreach ($rsFind as $u) {
                            echo '
                                <tr>
                                    <td>' . $order['id'] . '</td>
                                    <td>' . $u['id'] . '</td>
                                    <td>' . $u['name'] . '</td>
                                    <td>' . date('m/d/Y H:i:s', $order['create_date']) . '</td>
                                    <td>' . number_format($order['totalPrice'], 0, '', ',') . "đ" . '</td>
                                    <td>
                                        <a href="quanlichitiethoadon.php?id=' . $order['id'] . '" class="btn btn-primary">Xem</a>
                                    </td>
                                </tr>
                            ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


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