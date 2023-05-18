<?php
// class to handle contact page
class Contact extends Controller {

    public function index () {

        $data["pageTitle"] = "Contact Us";
        
        //load the contact view and pass data
        $this->view("store/contact", $data);

    }

}

?>