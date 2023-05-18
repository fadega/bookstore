<?php

// $this->view("store/adminheader",$data);
$this->view("store/header",$data);
// display($data);
?>
		<!-- section-element-area-start -->
		<div class="section-element-area ptb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="entry-header text-center mb-20">
							<img src="<?=ASSETS?>store/image/404.jpg" alt="not-found-img" />
						</div>
						<div class="entry-content text-center mb-30">
							<p class="mb-50">Oops! That page can’t be found.</p>
							<p>Sorry, but the page you are looking for is not found. Please, make sure you have typed the current URL.</p>
							<a href="<?=ROOT?>">GO BACK</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php

// $this->view("store/adminheader",$data);
$this->view("store/footer",$data);
// display($data);
?>