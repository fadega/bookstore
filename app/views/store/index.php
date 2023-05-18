<?php 
    // $this->view( "store/header.php", $data);
    // include "header.php";
    $this->view( "store/header", $data);
    
    if(is_array($data['BOOKS'])){
        // foreach($data['BOOKS'] as $row)
        // display($row);
    }
    if(is_array($categories)){
        // foreach($categories as $category)
        // display($category);
    }
    if(isset($data['item_searched'])){
        // echo "item searched = ".$data['item_searched']."<br>";
        // display($data['item_searched']);die;
    }
    ?>

        <!--=================================
        Hero Area
        ===================================== -->
        <section class="hero-area hero-slider-2">
            <div class="container">
                <div class="row align-items-lg-center">
                    <div class="col-lg-8">
                        <div class="sb-slick-slider" data-slick-setting='{
                                                                "autoplay": true,
                                                                "autoplaySpeed": 8000,
                                                                "slidesToShow": 1,
                                                                "dots":true
                                                                }'>
                            <div class="single-slide bg-image bg-position-left bg-position-lg-center"
                                data-bg="<?=ASSETS?>store/image/bg-images/home-2-slider-1.jpg">
                                <div class="home-content text-left text-md-center pl--30 pl-md--0">
                                    <div class="row">
                                        <div class="col-lg-7 col-xl-5 col-md-6 col-sm-6">
                                            <span class="title-small">Beautifully Designed</span>
                                            <h2>INSTA</h2>
                                            <p>Cover up front of book and
                                                <br>leave summary</p>
                                            <a href="<?=ROOT?>shop-grid" class="btn btn-outlined--primary">
                                                Shop Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-slide bg-image" data-bg="<?=ASSETS?>store/image/bg-images/custom-slider-2.jpg">
                                <div class="home-content pl--30">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <span class="title-mid">Book Mockup</span>
                                            <h2 class="h2-v2">Hardcover.</h2>
                                            <p>Cover up front of book and
                                                <br>leave summary</p>
                                            <a href="<?=ROOT?>shop-grid" class="btn btn-outlined--primary">
                                                Shop Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt--30 mt-lg--0">
                        <div class="sb-slick-slider hero-products-group-slider product-border-reset" data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 1,
                                            "rows":2
                                        }' data-slick-responsive='[
                                            {"breakpoint":992, "settings": {"slidesToShow": 2,"rows":2} },
                                            {"breakpoint":768, "settings": {"slidesToShow": 1} },
                                         {"breakpoint":490, "settings": {"slidesToShow": 1} }
                                    ]'>
                            <?php if(is_array($BOOKS)) :?>
                                <?php foreach($BOOKS as $BOOK) :?>
                                    <div class="single-slide">
                                        <div class="product-card card-style-list">
                                            <div class="card-image">
                                                <img src="<?=ROOT .$BOOK['image1']?>" alt="">
                                            </div>
                                            <div class="product-card--body">
                                                <div class="product-header">
                                                    <a href="" class="author">
                                                        Gpple
                                                    </a>
                                                    <h3><a href="<?=ROOT?>bookdetails/<?=$BOOK['slug']?>"><?= $BOOK['title'];?></a></h3>
                                                </div>
                                                <div class="price-block">
                                                    <span class="price">£<?=$BOOK['price']?></span>
                                                    <del class="price-old">£51.20</del>
                                                    <span class="price-discount">20%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;
                            endif;?>
                 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
        Home Features Section
        ===================================== -->
        <section class="mb--30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mt--30">
                        <div class="feature-box h-100">
                            <div class="icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="text">
                                <h5>Free Shipping Item</h5>
                                <p> Orders over $500</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mt--30">
                        <div class="feature-box h-100">
                            <div class="icon">
                                <i class="fas fa-redo-alt"></i>
                            </div>
                            <div class="text">
                                <h5>Money Back Guarantee</h5>
                                <p>100% money back</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mt--30">
                        <div class="feature-box h-100">
                            <div class="icon">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                            <div class="text">
                                <h5>Cash On Delivery</h5>
                                <p>Lorem ipsum dolor amet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mt--30">
                        <div class="feature-box h-100">
                            <div class="icon">
                                <i class="fas fa-life-ring"></i>
                            </div>
                            <div class="text">
                                <h5>Help & Support</h5>
                                <p>Call us : + 0123.4567.89</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
        Promotion Section One
        ===================================== -->
        <section class="section-margin">
            <h2 class="sr-only">Promotion Section</h2>
            <div class="container">
                <div class="row space-db--30">
                    <div class="col-lg-6 mb--30">
                        <a href="" class="promo-image promo-overlay">
                            <img src="<?=ASSETS?>store/image/promotion.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6 mb--30">
                        <a href="" class="promo-image promo-overlay">
                            <img src="<?=ASSETS?>store/image/promotion2.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
        Home Slider Tab
        ===================================== -->
        <section class="section-padding">
            <h2 class="sr-only">Home Tab Slider Section</h2>
            <div class="container">
                <div class="sb-custom-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="shop-tab" data-bs-toggle="tab" href="#shop" role="tab"
                                aria-controls="shop" aria-selected="true">
                                Featured Books
                            </a>
                            <span class="arrow-icon"></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="men-tab" data-bs-toggle="tab" href="#men" role="tab"
                                aria-controls="men" aria-selected="true">
                                New Arrivals
                            </a>
                            <span class="arrow-icon"></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="woman-tab" data-bs-toggle="tab" href="#woman" role="tab"
                                aria-controls="woman" aria-selected="false">
                                Most viewed Books
                            </a>
                            <span class="arrow-icon"></span>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                            <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider"
                            data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 4,
                            "rows":2,
                            "dots":true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                        ]'>
                            <!-- Single Book Featured Tab -->
                            <?php if(is_array($BOOKS)): ?>
                                <?php foreach($BOOKS as $BOOK): ?>
                                   <?php //print_r($BOOK);?>
                                <div class="single-slide">
                                    <div class="product-card">
                                        <div class="product-header">
                                            <a href="" class="author">
                                                <?php //echo $BOOK['category'];?>
                                            </a>
                                                <h3><a href="<?=ROOT?>bookdetails/<?=$BOOK['slug']?>"><?= $BOOK['title'];?></a></h3>
                                        </div>
                                        
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                <!-- <img src="<?=ASSETS?>store/image/books/product-1.jpg" alt=""> -->
                                                <img src="<?=ROOT .$BOOK['image1']?>" alt="">
                                                <div class="hover-contents">
                                                    <!-- <a href="<?=ROOT?>product-details" class="hover-image">
                                                        <img src="<?=ASSETS?>store/image/books/product-1.jpg" alt="">
                                                    </a> -->
                                                    <div class="hover-btns">
                                                        <a href="<?=ROOT?>bookdetails/<?=$BOOK['slug']?>" class="single-btn">
                                                            <i class="fas fa-shopping-basket"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="price-block">
                                                <?php 
                                                    $discount = 10;
                                                    $original_price = floatval($BOOK['price']);
                                                    $discounted_price = $original_price - ($original_price * $discount/100);
                                                    ?>
                                                <span class="price">£<?= $discounted_price;?></span>
                                                <del class="price-old">£<?=$original_price?></del>
                                                <span class="price-discount"><?=$discount?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php endif;?> 
                                   <!-- Single book End Single Book Featured Tab-->
                            </div>
                        </div>
                        <div class="tab-pane" id="men" role="tabpanel" aria-labelledby="men-tab">
                            <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider"
                                data-slick-setting='{
                                        "autoplay": true,
                                        "autoplaySpeed": 8000,
                                        "slidesToShow": 4,
                                        "rows":2,
                                        "dots":true
                                    }' data-slick-responsive='[
                                        {"breakpoint":1200, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":768, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":480, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":320, "settings": {"slidesToShow": 3} }
                                    ]'>
                                <!--Single book  New Arrival Tab -->
                                <?php if(is_array($BOOKS)): ?>
                                    <?php foreach($BOOKS as $BOOK): ?>
                                    <?php //print_r($BOOK);?>
                                    <div class="single-slide">
                                        <div class="product-card">
                                            <div class="product-header">
                                                <a href="" class="author">
                                                    <?php //echo $BOOK['category'];?>
                                                </a>
                                                    <h3><a href="<?=ROOT?>bookdetails/<?=$BOOK['slug']?>"><?= $BOOK['title'];?></a></h3>
                                            </div>
                                            <div class="product-card--body">
                                                <div class="card-image">
                                                    <!-- <img src="<?=ASSETS?>store/image/books/product-1.jpg" alt=""> -->
                                                    <img src="<?=ROOT .$BOOK['image1']?>" alt="">
                                                    <div class="hover-contents">
                                                        <!-- <a href="<?=ROOT?>product-details" class="hover-image">
                                                            <img src="<?=ASSETS?>store/image/books/product-1.jpg" alt="">
                                                        </a> -->
                                                        <div class="hover-btns">
                                                            <a href="<?=ROOT?>bookdetails/<?=$BOOK['slug']?>" class="single-btn">
                                                                <i class="fas fa-shopping-basket"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="price-block">
                                                    <?php 
                                                        $discount = 10;
                                                        $original_price = floatval($BOOK['price']);
                                                        $discounted_price = $original_price - ($original_price * $discount/100);
                                                        ?>
                                                    <span class="price">£<?= $discounted_price;?></span>
                                                    <del class="price-old">£<?=$original_price?></del>
                                                    <span class="price-discount"><?=$discount?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif;?> 
                                <!-- Single book END New Arrival Tab -->
               
                            </div>
                        </div>
                        <div class="tab-pane" id="woman" role="tabpanel" aria-labelledby="woman-tab">
                            <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider"
                                data-slick-setting='{
                                        "autoplay": true,
                                        "autoplaySpeed": 8000,
                                        "slidesToShow": 4,
                                        "rows":2,
                                        "dots":true
                                    }' data-slick-responsive='[
                                        {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                                    ]'>

                                <!-- Single book Most viewed table  -->
                                <?php if(is_array($BOOKS)): ?>
                                    <?php foreach($BOOKS as $BOOK): ?>
                                    <?php //print_r($BOOK);?>
                                    <div class="single-slide">
                                        <div class="product-card">
                                            <div class="product-header">
                                                <a href="" class="author">
                                                    <?php // echo $BOOK['category'];?>
                                                </a>
                                                    <h3><a href="<?=ROOT?>bookdetails/<?=$BOOK['slug']?>"><?= $BOOK['title'];?></a></h3>
                                            </div>
                                            <div class="product-card--body">
                                                <div class="card-image">
                                                    <!-- <img src="<?=ASSETS?>store/image/books/product-1.jpg" alt=""> -->
                                                    <img src="<?=ROOT .$BOOK['image1']?>" alt="">
                                                    <div class="hover-contents">
                                                        <!-- <a href="<?=ROOT?>product-details" class="hover-image">
                                                            <img src="<?=ASSETS?>store/image/books/product-1.jpg" alt="">
                                                        </a> -->
                                                        <div class="hover-btns">
                                                            <a href="<?=ROOT?>cart" class="single-btn">
                                                                <i class="fas fa-shopping-basket"></i>
                                                            </a>
                                                            <!-- <a href="<?=ROOT?>wishlist" class="single-btn">
                                                                <i class="fas fa-heart"></i>
                                                            </a>
                                                            <a href="<?=ROOT?>compare" class="single-btn">
                                                                <i class="fas fa-random"></i>
                                                            </a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quickModal"
                                                                class="single-btn">
                                                                <i class="fas fa-eye"></i>
                                                            </a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="price-block">
                                                    <?php 
                                                        $discount = 10;
                                                        $original_price = floatval($BOOK['price']);
                                                        $discounted_price = $original_price - ($original_price * $discount/100);
                                                        ?>
                                                    <span class="price">£<?= $discounted_price;?></span>
                                                    <del class="price-old">£<?=$original_price?></del>
                                                    <span class="price-discount"><?=$discount?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif;?> 
                                <!-- Single book  End most viewed tab  -->
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!--=================================
        CHILDREN’S BOOKS SECTION
        ===================================== -->
        <section class="section-margin">
            <div class="container">
                <div class="section-title section-title--bordered">
                    <h2>CHILDREN’S BOOKS</h2>
                </div>
                <div class="product-slider product-list-slider slider-border-single-row sb-slick-slider"
                    data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow":3,
                                            "dots":true
                                        }' data-slick-responsive='[
                                            {"breakpoint":1200, "settings": {"slidesToShow": 2} },
                                            {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                            {"breakpoint":575, "settings": {"slidesToShow": 1} },
                                            {"breakpoint":490, "settings": {"slidesToShow": 1} }
                                        ]'>
                     <!-- Single book Children's books  -->
                    <?php if(is_array($CHILDREN)  && count($CHILDREN) >=1): ?>
                        <?php foreach($CHILDREN as $CHILD): ?>
                        <div class="single-slide">
                            <div class="product-card card-style-list">
                                <div class="card-image">
                                    <img src="<?=ROOT . $CHILD['image1']?>" alt="">
                                </div>
                                <div class="product-card--body">
                                    <div class="product-header">
                                        <a href="" class="author">
                                            <?=$CHILD['categoryName']?>
                                        </a>
                                            <h3><a href="<?=ROOT?>bookdetails/<?=$CHILD['slug']?>"><?= $CHILD['title'];?></a>
                                            </h3>
                                    </div>
                                    <div class="price-block">
                                        <?php 
                                            $discount_for_child = 15;
                                            $original_price_for_child = floatval($CHILD['price']);
                                            $discounted_price = $original_price_for_child - ($original_price_for_child * $discount_for_child/100);
                                            ?>
                                        <span class="price">£<?= $discounted_price;?></span>
                                        <del class="price-old">£<?=$original_price_for_child?></del>
                                        <span class="price-discount"><?=$discount_for_child ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    endif;?>
                     <!-- Single book End of children's books  -->

                </div>
            </div>
        </section>
        <!--=================================
        Promotion Section Two
        ===================================== -->
        <section class="section-margin">
            <h2 class="sr-only">Promotion Section</h2>
            <div class="container">
                <div class="promo-wrapper promo-type-four">
                    <a href="#" class="promo-image promo-overlay bg-image"
                        data-bg="<?=ASSETS?>store/image/bg-images/adbanner.png">
                    </a>
                    <div class="promo-text w-100 justify-content-center justify-content-md-left">
                        <div class="row w-100">
                            <div class="col-lg-8">
                                <div class="promo-text-inner">
                                    <h2>Buy 3. Get Free 1.</h2>
                                    <h3>50% off for selected products in Pustok.</h3>
                                    <a href="#" class="btn btn-outlined--red-faded">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
        Home Blog
        ===================================== -->
        
        <!-- Modal -->
        <div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog"
            aria-labelledby="quickModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="product-details-modal">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product Details Slider Big Image-->
                                <div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
                                    "slidesToShow": 1,
                                    "arrows": false,
                                    "fade": true,
                                    "draggable": false,
                                    "swipe": false,
                                    "asNavFor": ".product-slider-nav"
                                    }'>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-1.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-2.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-3.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-4.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-5.jpg" alt="">
                                    </div>
                                </div>
                                <!-- Product Details Slider Nav -->
                                <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two"
                                    data-slick-setting='{
                                                        "infinite":true,
                                                        "autoplay": true,
                                                        "autoplaySpeed": 8000,
                                                        "slidesToShow": 4,
                                                        "arrows": true,
                                                        "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
                                                        "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
                                                        "asNavFor": ".product-details-slider",
                                                        "focusOnSelect": true
                                                        }'>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-1.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-2.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-3.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-4.jpg" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="<?=ASSETS?>store/image/books/product-details-5.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 mt--30 mt-lg--30">
                                <div class="product-details-info pl-lg--30 ">
                                    <p class="tag-block">Tags: <a href="#">Movado</a>, <a href="#">Omega</a></p>
                                    <h3 class="product-title">Beats EP Wired On-Ear Headphone-Black</h3>
                                    <ul class="list-unstyled">
                                        <li>Ex Tax: <span class="list-value"> £60.24</span></li>
                                        <li>Brands: <a href="#" class="list-value font-weight-bold"> Canon</a></li>
                                        <li>Product Code: <span class="list-value"> model1</span></li>
                                        <li>Reward Points: <span class="list-value"> 200</span></li>
                                        <li>Availability: <span class="list-value"> In Stock</span></li>
                                    </ul>
                                    <div class="price-block">
                                        <span class="price-new">£73.79</span>
                                        <del class="price-old">£91.86</del>
                                    </div>
                                    <div class="rating-widget">
                                        <div class="rating-block">
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star "></span>
                                        </div>
                                        <div class="review-widget">
                                            <a href="">(1 Reviews)</a> <span>|</span>
                                            <a href="">Write a review</a>
                                        </div>
                                    </div>
                                    <article class="product-details-article">
                                        <h4 class="sr-only">Product Summery</h4>
                                        <p>Long printed dress with thin adjustable straps. V-neckline and wiring under
                                            the Dust with ruffles
                                            at the bottom
                                            of the
                                            dress.</p>
                                    </article>
                                    <div class="add-to-cart-row">
                                        <div class="count-input-block">
                                            <span class="widget-label">Qty</span>
                                            <input type="number" class="form-control text-center" value="1">
                                        </div>
                                        <div class="add-cart-btn">
                                            <a href="" class="btn btn-outlined--primary"><span
                                                    class="plus-icon">+</span>Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="compare-wishlist-row">
                                        <a href="" class="add-link"><i class="fas fa-heart"></i>Add to Wish List</a>
                                        <a href="" class="add-link"><i class="fas fa-random"></i>Add to Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="widget-social-share">
                            <span class="widget-label">Share:</span>
                            <div class="modal-social-share">
                                <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=================================
        Footer
        ===================================== -->
    </div> <!--end of top wrapper-->

    <?php include 'footer.php'; ?>