<?php
    $open = "slide";
    require_once __DIR__. '/../../conn/conn.php';
    
    $id = intval(getInput('id'));

    $slide = $db->fetchID("slide",$id);
    if (empty($slide))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("slide");
    }

    $category = $db->fetchAll("category");
    $data =
        [
            "name" => postInput('name'),
            "url" => postInput("url"),
        
        ];

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập tên đầy đủ danh mục";
        }
        if(postInput('url') == '')
        {
            $error['url'] = "url không được để trống";
        }
        
       


        
        // $error trống thì không có lỗi

        if (empty($error))
        {
            if (isset($_FILES['file']))
            {
                $file_name = $_FILES['file']['name'];
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_type = $_FILES['file']['type'];
                $file_error = $_FILES['file']['error'];

                if ($file_error == 0 )
                {
                    $part = ROOT . "/slide/";
                    $data['image'] = $file_name;
                }
            }
            
            $up = $db->update("slide",$data,array("id"=>$id));
            if($up > 0)
            {   
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Update  thành công";
                redirectAdmin("slide");
            }
            else
            {
                redirectAdmin("slide");
                $_SESSION['error'] = "Update  thất bại";

            }
            
        }
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Cap nhat slide 
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php base_url() ?>admin/index.php">Bảng điều khiển</a>
                </li>
                <li>
                    <i></i><a href="<?php echo base_url(); ?>admin/modules/admin">slide</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Thêm mới slide
                </li>
            </ol>
            <div class="clearfix"></div>
            <?php if(isset($_SESSION['error'])) :?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                </div>
            <?php endif ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                 <div class="form-group"> <!-- Họ tên -->
                    <label for="inputEmail3" class="col-sm-2 control-label"> Tên  : </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputEmail3" placeholder=" name " name="name" value="<?php echo $slide['name'] ?>">
                      <?php if (isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>
                  <div class="form-group"> <!-- Họ tên -->
                    <label for="inputEmail3" class="col-sm-2 control-label"> Url   : </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputEmail3" placeholder=" url  " name="url" value="<?php echo $slide['url'] ?>">
                      <?php if (isset($error['url'])): ?>
                            <p class="text-danger"><?php echo $error['url'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>
                  <div class="form-group"> <!-- Họ tên -->
                    <label for="inputEmail3" class="col-sm-2 control-label"> File  : </label>
                    <div class="col-sm-4">
                        <input type="file" name="file" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                      <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                  </div>
            </form>
        </div>
    </div>
    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/../../themes/footer.php'; ?>
