<?php
/**
 * Routes the user to checkout page
 */
class Checkout extends  Controller{

    function index(){   
       $data["pageTitle"] = "Checkout";    
        //load checkout view
        $this->view("store/checkout",$data);
    }  
}