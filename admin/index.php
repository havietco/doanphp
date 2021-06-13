<?php 
    require_once __DIR__. '/conn/conn.php';
   
 ?>

<?php require_once __DIR__. '/themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Trang Quản Trị Website.
                <small>Administrator</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>admin">Bảng điều khiển</a>
                </li>
                
            </ol>
        </div>
    </div>
    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/themes/footer.php'; ?>
