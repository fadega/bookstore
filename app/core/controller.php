<?php

// this is the base controller class that all other controllers extend from
class Controller {

 //Method to load a view and pass param data if it exists
  protected function view($view, $data = []) {
      
      extract($data); //using this, we can access each element inside $data  can be echoed as a ssingle variable
      if(file_exists("../app/views/".$view.".php") ){
          include "../app/views/".$view.".php";
  
      } else {
          include "../app/views/store/404.php";
        }
  }

   //Method to load a model and returns model if it exists or false if it doesn't
  protected function loadModel($model) {
    if(file_exists("../app/models/". strtolower($model) . ".class.php")) {
        include "../app/models/".strtolower($model).".class.php";
              
        return $model = new $model();

    } else {
        return false;
      }
      

  }


}