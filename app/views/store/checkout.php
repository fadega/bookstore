<?php
 
    $this->view("store/header",$data);


   if (isset($_SESSION['CART_ITEMS']) && $_SESSION['CART_ITEMS'] !="" ) {
      
    $items = $_SESSION['CART_ITEMS'];

    $price     = [];
    $book      = [];
    $unitprice = [];
    $quantity  = [];

    $total =0;
    for($i=0; $i < count($items); $i++){
        $price[$i]= $i;
        $book[$i] =$i;
        $unitprice[$i] =$i;
        $quantity[$i]=$i;
    }
   
     for ($count = 0; $count < count($items); $count++) {
        $price[$count] += $items[$count]['cart_qty'] * $items[$count]['price'];
        $book[$count] = $items[$count]['title'];
        $unitprice[$count] = $items[$count]['price'];
     }  
          
    //generate an array of book and price
    $cart_items = array_combine($book,$price);

    $_SESSION['checkout'] = $cart_items;

    foreach($cart_items as $name => $price){
        // $total += $price;
    }
    $count = 0;
    foreach($items as $key => $item){
        $quantity[$count] = $item['cart_qty'];
        $count++;
    }
    //generate an array of quantity and items in cart
    $combined = array_combine($quantity,$cart_items);

    $name_qty_price = [];
    foreach($cart_items as $name =>$tatolPrice){
        foreach($combined as $items){
            $name_qty_price[$name] = $items;
        }
    }      
   }

?>


<div class="container" style="max-width: 1000px;">
  <?php if(isset($_SESSION['CART_ITEMS']) && $_SESSION['CART_ITEMS'] !="" && count($cart_items)>0):?>
    <div class="py-5 text-center">
        <h2>Order Detailes</h2>
        <p class="lead">Proceed to checkout with paypal.</p>
    </div>
    <div class="row">
        <div class="col-md-8 order-md-1 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">On your cart</span>  
            </h4>
            <ul class="list-group mb-3 sticky-top">
            <?php foreach($cart_items as $name=> $price):?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-2"><?=$name?></h6>
                        <small class="text-muted">Standard price</small>
                    </div>
                    <span class="text-muted">$<?=$price?></span>
                </li>
                <?php endforeach;?>          
                <li class="list-group-item d-flex justify-content-between">
                    <?php if(isset($_SESSION['total']) && $_SESSION['total'] != "" ):?>
                    <span>Total (USD)</span>
                    <div class="d-flex flex-end" style="margin-right:-20px;">
                      <span class="fw-bold">$</span>
                      <input type="text" id="shownamount" name="shownamount" class="border border-0 fw-bold " style="width:70px;" aria-labelledby="shownamount" readonly  value="<?=$_SESSION['total']?>"/>
                    </div>                   
                    <?php endif; ?>
                </li> 

                <li class="list-group-item d-flex justify-content-between">
                    <?php if(isset($_SESSION['total']) && $_SESSION['total'] != "" ):?>
                    <div class="d-flex flex-end">
                      <input type="text" id="amount" name="amount" class="border border-0 fw-bold small " style="width:70px; color:white;" aria-labelledby="amount" readonly  value="<?=$_SESSION['total']?>"/>
                    </div>
                   <?php endif; ?>
                </li> 
            </ul>
        </div>
        <div class="col-md-4 order-md-2 mb-5" >
            <h4 class="mb-3" style="margin-bottom: 100px;" >Checkout with Paypal</h4> 
            <p class="mb-3 text-muted fst-italic" style="margin-bottom: 100px;"> Card | Bank</p>
            
            <div id="paypal-payment-button"></div>
        </div>
    </div>
    <?php else:?>
        <div class="text-center">
            <h5 class="text-danger" style="margin:100px 0px;">Shame! Add books to cart before checkout</h5>
        </div>
    <?php endif;?>

</div>
<script src="https://www.paypal.com/sdk/js?client-id=AUJrv_n9DmsOQzciAmGHafqTpurxzsmCN_ziHD5xc5OzNjfUnkCiU0aiqy2LItimZn9Fq5SBJo4Jpfp_&disable-funding=credit,card"></script>


<script>

//Amount paid 
var total=0;
let amount  = document.querySelector("#amount").value.trim();

if(amount != "" && !isNaN(amount)){
    total = amount;
    console.log("Total = ",total);
}

//Payapl Button 

txn_details = {};
paypal.Buttons({
    style : {
        color: 'gold',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: total
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            const isObject = function(val){
                if(val === null){
                    return false
                }
                return (typeof val==='object')                     
            }
            const getObjProps = function(obj){

                for(let prop in obj){
                    alert(prop)
                    if(isObject(obj[prop])){
                    getObjProps(obj[prop])
                    }else{
                        txn_details[prop] = obj[prop]
                    }  
                };

            };
            getObjProps(details)
            send_data(txn_details)

            if(details !=null){ 
                <?php unset($_SESSION['CART']); ?>
            }
            window.location.replace("<?=ROOT?>success")
            
        })
        
    },
    onCancel: function (data) {
        window.location.replace("<?=ROOT?>transactionfailed")
    }
}).render('#paypal-payment-button');

function send_data(tdetails){
    for (const [key, value] of Object.entries(tdetails)) {
        console.log(`${key}: ${value}`);
}
}


</script>

<?php  
   $this->view("store/footer",$data); 
?>