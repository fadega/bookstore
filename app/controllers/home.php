<?php

//class to handle home page functionality
class Home extends  Controller{

    function index(){
         //check if user searches a term  
         $search = false;
         $find = '';
         if(isset($_GET['find'])){
             $find = addslashes($_GET['find']);
             $search = true;
         }
         //load the user model
        $user = $this->loadModel('user');
        $userdata = $user->loginStatus();
        // check if user is logged in
        if(is_array($userdata)){
            $data['user_email'] =   $userdata['email'];
            $data['name']       =   $userdata['name'];
            $data['role']       =   $userdata['role'];
            $data['userid']     =   $userdata['userid'];
           
        }
        //get all categories to load them in the nav bar
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM category order by id ";
        $categories = $conn->read($sql,[]);
        if(count($categories) !== 0){
            $data['categories'] = $categories;
        }
        //get all books that are in the children's category 
       $sql = "SELECT * FROM book LEFT JOIN category ON book.category = category.id WHERE category.categoryName like 'child%' order by book.id desc"; 
       $CHILDREN = $conn->read($sql,[]);
       if(is_array($CHILDREN) && count($CHILDREN) !== 0 ){
            $data['CHILDREN'] = $CHILDREN;
        }

       // if user searches a term - this will be implemented later
        $conn = Database::newInstance();
        if($search){
        
            $list['slug'] = "%".$find."%"; 
            $query = "SELECT *FROM book WHERE slug like :slug";
            $BOOKS = $conn->read($query,$list);
            $data['item_searched'] = true;
        }else{
            $BOOKS = $conn->read("SELECT *FROM book"); //limit stuff
        }
        if(is_array($BOOKS) && count($BOOKS) !== 0){
            $data['BOOKS'] = $BOOKS;
        }else{
            $data['BOOKS'] = [];
        }
        if(isset($_SESSION['CART_ITEMS'])){
            $data['cart'] = $_SESSION['CART_ITEMS'];      
        }else{
            $data['cart'] = [];
        }

       $data["pageTitle"] = "Home";
       $data['search'] = true; //not implemented yet
       //load the home view - > index.php
        $this->view("store/index",$data);
    } 
}