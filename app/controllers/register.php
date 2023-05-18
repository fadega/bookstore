<?php
// class to handle a user registration request
class Register extends Controller {

    public function index () {

        $data["pageTitle"] = "Register";
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $this->loadModel("User");
            $user->register($_POST);
        }
        // load the register view and pass data
        $this->view("store/register",$data);
    }
}

?>