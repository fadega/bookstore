<?php

// class to boostrap the web app - it's the main class that handles all the requests and routes them to the appropriate controller
class App {
  
  //default controller, method and params
   private  $controller = "home";
   private  $method = "index";
   private  $params = [];
    
   public function __construct()  {
     $url = $this->dissectURL();
    //check if the controller exists- from the url
     if(file_exists("../app/controllers/".strtolower($url[0]).".php")){
       $this->controller = strtolower($url[0]);
       unset($url[0]);
     }
     require "../app/controllers/".$this->controller.".php"; 
     $this->controller = new $this->controller;
    
     //check if a method exists - from the url
    if(isset($url[1])) {
      if(method_exists($this->controller, strtolower($url[1]))){
        $this->method = $url[1];
        unset($url[1]);
      }
    }
    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method],$this->params);
  
   }
   //Function to dissect the url into its components
   private function dissectURL() {
    $url = isset($_GET['url']) ? $_GET['url'] :"home";
    return explode("/",filter_var(trim($url,"/"), FILTER_SANITIZE_URL));
   }
  }

?>