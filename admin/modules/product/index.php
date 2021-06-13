<?php
    $open = "product";
    
    require_once __DIR__. '/../../conn/conn.php';


    if(isset($_GET['page']))
    {
        $trang = $_GET['page'];
    }
    else
    {
        $trang = 1;
    }

    $sql = "SELECT product.*, category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id ";
    $product = $db->fetchJone('product',$sql,$trang,2,true);


    if(isset($product['page']))
    {
        $sotrang = $product['page'];
        unset($product['page']);
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Danh sách danh mục
                <a class="btn btn-success" href="add_product.php">Thêm mới</a>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>admin">Bảng điều khiển</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Sản phẩm
                </li>
            </ol>
            <!-- Thông báo không lỗi -->
            <?php if(isset($_SESSION['success'])) :?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
                </div>
            <?php endif ; ?>
            <!-- Thông báo lỗi  -->
            <?php if(isset($_SESSION['error'])) :?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                </div>
            <?php endif ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Category</th>
                                        <th>Hình ảnh</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Nội dung</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1; foreach ($product as $item): ?>
                                        <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $item['namecate'] ?></td>
                                        <td><img src="<?php echo uploads() ?>product/<?php echo $item['thumbar'] ?>" width="80px" height="80px"></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo $item['slug'] ?></td>
                                        <td><?php echo $item['content'] ?></td>                                        
                                        <td>
                                            <a class="btn btn-xs btn-success" href="edit_product.php?id=<?php echo $item['id'] ?>">Sửa</a> 
                                            <a class="btn btn-xs btn-danger" href="delete_product.php?id=<?php echo $item['id'] ?>">Xóa</a>
                                        </td>
                                    </tr>  
                                    <?php $stt++ ; endforeach ?>
                                                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                <nav aria-label="Page navigation">
                    <?php if($sotrang > 1) :?>
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>  
                        <?php for( $i = 1 ; $i <= $sotrang ; $i ++ )  :?>
                            <li class="<?= $i == $_GET['page'] ? 'active' : ''?>">
                                <a href="?page=<?= $i ?>"> <?= $i ?></a>
                            </li>
                        <?php endfor ;?>
                        <li> 
                        <a href="" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                  <?php endif ; ?>
                </nav>
            </div>
    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/../../themes/footer.php'; ?>
