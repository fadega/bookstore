<?php

//Class that handles all the ajax requests from the author page - add, edit, delete
class AuthorAjaxHandler extends Controller{

    public function index () {
       
      //get data from ajax request
        $data = file_get_contents("php://input");
        $data = json_decode($data); 
  
        if(is_object($data) && isset($data->actionType)){
  
          //create instance of Author Model to access methods like create, editAuthor, deleteAuthor etc ..
          $author = $this->loadModel('Author');
  
          if($data->actionType == "add_new"){
             $author->create($data);
            
             //check if there is an error in the session
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $list['message'] = $_SESSION['error'];
              $_SESSION['error']=""; //unset session error
              $list['messageType'] = 'error';
              $list['data'] = "";
              $list['actionType'] = "add_new";

              echo json_encode($list);
    
            }else{
              //if no error, set up success message, get authors to refresh the table in the dashboard
              $list['message'] = "Author added successfully";
              $list['messageType'] = 'info';
              $authors = $author->getAuthors();
              $list['data'] = $author->make_table($authors);
              $list['actionType'] = "add_new";
      
              echo json_encode($list);
            }
  
          }elseif($data->actionType == "delete_row"){
            // if action type is delete_row, call deleteAuthor method from Author model
            $author->deleteAuthor($data->id);
            $list['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; //unset session error
            $list['messageType'] = 'info';
            $list['actionType'] = "delete_row";
            $authors = $author->getAuthors();
            $list['data'] = $author->make_table($authors);
            
   
             echo json_encode($list);
  
         }elseif($data->actionType == "edit_row"){
            // if action type is edit_row, call editAuthor method from Author model
            $author->editAuthor($data);
            $list['message'] = "Record updated successfully!";
            $_SESSION['error']=""; //unset session error
            $list['messageType'] = 'info';
            $list['actionType'] = "edit_row";
            $authors = $author->getAuthors();
            $list['data'] = $author->make_table($authors);
            
    
            echo json_encode($list);
  
       }
    
      }
    
    }

}

?>