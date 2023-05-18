
<?php

$this->view("store/header",$data);

?>


     <style>

     .payment
	    {
		    border:1px solid #bd0018;
		    height:280px;
            border-radius:5px;
            background:#fff;
	    }
       .payment_header
       {
	       background:#bd0018;
	       padding:20px;
           border-radius:5px 5px 0px 0px;
	   
       }
   
       .check
       {
	       margin:0px auto;
	       width:50px;
	       height:50px;
	       border-radius:100%;
	       background:#fff;
	       text-align:center;
       }
   
       .check i
       {
	       vertical-align:middle;
	       line-height:50px;
	       font-size:30px;
       }

        .content 
        {
            text-align:center;
        }

        .content  h1
        {
            font-size:25px;
            padding-top:25px;
        }

        .content a
        {
            width:200px;
            height:40px;
            color:#fff;
            border-radius:30px;
            padding:10px 10px;
            background:#62ab00;
            transition:all ease-in-out 0.3s;
        }

        .content a:hover
        {
            text-decoration:none;
            background:#000;
        }
   
    </style>
  </head>


  <body>
    


<div class="container">
   <div class="row">
      <div class="col-md-6 mx-auto mt-5">
         <div class="payment">
            <div class="payment_header">
               <div class="check"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
            </div>
            <div class="content">
               <h1>Oops!</h1>
               <p class="mb-2">The transaction is cancelled. Head back to ... </p>
               <a class="p-2 m-3" href="<?=ROOT?>checkout"> Checkout</a>
            </div>
            
         </div>
      </div>
   </div>
</div>



<?php

$this->view("store/footer",$data);

?>












