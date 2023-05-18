<?php include "header.php";?>
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?=ROOT?>">Home</a></li>
							<li class="breadcrumb-item active">Register</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!--=============================================
    =             Register page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row justify-content-center">
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0">
						<!-- Login Form s-->
						<form method="post">
							<div class="login-form">
								<h4 class="login-title">New Customer</h4>
								<p><span class="font-weight-small">I am a new customer</span></p>
								<span class="text-danger"> <?php errorMessage();?></span>
								<div class="row">
									<div class="col-lg-6  mb--15">
										<input name="name" class="mb-0 form-control" type="text" id="name"
										value="<?=isset($_POST['name']) ? $_POST['name'] : ""?>" placeholder="Name...">
									</div>
									<div class="col-lg mb--20">
										<input name="email" class="mb-0 form-control" type="email" id="email" value="<?=isset($_POST['email']) ? $_POST['email'] : ""?>" placeholder="Email...">
									</div>
									<div class="col-lg-6 2 mb--15">
										<input type="tel" id="phone" class="mb-0 form-control" name="phone" value="<?=isset($_POST['phone']) ? $_POST['phone'] : ""?>"  placeholder="Phone..." required>
									</div>
									<div class="col-lg-6 mb--20">
										<input name="address" class="mb-0 form-control" type="address" id="address" value="<?=isset($_POST['address']) ? $_POST['address'] : ""?>" placeholder="Address..">
									</div>
									<div class="col-lg-6 mb--20">
										<input name="password" class="mb-0 form-control" type="password" id="password" value="<?=isset($_POST['password']) ? $_POST['password'] : ""?>" placeholder="password...">
									</div>
									<div class="col-lg-6 mb--20">
										<input name="password2" class="mb-0 form-control" type="password" id="repeat-password" value="<?=isset($_POST['password2']) ? $_POST['password2'] : ""?>" placeholder="Repeat  password...">
									</div>
									<div class="form-check d-flex justify-content-start mb-4">
										<input
											class="form-check-input me-2"
											type="checkbox"
											value="checked"
											name="termscheck"
											style="margin-left:-0.5em; width: 15px; height:15px;"/>
										<label class="form-check-label" for="form2Example3g">
											I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
										</label>
									</div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-outlined">Register</button>
									</div>
									<div class="col-md-6 mt--15">
										<p>Already registered? <a href="<?=ROOT?>signin" class="text-body"><u class="text-success">Signin</u></a></p> 
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>
<?php include "footer.php";?>