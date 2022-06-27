<?php

include './header.php' ?>



<?php
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.assign('trangchu.php')</script>";
}
include './utils/Validate.php';
include './models/Cart.php';
include './models/User.php';
include './models/Product.php';
$user = new User();
$validate = new Validate();
$cart = new Cart();
$cart_list = $cart->get_cart();
foreach ($user->get_user_by_username($_SESSION['user']) as $current_user) {
}
?>

<!-- Cart Start -->
<form class="container-fluid" method="post">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số lượng</th>
                        <th>Thành Tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="align-middle ">
                    <?php
                    $total = 0;
                    $productAndNumberList = array();
                    // array_push($productAndNumberList, 
                    // array(1,2));
                    // foreach($productAndNumberList as $xn){
                    //     echo $xn[1];
                    // }   


                    foreach ($cart_list as $c) {
                        if ($c['userId'] == $current_user['id']) {
                            $product = new Product();
                            $rs = $product->get_product_by_id($c['productId']);
                            foreach ($rs as $r) {
                                $total += $r['price'] * $c['number'];

                                echo '
                                    <tr>
                                        <td>
                                            <img class=""  style="width: 4rem" src="./uploads/' . $r['image'] . '" alt="Image">
                                            <span class="ml-2">' . $r['name'] . '</span>
                                        </td>
                                        <td class="price-product' . $r['id'] . '">' . number_format($r['price'], 0, '', ',') . "đ"  . '</td>
                                        <td>
                                                <input min="1"
                                                type="number" id=' . $r['id'] . '
                                                onchange="change(this.value, this.id, ' . $r['price'] . ')" name="number" 
                                                class="number-product form-control" value="' . $c['number'] . '">
                                            
                                        </td> 
                                        <td><p class="totalMoneyForProduct" 
                                        id=productPrice_' . $r['id'] . '>' . number_format($r['price'] * $c['number'], 0, '', ',') . "đ" . '</p></td>
                                        <td>
                                            <a href="delete_cart.php?userId=' . $current_user['id'] . '&productId=' . $r['id'] . '" name="btn-delete-cart" class=" btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                            ';
                            }
                        }
                    }
                    ?>


                </tbody>
            </table>
        </div>
        <div class="col-lg-4">

            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Đơn hàng của bạn</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tổng cộng</h6>
                        <h6 id="totalMoneyForProducts">
                            <?php echo number_format($total, 0, '', ',') . "đ" ?>
                        </h6>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" id="order-address" class="form-control border-0 p-4" placeholder="Địa chỉ">

                </div>
                <div class="pt-2">
                    <button type="button" onclick="order()" name="btn-order" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Cart End -->
<?php include 'footer.php'; ?>
<script>
    ;

    const updateTotalMoneyForCart = () => {
        console.log(document.getElementById('totalMoneyForProducts').innerText)
        let totalMoneyForCart = 0;
        document.querySelectorAll('.totalMoneyForProduct').forEach(element => {
            totalMoneyForCart += parseInt(element.innerText.replace(/\D/g, ''));
        });

        document.getElementById('totalMoneyForProducts').innerText = totalMoneyForCart.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ";

    }


    const change = (value, id, price) => {
        const totalPrice = (value * price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        const productPrice = document.getElementById(`productPrice_${id}`);
        productPrice.innerHTML = totalPrice + "đ"
        updateTotalMoneyForCart()
    };

    const order = () => {
        let arr = [];
        document.querySelectorAll('.number-product').forEach(element => {
            let productId = element.id;
            let number = element.value;
            let productPrice = document.getElementsByClassName(`price-product${productId}`)[0].innerText;
            productPrice = parseInt(productPrice.replace(/\D/g, ''))
            const temparr = [productId, number, productPrice]
            arr.push(temparr)
        });
        console.log(arr)
        arr = JSON.stringify(arr);
        const address = document.getElementById('order-address').value;
        $.ajax({
            url: './order.php',
            type: 'POST',
            data: {
                arr: arr,
                address: address
            },
            success: function(data) {
                console.log(data)
                alert(data);
                window.location.reload();
            }
        });
    }
</script>