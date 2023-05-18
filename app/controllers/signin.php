<?php


// class to handle a user signin request
class Signin extends Controller{

    function index(){

        //you can do this if passing data to view
       $data["pageTitle"] = "Signin";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
           // load the user model
            $user = $this->loadModel("User");
            //call the signin method in the user model
            $user->signin($_POST);
            
        }
        // load the signin view and pass data
        $this->view("store/signin",$data);
        
    }


}