<?php
//class to handle ajax requests from publisher page
class PublisherAjaxHandler extends Controller{
    public function index () {
       
        $data = file_get_contents("php://input");
        $data = json_decode($data); 
        // print_r($data);

        if(is_object($data) && isset($data->actionType)){
  
          //create instance of Category Model to access methods like create, editCategory, deleteCategory etc ..
          $publisher = $this->loadModel('Publisher');
  
          if($data->actionType == "add_new"){
             $publisher->create($data);
            // check if there is an error in the session
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $list['message'] = $_SESSION['error'];
              $_SESSION['error']=""; //unset session error
              $list['messageType'] = 'error';
              $list['data'] = "";
              $list['actionType'] = "add_new";

              echo json_encode($list);
    
            }else{
              //  if no error, set up success message, get publisher to refresh the table in the dashboard
              $list['message'] = "Publisher added successfully";
              $list['messageType'] = 'info';
              $publishers = $publisher->getPublishers();
              $list['data'] = $publisher->make_table($publishers);
              $list['actionType'] = "add_new";
      
              echo json_encode($list);
            }
  
          }elseif($data->actionType == "delete_row"){
            // if action type is delete_row, call deletePublisher method from Publisher model
            $publisher->deletePublisher($data->id);
            $list['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; //unset session error
            $list['messageType'] = 'info';
            $list['actionType'] = "delete_row";
            $publishers = $publisher->getPublishers();
            $list['data'] = $publisher->make_table($publishers);
            
             echo json_encode($list);
  
         }elseif($data->actionType == "edit_row"){
          // if action type is edit_row, call editPublisher method from Publisher model
            $publisher->editPublisher($data);
            $list['message'] = "Record updated successfully!";
            $_SESSION['error']=""; //unset session error
            $list['messageType'] = 'info';
            $list['actionType'] = "edit_row";
            $publishers = $publisher->getPublishers();
            $list['data'] = $publisher->make_table($publishers);

            echo json_encode($list);
  
       }
    
      }
    
    }

}

?>