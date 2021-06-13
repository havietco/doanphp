<?php
    $open = "product";
    require_once __DIR__. '/../../conn/conn.php';
    /**
    *
    * Danh sách danh mục sản phẩm
    *
    */
    $id = intval(getInput('id'));

    $editProduct = $db->fetchID("product",$id);
    if (empty($editProduct))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

    $category = $db->fetchAll("category");


    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data =
        [
            "name" => postInput('name'),
            "slug" => to_slug(postInput("name")),
            "category_id" => postInput("category_id"),
            "price" => postInput("price"),
            "content" => postInput("content")
        ];

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập tên đầy đủ danh mục";
        }

        if(postInput('category_id') == '')
        {
            $error['category_id'] = "Mời bạn chọn danh mục sản phẩm";
        }

        if (postInput('price') == '')
        {
            $error['price'] = "Mời bạn nhập giá sản phẩm";
        }

        if(postInput('content') == '')
        {
            $error['content'] = "Mô tả sản phẩm";
        }
       

        // $error trống thì không có lỗi
        if (empty($error))
        {
            if (isset($_FILES['thumbar']))
            {
                $file_name = $_FILES['thumbar']['name'];
                $file_tmp = $_FILES['thumbar']['tmp_name'];
                $file_type = $_FILES['thumbar']['type'];
                $file_error = $_FILES['thumbar']['error'];

                if ($file_error == 0 )
                {
                  $part = ROOT . "/product/";
                  $data['thumbar'] = $file_name;
                }
            }

            $update = $db->update("product",$data,array("id"=>$id));
            if ($update > 0 )
            {
              move_uploaded_file($file_tmp,$part.$file_name);
              $_SESSION['success'] = "Cập nhật sản phẩm thành công";
              redirectAdmin("product");
            }
            else
            {
              $_SESSION['error'] = "Cập nhật sản phẩm thất bại";
              redirectAdmin("product");
            }
        }

  }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm mới sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <i></i><a href="<?php echo base_url(); ?>admin/modules/product">Sản phẩm</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Thêm mới sản phẩm
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
              <div class="form-group"> <!-- Danh mục sản phẩm -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục sản phẩm : </label>
                    <div class="col-sm-8">
                      <select class="form-control col-md-8" name="category_id">
                        <option value=""> - Chọn danh mục sản phẩm - </option>
                        <?php foreach ($category as $item): ?>
                          <option value="<?php echo $item['id'] ?>" <?php echo $editProduct['category_id'] == $item['id'] ? "selected = 'selected' " : '' ?>><?php echo $item['name'] ?></option>
                        <?php endforeach ?>
                      </select>

                      <?php if (isset($error['category'])): ?>
                            <p class="text-danger"><?php echo $error['category'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                  <div class="form-group"> <!-- Thêm tên sản phẩm -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm : </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập danh mục cần thêm" name="name" value="<?php echo $editProduct['name'] ?>">
                      <?php if (isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                  <div class="form-group"> <!-- Thêm tên giá sản phẩm -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm : </label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" id="inputEmail3" placeholder="Nhập giá sản phẩm" name="price" value="<?php echo $editProduct['price'] ?>">
                      <?php if (isset($error['price'])): ?>
                            <p class="text-danger"><?php echo $error['price'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                  <div class="form-group"> <!-- Giá sale -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá : </label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control" id="inputEmail3" placeholder="10%" name="sale" value="0" value="<?php echo $editProduct[sale] ?>">
                    </div>
                  </div>

                  <div class="form-group"> <!-- Hình ảnh -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Hình ảnh </label>
                    <div class="col-sm-3">
                      <input type="file" class="form-control" id="inputEmail3" name="thumbar">
                      <?php if (isset($error['thumbar'])): ?>
                            <p class="text-danger"><?php echo $error['thumbar'] ?></p>
                        <?php endif ?>
                        <img src="<?php echo uploads() ?>product/<?php $editProduct['thumbar'] ?>" width="80px" height="80px">
                    </div>
                  </div>

                  <div class="form-group"> <!-- Content mô tả sản phẩm -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả sản phẩm </label>
                    <div class="col-sm-8">
                      <textarea class="form-control " name="content" rows="5"><?php echo $editProduct['content'] ?></textarea>
                      <?php if (isset($error['content'])): ?>
                            <p class="text-danger"><?php echo $error['content'] ?></p>
                        <?php endif ?>
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
