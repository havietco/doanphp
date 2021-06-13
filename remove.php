<?php 
    require_once __DIR__ . "/autoload.php";
    $key = getInput('id');
    unset($_SESSION['cart'][$key]);
      echo " <script>alert('  Xóa sản phẩm trong giỏ hàng thành công  !'); location.href='/gio-hang.php';</script>";
 ?>