<?php

class CategoryAjaxHandler extends Controller{

     /**
     *  defualt method - gets the categories from the input fields and passes them to a proper model
     * to execute the required operation (create, delete, edit )
     */

    public function index () {
       
        $data = file_get_contents("php://input");
        $data = json_decode($data); 
        
        if(is_object($data) && isset($data->actionType)){
  
          //create instance of Category Model to access methods like create, editCategory, deleteCategory etc ..
          $category = $this->loadModel('Category');
  
          if($data->actionType == "add_new"){
           
            //add new category
            // $check = $category->create($data);
             $category->create($data);
            // check if there is an error in the session
            if(isset($_SESSION['error']) && $_SESSION['error']!=""){
              
              $list['message'] = $_SESSION['error'];
              $_SESSION['error']=""; 
              $list['messageType'] = 'error';
              $list['data'] = "";
              $list['actionType'] = "add_new";
    
              echo json_encode($list);
    
            }else{
              // if no error, set up success message, get categories to refresh the table in the dashboard
              $list['message']     = "Category added successfully";
              $list['messageType'] = 'info';
              $list['actionType']  = "add_new";
              $cats                = $category->getCategories();
              $list['data']        = $category->make_table($cats);
              
              echo json_encode($list);
            }
  
          }elseif($data->actionType == "delete_row"){
            // if action type is delete_row, call deleteCategory method from Category model
            $category->deleteCategory($data->id);
            $list['message'] = "Record deleted successfully!";
            $_SESSION['error']=""; 
            $list['messageType'] = 'info';
            $list['actionType'] = "delete_row";
            $cats = $category->getCategories();
            $list['data'] = $category->make_table($cats);
            
   
             echo json_encode($list);
  
         }elseif($data->actionType == "edit_row"){
          // if action type is edit_row, call editCategory method from Category model
          $category->editCategory($data->id,$data->category);
          $list['message'] = "Record updated successfully!";
          $_SESSION['error']=""; 
          $list['messageType'] = 'info';
          $list['actionType'] = "edit_row";
          $cats = $category->getCategories();
          $list['data'] = $category->make_table($cats);
          
  
           echo json_encode($list);
  
       }
    
      }
    
    }

}

?>