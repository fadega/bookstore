<?php

 // class for handling ajax requests from book dashboard
class BookAjaxHandler extends  Controller{

    //defualt method
    function index(){

      if(count($_POST) > 0){
        $data = (object)$_POST;
      }else{
        $data = file_get_contents("php://input");
      }
  
      if(is_object($data) && isset($data->actionType)){

        $book = $this->loadModel('Book');
        if($data->actionType == "add_book"){
           
          $book->create($data, $_FILES);    
          //check if there is an error in the session
          if(isset($_SESSION['error']) && $_SESSION['error']!=""){
            
            $list['message']       = $_SESSION['error'];
            $_SESSION['error']    = "";
            $list['messageType']  = 'error';
            $list['data']          = "";
            $list['actionType']     = "add_book";
            echo json_encode($list);
  
          }else{
            //
            $list['message']      = "Book added successfully";
            $list['messageType'] = 'info';
            $list['actionType']    = "add_book";
            $books               = $book->getBooks();
            $list['data']         = $book->make_table($books);
            echo json_encode($list);
          }

        }elseif($data->actionType == "delete_book"){
          // if action type is delete_book, call deleteBook method from Book model
          $book->deleteBook($data->id);
          $list['message']       =  "Record deleted successfully!";
          $_SESSION['error']    =  ""; 
          $list['messageType']  =  'info';
          $list['actionType']     =  "delete_book";
          $books                =  $book->getBooks();
          $list['data']          =  $book->make_table($books);
          echo json_encode($list);

       }elseif($data->actionType == "edit_book"){
        // if action type is edit_book, call editBook method from Book model
        $book->editBook($data,$_FILES);
        $list['message']       = "Record updated successfully!";
        $_SESSION['error']    = "";
        $list['messageType']  = 'info';
        $list['actionType']     = "edit_book";
        $books                = $book->getBooks();
        $list['data']          = $book->make_table($books);
        echo json_encode($list);

      }
    }
  } 
}