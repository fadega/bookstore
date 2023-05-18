<?php
// class to loads the view when transaction fails
class TransactionFailed extends  Controller{

    //defualt method
    function index(){
        
       $data["pageTitle"] = "Failed";
       // load the failed view and pass data
        $this->view("store/transactionfailed",$data);
      
    }

   
}