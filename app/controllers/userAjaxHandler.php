<?php
// class to handle user ajax requests - not fully implemented
class UserAjaxHandler extends Controller{

    public function index () {
       
        $data = file_get_contents("php://input");
        $data = json_decode($data); 
        // print_r($data);

        if(is_object($data) && isset($data->actionType)){
  
          //create instance of Category Model to access methods like create, editCategory, deleteCategory etc ..
          $user = $this->loadModel('User');
  
          if($data->actionType == "add_new"){
             $user->create($data);
      
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $list['message'] = $_SESSION['error'];
              $_SESSION['error']=""; //unset session error
              $list['messageType'] = 'error';
              $list['data'] = "";
              $list['actionType'] = "add_new";

              echo json_encode($list);
    
            }else{
              
              $list['message'] = "user added successfully";
              $list['messageType'] = 'info';
              $users = $user->getUsers();
              $list['data'] = $user->make_table($users);
              $list['actionType'] = "add_new";
      
              echo json_encode($list);
            }
  
          }elseif($data->actionType == "delete_row"){
  
            $user->deleteUser($data->id);
            $list['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; //unset session error
            $list['messageType'] = 'info';
            $list['actionType'] = "delete_row";
            $users = $user->getUsers();
            $list['data'] = $user->make_table($users);
            
   
             echo json_encode($list);
  
         }elseif($data->actionType == "edit_row"){
  
            $user->editUser($data);
            $list['message'] = "Record updated successfully!";
            $_SESSION['error']=""; //unset session error
            $list['messageType'] = 'info';
            $list['actionType'] = "edit_row";
            $users = $user->getUsers();
            $list['data'] = $user->make_table($users);
            
    
            echo json_encode($list);
  
       }
    
      }
    
    }

}

?>