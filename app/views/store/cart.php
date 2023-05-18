<?php 
    $this->view( "store/header", $data);

    ?>
        
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active">Cart</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!-- Cart Page Start -->
		<main class="cart-page-main-block inner-page-sec-padding-bottom">
			<div class="cart_area cart-area-padding  ">
				<div class="container">
					<div class="page-section-title">
						<h1>Shopping Cart</h1>
					</div>
					<div class="row">
						<div class="col-12">
							<form action="#" class="">
								<!-- Cart Table -->
								<div class="cart-table table-responsive mb--40">
									<table class="table">
										<!-- Head Row -->
										<?php if($CARTROWS): ?>
										<thead>
											<tr>
												<th class="pro-remove"></th>
												<th class="pro-thumbnail">Cover</th>
												<th class="pro-title">Book Title</th>
												<th class="pro-price">Price</th>
												<th class="pro-quantity">Quantity</th>
												<th class="pro-subtotal">Total</th>
											</tr>
										</thead>
										<tbody>
											<!-- Product Row -->
											<?php foreach($CARTROWS as $row):?>
											<tr>
												<td class="pro-remove"><a href="<?=ROOT?>cart/remove/<?=$row['id']?>"><i class="far fa-trash-alt"></i></a>
												</td>
												<td class="pro-thumbnail"><a href="#"><img
														src="<?=ROOT . $row['image1']?>" alt="Book"></a></td>
												<td class="pro-title"><a href="#"><?=$row['title']?></a></td>
												<td class="pro-price"><span>$<?=$row['price']?></span></td>
												<td >
													<div class="row" >
														<div class="col-md-4 ">
															<a href="<?=ROOT?>cart/subtract_quantity/<?=$row['id']?>"  style="float:right; font-size:26px;color:#e63946;" >—</i></a>
															<!-- <script>window.load.href = "<?php //echo ROOT.'shop' ?>"</script> -->
														</div>
														<div class="col-md-3">
															<input  oninput = "edit_quantity(this.value); alert('alerteddd')" type="text"  class="form-control p-0 text-center" readonly  value="<?=$row['cart_qty']?>"/>
														</div>
														<div class="col-md-4 ">
															<a href="<?=ROOT?>cart/add_quantity/<?=$row['id']?> " style="float:left; font-size:26px;color:#06d6a0;">+</a>
															<!-- <script>window.load.href = "<?php //echo ROOT.'shop' ?>"</script>     -->
														</div>
													</div>
								
												
												</td>
												<td> <h5> $ <?= $row['cart_qty'] * $row['price']?> </h5> </td>
											</tr>
											<!-- Product Row End -->
											<?php endforeach; ?>
											<?php endif ;?>
											<!-- Discount Row  -->
											<tr>
												<td colspan="6" class="actions">
													<div class="coupon-block">
														<div class="coupon-text">
															<label for="coupon_code">Coupon:</label>
															<input type="text" name="coupon_code" class="input-text"
																id="coupon_code" value="" placeholder="Coupon code">
														</div>
														<div class="coupon-btn">
															<input type="submit" class="btn btn-outlined"
																name="apply_coupon" value="Apply coupon">
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="cart-section-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-12 mb--30 mb-lg--0">
							<!-- slide Block 5 / Normal Slider -->
							<div class="cart-block-title">
								<h2>YOU MAY BE INTERESTED IN…</h2>
							</div>
							<div class="product-slider sb-slick-slider" data-slick-setting='{
							          "autoplay": true,
							          "autoplaySpeed": 8000,
							          "slidesToShow": 2
									  }' data-slick-responsive='[
                {"breakpoint":992, "settings": {"slidesToShow": 2} },
                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                {"breakpoint":575, "settings": {"slidesToShow": 2} },
                {"breakpoint":480, "settings": {"slidesToShow": 1} },
                {"breakpoint":320, "settings": {"slidesToShow": 1} }
            ]'>
								<div class="single-slide">
									<div class="product-card">
										<div class="product-header">
											<span class="author">
												Lpple
											</span>
											<h3><a href="product-details.html">Revolutionize Your BOOK With These
													Easy-peasy Tips</a></h3>
										</div>
										<div class="product-card--body">
											<div class="card-image">
												<img src="image/products/product-10.jpg" alt="">
												<div class="hover-contents">
													<a href="product-details.html" class="hover-image">
														<img src="image/products/product-1.jpg" alt="">
													</a>
												</div>
											</div>
											<div class="price-block">
												<span class="price">£51.20</span>
												<del class="price-old">£51.20</del>
												<span class="price-discount">20%</span>
											</div>
										</div>
									</div>
								</div>
								<div class="single-slide">
									<div class="product-card">
										<div class="product-header">
											<span class="author">
												Jpple
											</span>
											<h3><a href="product-details.html">Turn Your BOOK Into High Machine</a></h3>
										</div>
										<div class="product-card--body">
											<div class="card-image">
												<img src="image/products/product-2.jpg" alt="">
												<div class="hover-contents">
													<a href="product-details.html" class="hover-image">
														<img src="image/products/product-1.jpg" alt="">
													</a>
													<!-- <div class="hover-btns">
														<a href="cart.html" class="single-btn">
															<i class="fas fa-shopping-basket"></i>
														</a>
														<a href="wishlist.html" class="single-btn">
															<i class="fas fa-heart"></i>
														</a>
														<a href="compare.html" class="single-btn">
															<i class="fas fa-random"></i>
														</a>
														<a href="#" data-bs-toggle="modal" data-bs-target="#quickModal"
															class="single-btn">
															<i class="fas fa-eye"></i>
														</a>
													</div> -->
												</div>
											</div>
											<div class="price-block">
												<span class="price">£51.20</span>
												<del class="price-old">£51.20</del>
												<span class="price-discount">20%</span>
											</div>
										</div>
									</div>
								</div>
								<div class="single-slide">
									<div class="product-card">
										<div class="product-header">
											<span class="author">
												Wpple
											</span>
											<h3><a href="product-details.html">3 Ways Create Better BOOK With</a></h3>
										</div>
										<div class="product-card--body">
											<div class="card-image">
												<img src="image/products/product-3.jpg" alt="">
												<div class="hover-contents">
													<a href="product-details.html" class="hover-image">
														<img src="image/products/product-2.jpg" alt="">
													</a>
													<!-- <div class="hover-btns">
														<a href="cart.html" class="single-btn">
															<i class="fas fa-shopping-basket"></i>
														</a>
														<a href="wishlist.html" class="single-btn">
															<i class="fas fa-heart"></i>
														</a>
														<a href="compare.html" class="single-btn">
															<i class="fas fa-random"></i>
														</a>
														<a href="#" data-bs-toggle="modal" data-bs-target="#quickModal"
															class="single-btn">
															<i class="fas fa-eye"></i>
														</a>
													</div> -->
												</div>
											</div>
											<div class="price-block">
												<span class="price">£51.20</span>
												<del class="price-old">£51.20</del>
												<span class="price-discount">20%</span>
											</div>
										</div>
									</div>
								</div>
								<div class="single-slide">
									<div class="product-card">
										<div class="product-header">
											<span class="author">
												Epple
											</span>
											<h3><a href="product-details.html">What You Can Learn From Bill Gates</a>
											</h3>
										</div>
										<div class="product-card--body">
											<div class="card-image">
												<img src="image/products/product-5.jpg" alt="">
												<div class="hover-contents">
													<a href="product-details.html" class="hover-image">
														<img src="image/products/product-4.jpg" alt="">
													</a>
													<!-- <div class="hover-btns">
														<a href="cart.html" class="single-btn">
															<i class="fas fa-shopping-basket"></i>
														</a>
														<a href="wishlist.html" class="single-btn">
															<i class="fas fa-heart"></i>
														</a>
														<a href="compare.html" class="single-btn">
															<i class="fas fa-random"></i>
														</a>
														<a href="#" data-bs-toggle="modal" data-bs-target="#quickModal"
															class="single-btn">
															<i class="fas fa-eye"></i>
														</a>
													</div> -->
												</div>
											</div>
											<div class="price-block">
												<span class="price">£51.20</span>
												<del class="price-old">£51.20</del>
												<span class="price-discount">20%</span>
											</div>
										</div>
									</div>
								</div>
								<div class="single-slide">
									<div class="product-card">
										<div class="product-header">
											<span class="author">
												Hpple
											</span>
											<h3><a href="product-details.html">Simple Things You To Save BOOK</a></h3>
										</div>
										<div class="product-card--body">
											<div class="card-image">
												<img src="<?=ASSETS?>store/image/111.jpeg" alt="">
												<div class="hover-contents">
													<a href="product-details.html" class="hover-image">
														<img src="image/products/product-4.jpg" alt="">
													</a>
													<!-- <div class="hover-btns">
														<a href="cart.html" class="single-btn">
															<i class="fas fa-shopping-basket"></i>
														</a>
														<a href="wishlist.html" class="single-btn">
															<i class="fas fa-heart"></i>
														</a>
														<a href="compare.html" class="single-btn">
															<i class="fas fa-random"></i>
														</a>
														<a href="#" data-bs-toggle="modal" data-bs-target="#quickModal"
															class="single-btn">
															<i class="fas fa-eye"></i>
														</a>
													</div> -->
												</div>
											</div>
											<div class="price-block">
												<span class="price">£51.20</span>
												<del class="price-old">£51.20</del>
												<span class="price-discount">20%</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Cart Summary -->
						<div class="col-lg-6 col-12 d-flex">
							<div class="cart-summary">
								<div class="cart-summary-wrap">
									<h4><span>Cart Summary</span></h4>

									<?php if($CARTROWS):?>
										<p style="font-size:24px; font-weight:bold;"> Grand Total <span class="text-primary">
										<?php $total = 0; 
										foreach($CARTROWS as $row):?>
											<?php $total += $row['cart_qty'] * $row['price'] ; ?>
											
									<?php endforeach; ?>
										
									$  <?=$total?> </span></p>
										<!-- <h4 class= "me-2"> $ <?=$total?></h4> </span> -->
										<?php $_SESSION['total'] =$total;?>

									<?php else:
										unset($_SESSION['total']);
									endif;  ?>

								</div>

								<?php if($CARTROWS):?>
									<div  class= "d-flex justify-content-end">
										<a href="<?=ROOT?>shop" class=" btn btn-outline-warning mx-2  " style="color:#62ab00;"><i class="bi bi-arrow-left-circle-fill m-1"></i> Continue Shopping</a> <span>
										<a href="<?=ROOT?>checkout" id="paybtn"  class=" btn btn-outline-success text-light" style="background-color:#62ab00;">Checkout<i class="bi bi-arrow-right-circle-fill m-1"></i></a> </span>
									</div>
								<?php endif; ?>




							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- Cart Page End -->

<?php 
	include 'footer.php';