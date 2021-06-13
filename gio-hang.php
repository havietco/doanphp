<?php
    require_once __DIR__ . "/autoload.php";
    /**
     *  xử lý giỏ hàng
     */
     if( ! isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
    {
         echo " <script>alert('Không tồn tại giỏ hàng hoạc  ko có sản phẩm nào trong giỏ hàng !'); location.href='/';</script>";
    }
    $_SESSION['sum']  = 0;
?>

<style type="text/css">
    .btn:hover { cursor: pointer !important;color: white !important }
    .btn {color: white !important }
</style>
<?php
    require_once __DIR__. '/conn/conn.php'; 
    $sqlHome = "SELECT name , id FROM category WHERE home = 1 ";
    $categoryHome = $db->fetchsql($sqlHome);

    $data = [];

    foreach ($categoryHome as $item) {
        $cateID = intval($item['id']);
        $sql = "SELECT * FROM product WHERE category_id = $cateID"; 
        $productHome = $db->fetchsql($sql);
        $data[$item['name']] = $productHome;
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = 
        [
            'user_name' => postInput('user_name'),
            'email'     => postInput('user_email'),
            'address'   => postInput('user_address'),
            'phone'     => postInput('user_phone'),
            'message'   => postInput('message'),
            'amount'    => $_SESSION['sumtotal']
        ];
        $id_transaction = $db->insert("transaction",$data);
        if($id_transaction)
        {
            foreach($_SESSION['cart'] as $m => $l)
            {
                $data2 = [
                    'productid'     => $m,
                    'transactionid' => $id_transaction,
                    'qty'           => $l['qty']
                ];
                $id_instart2 = $db->insert("orders",$data2);
                if($id_instart2) unset($_SESSION['cart']);
                echo " <script>alert(' Xác nhận thanh toán thành công  !'); location.href='/';</script>";
            }
        }
    }
 ?>
<?php require_once __DIR__. '/themes/header.php'; ?>
    <!-- New Arrivals -->

<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                 <h5> </h5> 
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"> Danh sách giỏ hàng</div>
                    
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th> Tên Sản Phẩm </th>
                                <th> Hình Ảnh </th>
                                <th> Giá </th>
                                <th> Số Lượng </th>
                                <th> Thành Tiền </th>
                                <th> Thao Tác </th>
                            </tr>
                        
                        </thead>
                        <tbody>
                          
                            <?php $i = 1;foreach($_SESSION['cart'] as $key => $val) :?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td>
                                    <img src="<?php echo base_url() ?>public/uploads/product/<?php echo $val['thumbar'] ?>" alt="" width="50px" height="50px">
                                </td>
                                <td><?php echo $val['name'] ?></td>
                                <td><?php echo ( $val['price']) ?> đ</td>
                                <td>
                                    <input type="number" name="" value="<?php echo $val['qty'] ?>" class="form-control" style="width: 60px;" id="qty" min="1" max="10">
                                </td>
                                <td><?php echo ($val['price']*$val['qty']) ?> đ</td>
                                <td>
                                    <a class="btn btn-xs btn-danger" href="remove.php?id=<?= $key ?>" data-id="<?php echo $key ?>" > Remove </a>
                                    <a class="btn btn-xs btn-info updatecarts" data-key="<?php echo $key ?>"> Update </a>
                                </td>
                            </tr>
                            <?php $_SESSION['sum'] += $val['qty']*$val['price'] ?>
                            <?php $i++ ;endforeach ; ?>
                            <tr>
                                <td> Thành tiền </td>
                                <td> Tổng tiền :  <span class="badge"><?php echo ($_SESSION['sum']) ?> đ</span></td>
                                <td>  <span class="badge"> 10 %  đ</span>Thuế VAT </td>
                                <td>
                                    Thành tiền 
                                     <?php $_SESSION['sumtotal']  = ceil($_SESSION['sum']*110/100) ?>
                                    <span class="badge"><?php echo ceil($_SESSION['sum'] * 110/100) ?> đ</span>
                            
                                </td>
                                <td colspan="3"> <a href="/" class="btn btn-success"> Tiếp tục mua hàng </a> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                  <form class="form-horizontal" method="post" action="">
                
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-success">
                        <div class="panel-heading">Thông tin khách hàng </div>
                        <div class="panel-body">
                            
                            <div class="form-group">
                                <div class="col-md-12"><strong>Họ và Tên :</strong></div>
                                <div class="col-md-12">
                                    <input type="text" readonly class="form-control" name="user_name" value="" required=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12">
                                    <strong> Số điện thoại </strong>
                                    <input type="number"  readonly name="user_phone" class="form-control" value="" required=""/>
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-12  col-xs-12">
                                    <strong>Email </strong>
                                    <input type="email" readonly name="user_email" class="form-control" value="" required=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><label>Địa chỉ:</label></div>
                                <div class="col-md-12">
                                    <input type="text" readonly name="user_address" class="form-control" value="" required="" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12"><strong> Ghi chú </strong></div>
                                <div class="col-md-12">
                                    <textarea name="message" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    
                </div>
                <div class=" col-md-4 clearfix col-md-offset-10">
                    <input type="submit" name="" class="btn btn-success" value=" Xác nhận thanh toán ">
                </div>
            </form>
            </div>
            
        </div>
    </div>
   
</div>

<?php require_once __DIR__. '/themes/footer.php'; ?>


<script type="text/javascript">
    // cập nhật giỏ hàng
    $url = '/gio-hang.php';
    $(function(){
        $updatecarts = $(".updatecarts");
        $updatecarts.click(function(){
            $key = $(this).attr("data-key");
            $qty = $(this).parents('tr').find("#qty").val();
            $.ajax({
                url:'cap-nhat-don-hang.php',
                type:"post",
                data:{'qty':$qty,'key':$key},
                 success:function(data)
                {
                    console.log(data);
                   if(data == 1)
                   {
                        // $string = " <div class='alert alert-success'>  Cập nhật thành công </div>"; 
                        // $alertcart.html($string);
                        alert(' Cập nhật thành công!'); location.href=$url;
                   }
                   else
                   {
                         alert(' Cập nhật thất bại !'); location.href=$url;

                   }
                }
            })
        })
    })
</script>