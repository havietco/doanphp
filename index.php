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



    // san pham moi 
    $sqlProductNew = "SELECT * FROM product WHERE 1 ORDER BY ID DESC LIMIT 10 "; // lay 10 sp ! 
    $productNew    = $db->fetchsql($sqlProductNew);

     // san pham hot 
    $sqlProductHot = "SELECT * FROM product WHERE 1  and hot = 1 ORDER BY ID DESC LIMIT 10 "; // lay 10 sp ! 
    $productHot    = $db->fetchsql($sqlProductHot);

 ?>
<?php require_once __DIR__. '/themes/header.php'; ?>
    <!-- New Arrivals -->

<div class="new_arrivals">
       
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>SẢN PHẨM MỚI</h2>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        <!-- Product 1 -->         
                            <?php foreach($productNew as $product) :?>          
                                <div class="product-item men">
                                    <div class="product discount product_filter">
                                        <div class="product_image">
                                            <img src="<?php echo base_url() ?>/public/uploads/product/<?= $product['thumbar'] ?>" alt="">
                                        </div>
                                        <div class="favorite favorite_left"></div>
                                        <?php if($product['sale']) :?>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                <span><?=  $product['sale'] ?></span>
                                            </div>
                                        <?php endif ;?>
                                               
                                       
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="chi-tiet-san-pham.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a></h6>
                                            <div class="product_price">
                                                <?php if($product['sale']) :?>
                                                    <?= (100 - $product['sale']) * $product['price'] / 100  ?><span>$<?= $product['price'] ?></span>
                                                <?php else :?>
                                                   $<?= $product['price'] ?>
                                                <?php endif ;?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="red_button add_to_cart_button"><a href="them-gio-hang.php?id=<?= $product['id'] ?>">add to cart</a></div>
                                </div>
                            <?php endforeach ; ?>
                       
                        <!--  Kết thúc sản phẩm -->                            
                    </div>
                </div>
        </div>
            
    </div>
   
</div>
    <!-- Deal of the week -->

    <div class="deal_ofthe_week">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="deal_ofthe_week_img">
                        <img src="themes/images/deal_ofthe_week.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 text-right deal_ofthe_week_col">
                    <div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
                        <div class="section_title">
                            <h2>Deal Of The Week</h2>
                        </div>
                        <ul class="timer">
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="day" class="timer_num">03</div>
                                <div class="timer_unit">Day</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="hour" class="timer_num">15</div>
                                <div class="timer_unit">Hours</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="minute" class="timer_num">45</div>
                                <div class="timer_unit">Mins</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="second" class="timer_num">23</div>
                                <div class="timer_unit">Sec</div>
                            </li>
                        </ul>
                        <div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Sellers -->

<div class="new_arrivals">
       
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>SẢN PHẨM HÓT </h2>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        <!-- Product 1 -->                   
                            <?php foreach($productHot as $product) :?>          
                                <div class="product-item men">
                                    <div class="product discount product_filter">
                                        <div class="product_image">
                                            <img src="<?php echo base_url() ?>/public/uploads/product/<?= $product['thumbar'] ?>" alt="">
                                        </div>
                                        <div class="favorite favorite_left"></div>
                                        <?php if($product['sale']) :?>
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                <span><?=  $product['sale'] ?></span>
                                            </div>
                                        <?php endif ;?>
                                               
                                       
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="chi-tiet-san-pham.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a></h6>
                                            <div class="product_price">
                                                <?php if($product['sale']) :?>
                                                    <?= (100 - $product['sale']) * $product['price'] / 100  ?><span>$<?= $product['price'] ?></span>
                                                <?php else :?>
                                                   $<?= $product['price'] ?>
                                                <?php endif ;?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="red_button add_to_cart_button"><a href="them-gio-hang.php?id=<?= $product['id'] ?>">add to cart</a></div>
                                </div>
                            <?php endforeach ; ?>
                        <!--  Kết thúc sản phẩm -->                            
                    </div>
                </div>
        </div>
            
    </div>
   
</div>


    <!-- Blogs -->

    <div class="blogs">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title">
                        <h2>Latest Blogs</h2>
                    </div>
                </div>
            </div>
            <div class="row blogs_container">
                <div class="col-lg-4 blog_item_col">
                    <div class="blog_item">
                        <div class="blog_background" style="background-image:url(themes/images/blog_1.jpg)"></div>
                        <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                            <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                            <span class="blog_meta">by admin | dec 01, 2017</span>
                            <a class="blog_more" href="#">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 blog_item_col">
                    <div class="blog_item">
                        <div class="blog_background" style="background-image:url(themes/images/blog_2.jpg)"></div>
                        <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                            <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                            <span class="blog_meta">by admin | dec 01, 2017</span>
                            <a class="blog_more" href="#">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 blog_item_col">
                    <div class="blog_item">
                        <div class="blog_background" style="background-image:url(themes/images/blog_3.jpg)"></div>
                        <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                            <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                            <span class="blog_meta">by admin | dec 01, 2017</span>
                            <a class="blog_more" href="#">Read more</a>
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
                    <form action="post">
                        <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                            <input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
                            <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__. '/themes/footer.php'; ?>