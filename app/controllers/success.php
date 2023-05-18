<?php

//this controller class calls the view method of the main "Controller" class to see if corresponding view exists 
class Success extends  Controller{

    function index(){
       $data["pageTitle"] = "Success";
        
       //unset the cart session
       unset($_SESSION['CART']);
        $this->view("store/success",$data);
      
    }

   
}