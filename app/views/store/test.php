        <div  class= "d-flex justify-content-end my-5">
            
            <?php if($CARTROWS):?>
                <h4 class=" mx-2 ">Total:</h4> <span>
                <?php $total = 0; 
                foreach($CARTROWS as $row):?>
                    <?php $total += $row['cart_qty'] * $row['price'] ; ?>
                    
            <?php endforeach; ?>
                
                <h4 class= "me-2"> $ <?=$total?></h4> </span>
                <?php $_SESSION['total'] =$total;?>

            <?php else:
                unset($_SESSION['total']);
            endif;  ?>
                

        </div>
        <?php if($CARTROWS):?>
            <div  class= "d-flex justify-content-end">
                <a href="<?=ROOT?>shop" class=" btn btn-outline-warning mx-2  " ><i class="bi bi-arrow-left-circle-fill m-1"></i> Continue Shopping</a> <span>
                <a href="<?=ROOT?>checkout" id="paybtn"  class=" btn btn-outline-success text-dark" style="background-color:#06d6a0;">Checkout<i class="bi bi-arrow-right-circle-fill m-1"></i></a> </span>
            </div>
        <?php endif; ?>