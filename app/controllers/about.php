<?php

// controller class for about page
class About extends Controller {
    public function index () {
        $data["pageTitle"] = "About Us";
        //load the about view and pass data
        $this->view("store/about", $data);
    }
}
?>