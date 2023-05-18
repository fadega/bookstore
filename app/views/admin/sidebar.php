   
 
   <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?=ASSETS?>admin/images/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?=ucwords($data['name'])?></h5>
              	  <h5 class="centered" style="font-size:14px;"><?=$data['email']?></h5>	

 
                  <!-- <li class="sub-menu">
                    <a href="<?=ROOT?>admin" >
                      <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li> -->


                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/categories" >
                      <i class="fa fa-list-alt"></i>
                          <span>Categories</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?=ROOT?>admin/categories">View Categories</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/authors" >
                      <i class="fa fa-user"></i>
                          <span>Authors</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/publishers" >
                      <i class="fa fa-print"></i>
                          <span>Publishers</span>
                      </a>
                    </li>

                    <li class="sub-menu">
                      <a href="<?=ROOT?>admin/books" >
                      <i class="fa fa-book"></i>
                          <span>Books</span>
                      </a>
                  </li>
                  
                    
                  <li style="margin-top:20px;">
                    
                    <p> Future Enhancements</p>
                    <hr>
                  </li>
                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/users" >
                      <i class="fa fa-list-alt"></i>
                          <span>Users</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?=ROOT?>admin/users">View Categories</a></li>
                          <li><a  href="<?=ROOT?>admin/customers">View Categories</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/orders" >
                      <i class="fa fa-shopping-cart"></i>
                          <span>Orders</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/sales" >
                      <i class="fa fa-money"></i>
                          <span>Total Sales</span>
                      </a>
                  </li>
 
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>UI Elements</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="panels.html">Panels</a></li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->


    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT  - middle content
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> <?= ucwords($data['pageTitle'])?></h3>
          	<div class="row mt">
          		<div class="col-lg-12">
