<?php  $this->view("store/header",$data);?>
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?=ROOT?>index">Home</a></li>
							<li class="breadcrumb-item active">Login</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!--=============================================
    =            Login Register page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
						<form method="post">
							<div class="login-form">
								<h3 class="login-title text-center">Login</h3>
								<p><span class="font-weight-small">Login to your account</span></p>
								<?php  if(isset($_SESSION['error'])):?>
								<span class="text-danger"> <?php echo $_SESSION['error'];?></span>
								<?php endif;?>
								<div class="row">
									<div class="col-md-6 col-6 mb--15">
										<input name="email" class="mb-0 form-control" type="email" id="email1" value="<?=isset($_POST['email']) ? $_POST['email'] : ""?>"
											placeholder="Email...">
									</div>
									<div class="col-md-6  col-6 mb--20">
										<input name="password" class="mb-0 form-control" type="password" id="login-password" value="<?=isset($_POST['password']) ? $_POST['password'] : ""?>" placeholder="password...">
									</div>
									<div class="form-check d-flex justify-content-start mb-4">
										<input
											class="form-check-input me-2"
											type="checkbox"
											name="keepmesigned"
											id="terms" style="margin-left:-0.5em; width: 15px; height:15px;"/>
										<label class="form-check-label" for="terms">
											<a href="#!" class="text-body"><u>Remember me</u></a>
										</label>
									</div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-outlined">Login</button>
									</div>
									<div class="col-md-6 mt--15">
										<p>Don't have an account? <a href="<?=ROOT?>register" class="text-body"><u class="text-success">register</u></a></p> 
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>
<?php  $this->view("store/footer",$data);;?>