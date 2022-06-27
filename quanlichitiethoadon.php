<?php include './admin_header.php';

include('./models/Order.php');
include('./models/Product.php');

$order = new Order();
$product = new Product();

$id = $_GET['id'];
$rsOrder = $order->get_order_by_id($id);
?>

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row">
        <?php include './admin_nav.php' ?>
        <div class="col-lg-10 table-responsive p-0">
            <div class="table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $i = 1;
                        $totalPrice = 0;
                        foreach ($rsOrder as $or) {
                            $totalPrice += $or['price'] * $or['number'];
                            $productName = $product->get_product_by_id($or['productId']);
                            foreach ($productName as $pr) {
                                echo '
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $pr['name'] . '</td>
                            <td>' . $or['number'] . '</td>
                            <td>' . number_format($or['price'], 0, '', ',') . "đ" . '</td>
                            <td>' . number_format($or['price'] * $or['number'], 0, '', ',') . "đ" . '</td>
                        </tr>
                    ';
                            }
                            $i++;
                        }
                        echo '<tr>
                <td class="align-middle">Tổng Cộng</td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle"></td>
                <td class="align-middle">' . number_format($totalPrice, 0, '', ',') . "đ" . '</td>

            </tr>'
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->