<?php
    require_once __DIR__ . "/autoload.php";
    /**
     *  xử lý giỏ hàng
     */
    $idproduct     = getInput('id');
  
    if($idproduct)
        {
            $product = $db->fetchID("product",$idproduct);
            //ktra nếu số lượng sp bé hơn qty thì thông báo 
            if(isset($_SESSION['cart'][$idproduct]))
            {
                if ( $product['price'] > 0)
                {
                    $price = $product['price'] * (100 - $product['sale'] ) /  100  ;
                }
                $name    = $product['name'];
                $price   = $product['price'];
                $thunbar = $product['thumbar'];
                $check   = $_SESSION['cart'][$idproduct]['qty'] + 1;
                $_SESSION['cart'][$idproduct]['qty']     = $check;
                $_SESSION['cart'][$idproduct]['name']    = $name;
                $_SESSION['cart'][$idproduct]['price']   = $price; 
                $_SESSION['cart'][$idproduct]['thumbar'] = $thunbar;
            }
            else
            {
                $qty     = 1;
                $name    = $product['name'];
                $price   = $product['price'];
                $thunbar = $product['thumbar'];

                $_SESSION['cart'][$idproduct]['qty']     = $qty;
                $_SESSION['cart'][$idproduct]['name']    = $name;
                $_SESSION['cart'][$idproduct]['price']   = $price; 
                $_SESSION['cart'][$idproduct]['thumbar'] = $thunbar;
                $flag = 1;        
               
            }
        }
     echo " <script>alert(' Thêm giỏ hàng thành công !'); location.href='/';</script>";
    
?>