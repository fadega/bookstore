
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $db = new Database();
    $conn = $db->db_connect();

    $conn =  Database::newInstance();
    $sql= "SELECT *FROM category order by id ";
    // $category = $this->loadModel('Category');
    $categories = $conn->read($sql,[]); 
    $data['categories'] = $conn->read($sql,[]);
  

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DENSA BOOK STORE | <?php echo $data['pageTitle'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?=ASSETS?>store/css/plugins.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?=ASSETS?>store/css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?=ASSETS?>store/css/custom.css" />
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?=ASSETS?>store/image/favicon.ico"> -->
</head>

<body>
    <div class="site-wrapper" id="top">
        <div class="site-header header-2 mb--20 d-none d-lg-block">
            <div class="header-middle pt--10 pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <a href="<?=ROOT?>" class="site-brand">
                                <img src="<?=ASSETS?>store/image/logo.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <div class="header-search-block">
                                <form  method="get">
                                    <input type="text" name="term" placeholder="Search for books ...">
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="main-navigation flex-lg-right">
                                <div class="cart-widget">
                                    <div class="login-block">
                                    <ul class="nav justify-content-center">
                                    <?php if(isset($_SESSION['logged'])):?>  
                                        <li class="nav-item">
                                            <a  href="<?=ROOT?>signout">Logout  </a> 
                                        </li>
                                        <li class="nav-item">
                                            <?php if($_SESSION['logged']['role']=="admin"):?>
                                                <span>&#160;</span> <a  href="<?=ROOT?>admin">  Dashboard  </a>
                                            <?php else:?>
                                                <!-- <a  href="<?=ROOT?>profile">My Account  </a> -->
                                            <span>&#160;</span>   <a  href="<?=ROOT?>profile">My Account  </a>
                                            <?php endif;?>
                                        </li>
                                    <?php else:?>
                                    <li class="nav-item">
                                        <a href="<?=ROOT?>signin">Login</a> <br>
                                    </li>
                                    <li class="nav-item">
                                        <span>&#160;</span><a href="<?=ROOT?>register">Register</a>
                                    </li>
                                    <?php endif;?>
                                    <li class="nav-item" id="shopping-cart-text">
                                        <span>&#160;</span><a href="<?=ROOT?>cart">Shopping Cart</a>
                                    </li>
                                    </ul>
                                    </div>
                                    <!-- <span class="nav-item" id="shopping-cart-text" style="cursor:pointer;">
                                        <a href="<?=ROOT?>cart">Shopping Cart</a>
                                    </span> -->
                                    <?php if(isset($_SESSION['CART_ITEMS']) && is_array(($_SESSION['CART_ITEMS']))):?>
                                            <script type="text/javascript"> document.querySelector('#shopping-cart-text').style.display = "none";</script>
                                            <div class="cart-block">
                                                <div class="cart-total">
                                                    <span class="text-number">
                                                    <?php 
                                                        $qty = 0; 
                                                        foreach($_SESSION['CART_ITEMS'] as $item){
                                                            $qty += $item['cart_qty']; 
                                                        }
                                                        ?>
                                                        <?=$qty?>
                                                    </span>
                                                    <span class="text-item">
                                                        Shopping Cart
                                                    </span>
                                                    <span class="price">
                                                    <?php 
                                                        $total = 0; 
                                                        foreach($_SESSION['CART_ITEMS'] as $item){
                                                            $total += $item['price']; 
                                                        }
                                                        ?>
                                                       <!-- £<?php $total;?> -->
                                                        <i class="fas fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                                <div class="cart-dropdown-block">
                                                    <div class=" single-cart-block ">
                                                        <div class="cart-product" style="display:block;">
                                                            <!-- <a href="<?=ROOT?>product-details" class="image">
                                                                <img src="<?=ASSETS?>store/image/products/cart-product-1.jpg" alt="">
                                                            </a> -->
                                                            <?php foreach($_SESSION['CART_ITEMS'] as $item):?>
                                                            <div class="content">
                                                                <span class="title"><?=$item['title']?></span>
                                                                <span class="price"><span class="qty"><?=$item['cart_qty']?>x</span> £<?=$item['price']?></span>
                                                                <button class="cross-btn"><i class="fas fa-times"></i></button>
                                                            </div>
                                                            <?php endforeach;?>
                                                        </div>
                                                    </div>
                                                    <div class=" single-cart-block ">
                                                        <div class="btn-block">
                                                            <a href="<?=ROOT?>cart" class="btn">View Cart <i
                                                                    class="fas fa-chevron-right"></i></a>
                                                            <a href="<?=ROOT?>checkout" class="btn btn--primary">Check Out <i
                                                                    class="fas fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php // endif;?>
                                    <?php endif;?>
                                </div>
                                <!-- @include('menu.htm') -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom bg-primary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <nav class="category-nav white-nav  ">
                                <div>
                                    <a href="javascript:void(0)" class="category-trigger"><i
                                            class="fa fa-bars"></i>Browse
                                        categories</a>
                                    <ul class="category-menu">
                                        <?php if(isset($data['categories']) && !empty($data['categories'])):
                                                 foreach($categories as $category):?>
                                                    <li class="cat-item">
                                                        <a href="<?=ROOT?>store/"><?=$category['categoryName']?></a>
                                                    </li>
                                                 <?php endforeach;
                                             endif ?>
                                        <!-- <li class="cat-item has-children"><a href="#">Cookbooks</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li> -->
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-3">
                            <div class="header-phone color-white">
                                <div class="icon">
                                    <i class="fas fa-headphones-alt"></i>
                                </div>
                                <div class="text">
                                    <p>Free Support 24/7</p>
                                    <p class="font-weight-bold number">+(44) 12 234 5678</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="main-navigation flex-lg-right">
                                <ul class="main-menu menu-right main-menu--white li-last-0">
                                    <li class="menu-item has-children">
                                        <a href="<?=ROOT?>">Home</a> 
                                    </li>
                                    <!-- Shop -->
                                    <li class="menu-item has-children mega-menu">
                                        <a href="<?=ROOT?>shop">shop </a>
                                    </li>
                                    <!-- About -->
                                    <li class="menu-item has-children">
                                        <a href="<?=ROOT?>about">About </a>
                                    </li>
                                    
                                    <li class="menu-item">
                                        <a href="<?=ROOT?>contact">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-mobile-menu">
            <header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
                <div class="container">
                    <div class="row align-items-sm-end align-items-center">
                        <div class="col-md-4 col-7">
                            <a href="index.html" class="site-brand">
                                <img src="<?=ASSETS?>store/image/logo.png" alt="">
                            </a>
                        </div>
                        <div class="col-md-5 order-3 order-md-2">
                            <nav class="category-nav   ">
                                <div>
                                    <a href="javascript:void(0)" class="category-trigger"><i
                                            class="fa fa-bars"></i>Browse
                                        categories</a>
                                    <ul class="category-menu">
                                        <li class="cat-item has-children">
                                            <a href="#">Arts & Photography</a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children mega-menu"><a href="#">Biographies</a>
                                            <ul class="sub-menu">
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Business & Money</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Calendars</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Children's Books</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Comics</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item"><a href="#">Perfomance Filters</a></li>
                                        <li class="cat-item has-children"><a href="#">Cookbooks</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item "><a href="#">Accessories</a></li>
                                        <li class="cat-item "><a href="#">Education</a></li>
                                        <li class="cat-item hidden-menu-item"><a href="#">Indoor Living</a></li>
                                        <li class="cat-item"><a href="#" class="js-expand-hidden-menu">More
                                                Categories</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-3 col-5  order-md-3 text-right">
                            <div class="mobile-header-btns header-top-widget">
                                <ul class="header-links">
                                    <li class="sin-link">
                                        <a href="cart.html" class="cart-link link-icon"><i class="ion-bag"></i></a>
                                    </li>
                                    <li class="sin-link">
                                        <a href="javascript:" class="link-icon hamburgur-icon off-canvas-btn"><i
                                                class="ion-navicon"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!--Off Canvas Navigation Start-->
            <aside class="off-canvas-wrapper">
                <div class="btn-close-off-canvas">
                    <i class="ion-android-close"></i>
                </div>
                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box offcanvas">
                        <form>
                            <input type="text" placeholder="Search Here">
                            <button class="search-btn"><i class="ion-ios-search-strong"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav class="off-canvas-nav">
                            <ul class="mobile-menu main-mobile-menu">
                                <li class="menu-item-has-children">
                                    <a href="<?=ROOT?>">Home</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="<?=ROOT?>shop">Shop</a>
                                    <!-- <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href="#">Blog Grid</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog.html">Full Widh (Default)</a></li>
                                                <li><a href="blog-left-sidebar.html">left Sidebar</a></li>
                                                <li><a href="blog-right-sidebar.html">Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Blog List</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog-list.html">Full Widh (Default)</a></li>
                                                <li><a href="blog-list-left-sidebar.html">left Sidebar</a></li>
                                                <li><a href="blog-list-right-sidebar.html">Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Blog Details</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog-details.html">Image Format (Default)</a></li>
                                                <li><a href="blog-details-gallery.html">Gallery Format</a></li>
                                                <li><a href="blog-details-audio.html">Audio Format</a></li>
                                                <li><a href="blog-details-video.html">Video Format</a></li>
                                                <li><a href="blog-details-left-sidebar.html">left Sidebar</a></li>
                                            </ul>
                                        </li>
                                    </ul> -->
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="<?=ROOT?>about">About</a>
                                </li>
                                
                                <li><a href="<?=ROOT?>contact">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->
                    <nav class="off-canvas-nav">
                        <ul class="mobile-menu menu-block-2">
                            <li class="menu-item-has-children">
                                <a href="#">Currency - GBP £ <i class="fas fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li> <a href="#">GBP £</a></li>
                                    <li> <a href="#">EUR €</a></li>
                                    <li> <a href="#">USD $</a></li>
                                </ul>
                            </li>
                            <!-- <li class="menu-item-has-children">
                                <a href="#">Lang - Eng<i class="fas fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li>Eng</li>
                                    <li>Ban</li>
                                </ul>
                            </li> -->
                            <!-- <li class="menu-item-has-children">
                                <a href="#">My Account <i class="fas fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="">My Account</a></li>
                                    <li><a href="">Order History</a></li>
                                    <li><a href="">Transactions</a></li>
                                    <li><a href="">Downloads</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </nav>
                    <div class="off-canvas-bottom">
                        <div class="contact-list mb--10">
                            <a href="" class="sin-contact"><i class="fas fa-mobile-alt"></i>(12345) 78790220</a>
                            <a href="" class="sin-contact"><i class="fas fa-envelope"></i>bahta@densa.com</a>
                        </div>
                        <div class="off-canvas-social">
                            <a href="https://www.facebook.com/bahta.tesfe" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </aside>
            <!--Off Canvas Navigation End-->
        </div>
        <div class="sticky-init fixed-header common-sticky">
            <div class="container d-none d-lg-block">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <a href="index.html" class="site-brand">
                            <img src="<?=ASSETS?>store/image/logo.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-navigation flex-lg-right">
                            <ul class="main-menu menu-right ">
                                <li class="menu-item has-children">
                                    <a href="<?=ROOT?>">Home </a>
                                </li>
                                <!-- Shop -->
                                <li class="menu-item has-children mega-menu">
                                    <a href="<?=ROOT?>shop">shop</a>
                                </li>
                                <li class="menu-item has-children mega-menu">
                                    <a href="<?=ROOT?>about">About </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?=ROOT?>contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>