<?php
    $open = "product";

    require_once __DIR__. '/../../conn/conn.php';

    $id = intval(getInput('id'));

    $slide = $db->fetchID("slide",$id);

    if (empty($slide))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("slide");
    }

    $num = $db->delete("slide",$id);
    if ($num > 0 )
    {
        $_SESSION['success'] = "Xóa thành công";
        redirectAdmin("slide");
    }
    else
    {
        $_SESSION['error'] = "Xóa thất bại";
        redirectAdmin("slide");
    }

 ?>
