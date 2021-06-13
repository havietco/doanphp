<?php 
    @ob_start();
    session_start();
    require_once __DIR__. '/lib/database.php';
    require_once __DIR__. '/lib/function.php';
    require_once __DIR__. '/lib/Pagi.php';
    
    $db = new Database ;
    $pagi = new Pagi ;

    define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/doanephp/public/uploads/");
    
    $category = $db->fetchAll('category');

    /**
    *
    * lấy danh sách sản phẩm mới
    */

    $sqlNew = "SELECT * FROM product WHERE 1 ORDER BY ID DESC LIMIT 3";
    $productNew = $db->fetchsql($sqlNew);
?>