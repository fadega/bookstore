<?php
// class to handle cart functionality - adding items to cart, removing items from cart, updating cart, etc
class Cart extends Controller{

    

 private $redirect_to ="";
    function index($id = ''){
        
        $this->set_redicrect(); 
        $id = addDashes($id);

        $conn = Database::newInstance();
        $CARTROWS = false;
        $book = $conn->read("SELECT *FROM book where id = :id limit 1",["id"=>$id]);

        //check if the book exists
        if($book){            
            $book = (object)$book[0]; 
            // check if it exists in the cart already
            if(isset($_SESSION['CART'])){
                $ids = array_column($_SESSION['CART'],'id');
                if(in_array($book->id, $ids )){
                    $key = array_search($book->id, $ids);
                    $_SESSION['CART'][$key]['qty']++;

                }else{
                    $list        = [];
                    $list['id']  = $book->id;
                    $list['title'] =  $book->title;   
                    $list['price'] =  $book->price;   
                    $list['qty'] = 1;       
                    $_SESSION['CART'][]  = $list;

                }

            }else{ //it means it's not in the cart already
                
                $list        = [];
                $list['id']  = $book->id;
                $list['title'] =  $book->title;   
                $list['price']  = $book->price;
                $list['qty'] = 1;       
                $_SESSION['CART'][]  = $list;
            }
        }
        $book_ids = [];
        if(isset($_SESSION['CART'])){
            $book_ids = array_column($_SESSION['CART'],'id');
            $str_ids = "'" . implode("','", $book_ids) ."'";
            $CARTROWS = $conn->read("SELECT *FROM book WHERE id in ($str_ids)");            
        }
            
        if(is_array($CARTROWS)){  
            foreach ($CARTROWS as $key => $row) {
                foreach($_SESSION['CART'] as $item){
                    if($row['id'] == $item['id']){
                        $CARTROWS[$key]['cart_qty'] = $item['qty'];
                        break;
                    }
                } 
            }
        }
      
        $data["pageTitle"] = "Shopping Cart";
        $data['CARTROWS'] =  $CARTROWS;
        $_SESSION['CART_ITEMS'] = $CARTROWS;;
        
        $this->view("store/cart",$data);
   
        
    }
    // add quantity when the plus button is clicked
    public function add_quantity($id = ''){
        $this->set_redicrect();
       $id = addDashes($id);
       if(isset($_SESSION['CART'])){
           foreach($_SESSION['CART'] as $key =>$item){
            if($item['id'] == $id){ // item found
                $_SESSION['CART'][$key]['qty']+= 1; // increment quantity
;
                break;
            }
           }
       }

       $this->redirect();

    }
    // subtract quantity when the minus button is clicked
    public function subtract_quantity($id = ''){
        $this->set_redicrect();
        $id = addDashes($id);
       if(isset($_SESSION['CART'])){
           foreach($_SESSION['CART'] as $key =>$item){
            if($item['id'] == $id){ // item found 
                if( $_SESSION['CART'][$key]['qty']>1){
                    $_SESSION['CART'][$key]['qty']-= 1;//decrement quantity
                    break;
                }else if($_SESSION['CART'][$key]['qty'] == 1){
                        break;
                }
                break;          
            }
           }
       }
       $this->redirect();
    }

    // remove item from cart
    public function remove($id = ''){
        $this->set_redicrect();
        $id = addDashes($id);
        if(isset($_SESSION['CART'])){
            foreach($_SESSION['CART'] as $key =>$item){
             if($item['id'] == $id){ // item found 
                unset($_SESSION['CART'][$key]);   // remove
                $_SESSION['CART'] = array_values($_SESSION['CART']); 
                 break;
             }
            }
        }
        $this->redirect();
    }
 private function redirect(){        
    header("location:" .ROOT.'cart');  
 }

 private function set_redicrect(){
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !="" ){
            $this->redirect_to = $_SERVER['HTTP_REFERER'];
        }else{
            $this->redirect_to = ROOT."shop";
        }
 }




}