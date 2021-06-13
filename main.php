

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

                    <div class="product-item men">
                        <div class="product discount product_filter">
                            <?php foreach ($productMew as $item) : ?>
                                <div class="product_image">
                                <img src="<?php echo upload() ?>product/<?php echo item['thumbar'] ?>" alt="">
                                </div>
                                <div class="favorite favorite_left"></div>
                                <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
                                <div class="product_info">
                                <h6 class="product_name"><a href="single.html"><?php echo $item['name'] ?></a></h6>
                                <div class="product_price"><?php echo $item['price'] ?><span><?php echo $item['sale'] ?></span></div>
                            </div>
                        </div>
                            <?php endforeach ?>
                        <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                    </div>

                    <!--  Kết thúc sản phẩm -->                  
                </div>
            </div>
        </div>
    </div>
</div>