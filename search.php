<?php
    require_once __DIR__ .'/autoload.php';
    $keyword = getInput('keyword');
   
    $sqlProduct = "SELECT product .* FROM product WHERE 1 ";
    if($keyword != null )
    {
        $sqlProduct .= " AND name LIKE  '%$keyword%' ";
    }else
    {

    }
    $kq = $db->fetchsql($sqlProduct);
    $total = count($kq);
     if (isset($_GET['page']))
    {
        $page = intval($_GET['page']);
    }else
    {
        $page = 1;
    }
    $product = $db->fetchJonePagi('product',$sqlProduct,$total,$page,10,$pagi = true );
    
    if(isset($product['page']))
    {
        $sotrang =  $product['page'];
        unset($product['page']); 
    }

    $path = $_SERVER['SCRIPT_NAME'];
?>

<?php   require_once __DIR__ .'/layouts/header.php'; ?>
    <!-- Hamburger Menu -->

    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">
                <li class="menu_item has-children">
                    <a href="#">
                        usd
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">cad</a></li>
                        <li><a href="#">aud</a></li>
                        <li><a href="#">eur</a></li>
                        <li><a href="#">gbp</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        English
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">German</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        My Account
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                    </ul>
                </li>
                <li class="menu_item"><a href="#">home</a></li>
                <li class="menu_item"><a href="#">shop</a></li>
                <li class="menu_item"><a href="#">promotion</a></li>
                <li class="menu_item"><a href="#">pages</a></li>
                <li class="menu_item"><a href="#">blog</a></li>
                <li class="menu_item"><a href="#">contact</a></li>
            </ul>
        </div>
    </div>

    <div class="container product_section_container">
        <div class="row">
            <div class="col product_section clearfix">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="/"><i class="fa fa-angle-right" aria-hidden="true"></i><?= $keyword ?></a></li>
                    </ul>
                </div>

                <!-- Sidebar -->

                <div class="sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">
                            <h5> Danh mục sản phẩm </h5>
                        </div>
                        <ul class="sidebar_categories">
                            <?php foreach($category as $itemCate) :?>
                                     <li class="<?= $itemCate['id'] == $id ? 'active' : '' ?>"><a href="danh-muc-san-pham.php?id=<?=  $itemCate['id']  ?>"><?= $itemCate['name'] ?></a></li>
                            <?php endforeach ; ?>
                        </ul>
                    </div>

                 

                </div>

                <!-- Main Content -->

                <div class="main_content">

                    <!-- Products -->

                    <div class="products_iso">
                        <div class="row">
                            <div class="col">

                                <!-- Product Sorting -->

                                <div class="product_sorting_container product_sorting_container_top">
                                    <ul class="product_sorting">
                                        <li>
                                            <span class="type_sorting_text">Default Sorting</span>
                                            <i class="fa fa-angle-down"></i>
                                            <ul class="sorting_type">
                                                <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default Sorting</span></li>
                                                <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                                <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><span>Product Name</span></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span>Show</span>
                                            <span class="num_sorting_text">6</span>
                                            <i class="fa fa-angle-down"></i>
                                            <ul class="sorting_num">
                                                <li class="num_sorting_btn"><span>6</span></li>
                                                <li class="num_sorting_btn"><span>12</span></li>
                                                <li class="num_sorting_btn"><span>24</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="pages d-flex flex-row align-items-center">
                                        <div class="page_current">
                                            <span>1</span>
                                            <ul class="page_selection">
                                                <li><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                            </ul>
                                        </div>
                                        <div class="page_total"><span>of</span> 3</div>
                                        <div id="next_page" class="page_next"><a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
                                    </div>

                                </div>

                                <!-- Product Grid -->

                                <div class="product-grid">

                                    <!-- Product 1 -->
                                    <?php foreach($product as $item) :?>
                                    <div class="product-item men">
                                        <div class="product discount product_filter">
                                            <div class="product_image">
                                                <img src="<?php echo base_url() ?>/public/uploads/product/<?= $item['thumbar'] ?>" alt="">
                                            </div>
                                            <div class="favorite favorite_left"></div>
                                            <?php if($item['sale']) :?>
                                                <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                    <span><?=  $item['sale'] ?></span>
                                                </div>
                                            <?php endif ;?>
                                                   
                                           
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a></h6>
                                                <div class="product_price">
                                                    <?php if($item['sale']) :?>
                                                        <?= (100 - $item['sale']) * $item['price'] / 100  ?><span>$<?= $item['price'] ?></span>
                                                    <?php else :?>
                                                       $<?= $item['price'] ?>
                                                    <?php endif ;?>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="red_button add_to_cart_button"><a href="them-gio-hang.php?id=<?= $item['id'] ?>">add to cart</a></div>
                                    </div>
                                     <?php endforeach ;?>

                                

                                    <!-- Product 10 -->

                                   
                                </div>

                                <!-- Product Sorting -->

                                <div class="product_sorting_container product_sorting_container_bottom clearfix">
                                    <ul class="product_sorting">
                                        <li>
                                            <span>Show:</span>
                                            <span class="num_sorting_text">04</span>
                                            <i class="fa fa-angle-down"></i>
                                            <ul class="sorting_num">
                                                <li class="num_sorting_btn"><span>01</span></li>
                                                <li class="num_sorting_btn"><span>02</span></li>
                                                <li class="num_sorting_btn"><span>03</span></li>
                                                <li class="num_sorting_btn"><span>04</span></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <span class="showing_results">Showing 1–3 of 12 results</span>
                                    <style type="text/css">
                                        .pagi li a{
                                            padding: 7px 15px;
                                                border: 1px solid #dedede;
                                                margin-right: 2px;
                                            }
                                        }
                                        .pagi li a.active { background: #fe4c50 !important }
                                    </style>
                                    <div>
                                          <?php if($pagi == true) :?>
                                                <nav aria-label="Page navigation" class="clearfix text-center">
                                                    <ul class="pagination pagi" >
                                                        <li>
                                                            <a href=""  aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        <?php for(  $i = 1 ; $i <= $sotrang ; $i++ ) : ?>
                                                            <?php
                                                            if(isset($_GET['page']))
                                                            {
                                                                $p = $_GET['page'];
                                                            }
                                                            else
                                                            {
                                                                $p = 1;
                                                            }
                                                            ?>
                                                            <li >

                                                                 <a style="<?php echo ($i == $p) ? 'background: #fe4c50 !important;color: white' : ''  ?>" href="<?php echo $path ?>?id=<?php echo $id ?>&&page=<?php echo $i ;?>"><?php echo $i; ?></a>
                                                            </li>
                                                        <?php endfor; ?>

                                                        <li>
                                                            <a href="" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            <?php endif ; ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefit -->

    <div class="benefit">
        <div class="container">
            <div class="row benefit_row">
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>free shipping</h6>
                            <p>Suffered Alteration in Some Form</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>cach on delivery</h6>
                            <p>The Internet Tend To Repeat</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>45 days return</h6>
                            <p>Making it Look Like Readable</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>opening all week</h6>
                            <p>8AM - 09PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
                        <h4>Newsletter</h4>
                        <p>Subscribe to our newsletter and get 20% off your first purchase</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                        <input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
                        <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

   <?php require_once __DIR__ .'/layouts/footer.php' ?>