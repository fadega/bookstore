<?php

//This view is not client facing  - admin section only

$db = new Database();
$conn = $db->db_connect();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DENSA BOOK STORE - <?=$data["pageTitle"];?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=ASSETS?>admin/css/bootstrap.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!--external css-->
    <link href="<?=ASSETS?>admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?=ASSETS?>admin/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?=ASSETS?>admin/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?=ASSETS?>admin/lineicons/style.css">   
    
    <!-- Flatpicker  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">    
    
    <!-- Custom styles for this template -->
    <link href="<?=ASSETS?>admin/css/style.css" rel="stylesheet">
    <link href="<?=ASSETS?>admin/css/style-responsive.css" rel="stylesheet">

    <script src="<?=ASSETS?>admin/js/chart-master/Chart.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg bg-dark">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?=ROOT?>admin" class="logo"><b>DENSA BOOK STORE</b></a>
            <!--logo end-->
            
            <div class="top-menu mt-20 pull-right" style="margin-top:10px;margin-right:100px;">
            	
                <?=ucwords($data['name'])?> 
                <div class="btn-group" >
                
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-duotone fa-caret-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <ul>
                            <li><a class="dropdown-item" href="<?=ROOT?>profile">Profile </a></li>
                            <li><a class="dropdown-item" href="<?=ROOT?>signout">Logout</a></li>
                            <li><a class="dropdown-item" href="<?=ROOT?>">Home</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </header>
      <!--header end-->