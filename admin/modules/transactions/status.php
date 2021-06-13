<?php
    $open = "transactions";
    
    require_once __DIR__. '/../../conn/conn.php';

   $id = intval(getInput('id'));

    $transaction = $db->fetchID("transaction",$id);
    $status = $transaction['status'] == 0 ? 1 : 0;

    $up = $db->update('transaction',array('status' => $status),array("id"=>$id));
    $_SESSION['success'] = " Cập nhật thành công ";
    redirectAdmin("transactions");
 ?>