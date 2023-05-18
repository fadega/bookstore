<?php

//class to handle a user signout 
class Signout extends  Controller{

    //defualt method
    function index(){
        
        //no view of a signout page, simply call the logout function
        $user = $this->loadModel('user');
        $user->signout(); 
    }
}