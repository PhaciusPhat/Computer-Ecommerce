<?php
include './header.php';

include('./models/User.php');
include('./models/Order.php');

$user = new User();
$order = new Order();

foreach ($user->get_user_by_username($_SESSION['user']) as $current_user) {
}

?>

<!--Order Start-->
<div class="table-responsive mb-5">
    <table class="table table-light table-borderless table-hover text-center mb-0">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Ngày mua hàng</th>
                <th>Giá tiền</th>
                <th>Xem hóa đơn</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            $i = 1;
            foreach ($order->get_order_by_userId($current_user['id']) as $order) {
                echo '
                    <tr>
                        <td>' . $i . '</td>
                        <td>' .  date('m/d/Y H:i:s', $order['create_date']) . '</td>
                        <td>' .  number_format($order['totalPrice'], 0, '', ',') . "đ" . '</td>
                        <td>
                            <a href="chitiethoadon.php?id=' . $order['id'] . '" class="btn btn-primary">Xem</a>
                        </td>
                    </tr>
                ';
                $i++;
            }
            ?>

        </tbody>
    </table>
</div>
<?php
include './footer.php'
?>