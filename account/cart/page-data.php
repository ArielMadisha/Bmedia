<?php

require_once '../../template/php/config.php';

if (loggedIn()) {
    $checkout_btns = '';
    $cart_total = 0;
    $empty_cart = '';
	
	 if($_POST['cancel'] && $_POST['cancel'] ==1)
     {
    echo <<<MSG
    <div class="alert alert-info" role="alert">
    Your transaction has returned with status: User Cancelled.
    
    <a href="https://bmedia.online">Homepage</a>, <a href="https://bmedia.online/account/">My Account</a> or <a href="https://bmedia.online/contact/">Contact Us</a>
    </div>
MSG;
}

    echo <<<BTNS
<!-- <h2 class="tittle" style="text-align:center">Cart</h2> -->
                    <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-white text-center">#</th>
                            <th class="text-white">Item</th>
                            <th class="text-white">Type</th>
                            <th class="text-white">Price (inc VAT)</th>
                        </tr>
                    </thead> 
            <tbody>
BTNS;

    $uid = '';
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    }

    $query = "SELECT * FROM cart WHERE `user_id` = '$uid'";
    $results = mysqli_query($connection, $query) or die('{"error" : "Error 1021!"}');

    if (mysqli_num_rows($results) > 0) {
        $row_number = 1;
        while ($row = mysqli_fetch_assoc($results)) {
            extract($row);

            $remove_item_btn = '<button id="rem__item_' . $item_id . '" onclick="cart_remove_item(\'' . $item_id . '\')" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';

            $row_id = '';
            $cart_total += $cost;

            echo <<<A
        <tr id="$row_id">
        <td style="text-align: center;" class="text-white">$remove_item_btn</td>
        <td class="text-white">$item_name</td>
        <td class="text-white">$item_type</td>
        <td class="text-white">$cost</td>
        </tr>
A;
            $row_number++;
        }

        $checkout_btns = '<div style="text-align: right;margin-right: 24px;color:white;">Total: <span style="margin-bottom: 15px">R' .
            $cart_total . '</span><br>
<button type="button" id="empty_cart" onclick="empty_cart(\'' . $uid . '\')" class="btn btn-default">Empty Cart</button>
<button id="checkout_cart" onclick="checkout()" class="btn btn-primary">Checkout</button>
</div>';
    } else {
        $empty_cart = '<h2 class="tittle text-white" style="text-align:center">Your cart is empty!</h2>';
    }

    echo <<<A
</tbody>
</table>
</div>

$empty_cart

$checkout_btns
A;
} else {
    require '../../template/php/require_login.php';
}
