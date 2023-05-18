<?php

// class to handle profile functionality - updating profile, deleting profile, etc
class Profile extends Controller{

     function index(){
           // check if user is logged in
           $user = $this->loadModel('user');
           $userdata = $user->loginStatus(true);
           if(is_array($userdata)){
                //collect user data to pass to profile view
                $data['email']  = $userdata['email'];
                $data['name']        = $userdata['name'];
                $data['role']        = $userdata['role'];
                $data['userid']      = $userdata['userid'];
                $data['phone']       = $userdata['phone'];
                $data['address']     = $userdata['address'];
                
           }

        //you can do this if passing data to view
         
        if(isset($_SESSION['logged'])){
            $data["pageTitle"] = "Profile";
            $data['role'] = $_SESSION['logged']['role'];
            if($_SESSION['logged']['role']=="customer"){
                $this->view("store/profile",$data);
            } else if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/profile",$data);
            }
            
        }else{
            $data=[];
            $data["pageTitle"] = "Home Page";
            $this->view("store/index",$data);
            die;
        }
        
    }
    // function to delete user profile
    function deleteAccount(){

        $user = $this->loadModel('user');
        $userdata = $user->loginStatus(true);
        if(is_array($userdata)){
                //collect user data to pass to profile view
             $data['email']    = $userdata['email'];
             $data['name']     = $userdata['name'];
             $data['role']     = $userdata['role'];
             $data['userid']   = $userdata['userid'];
             $data['phone']    = $userdata['phone'];
             $data['address']  = $userdata['address'];
              
        }

        $data["pageTitle"] = "Profile";

        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="customer"){
               $user->deleteProfile($data['email']);
               $this->view("store/index",$data);
            } else if($_SESSION['logged']['role']=="admin"){
                // don't delete admin profile
                $this->view("store/404",$data);
            }
            
        }

    }




}