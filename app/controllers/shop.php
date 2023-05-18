<?php
// class to handle shop page
class Shop extends Controller{

    public function index () {

          //check if search was made 
          $search = false;
          $find = '';
          if(isset($_GET['find'])){
              $find = addslashes($_GET['find']);
              $search = true;
          }
     
         $user = $this->loadModel('user');
         $user_info = $user->loginStatus();
         if(is_array($user_info)){
             $data['email'] =   $user_info['email'];
             $data['name']       =   $user_info['name'];
             $data['role']       =   $user_info['role'];
             $data['userid']     =   $user_info['userid'];
             
         }
         // get all categories
         $conn =  Database::newInstance();
         $sql= "SELECT *FROM category order by id ";
         $categories = $conn->read($sql,[]);
         if(count($categories) !== 0){
             $data['categories'] = $categories;
         }
 
         //read books to display in home
          $conn = Database::newInstance();
         if($search){
          
             $list['slug'] = "%".$find."%"; 
             $query = "SELECT *FROM book WHERE slug like :slug";
             $BOOKS = $conn->read($query,$list);
             $data['item_searched'] = true;
         }else{
             $BOOKS = $conn->read("SELECT *FROM book"); 
         }
 
         $data['BOOKS'] = $BOOKS;   
 
 
        $data["pageTitle"] = "Shop";
        $data['search'] = true;
        //load the shop view
         $this->view("store/shop",$data);
    }

}

?>