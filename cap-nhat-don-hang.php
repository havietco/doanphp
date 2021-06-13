<?php
    require_once __DIR__ . "/autoload.php";
    /**
     *  xử lý giỏ hàng
     */
    $qty     = postInput('qty');
    $key     = postInput('key');

    // echo $idqty .$idproduct;
    $flag = 1;
    $product = $db->fetchID("product",$key);
    $_SESSION['cart'][$key]['qty'] = $qty;
    echo 1;
?>