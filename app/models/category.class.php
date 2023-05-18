<?php
// model class for category
class Category{
    
   // method to create a new category
    public function create($data){
       $_SESSION['error']="";
       $conn =  Database::db_connect();
       $list['category'] = ucwords($data->category);
      // validate category name 
       if(!preg_match("/^[a-zA-Z\\/ \\+\\-\\(\\)]+$/",trim($list['category']))){
           $_SESSION['error'] = "Please enter valid category name";
       }
       if (!isset($_SESSION['error']) || $_SESSION['error']=="") {
            //check if the category already exists
           $sql = "SELECT *FROM category where categoryName = :category";
           $check1 = $conn->read($sql,$list);
           if (is_array($check1) && count($check1) >=1) {
               $_SESSION['error']="ERROR: Duplicate Record";
               return false;
           } 

            //no duplicate record found
            $query = "INSERT INTO category (categoryName) values(:category)";
            $check = $conn->write($query,$list);
            if ($check) {
                return true;
            }        
       }

    }
    // function to edit category
    public function editCategory($id,$categoryname){

      $conn =  Database::newInstance();
      $list['id'] = (int)$id;
      $list['category'] = $categoryname;
      $query = "UPDATE category SET categoryName = :category WHERE id = :id limit 1 ";
      $conn->write($query,$list); 
    
    }

    // function to delete category
    public function deleteCategory($id){
      $conn =  Database::newInstance();
      $id = (int)$id;
      $query = "DELETE FROM category WHERE id ='$id' limit 1 ";
      $conn->write($query); 
        
    }
    // function to get all categories
    public function getCategories(){
        $conn =  Database::newInstance();
       
        return $conn->read("SELECT *FROM category order by categoryName asc");        
    }

    // function to generate a table on the fly
    function make_table($cats){
        $result="";

        if(is_array($cats)){
          foreach ($cats as $cat_row) {
            $cat_row = (object) $cat_row;
            $args = $cat_row->id. ",'". $cat_row->categoryName."'";
         
            $result .= "<tr>";
         
              $result.='                    
                   <td><a href="#" class="text-dark">'.$cat_row->id.'</a></td>
                   <td><a href="#" class="text-dark">'.$cat_row->categoryName .'</a></td>
                  
                   <td>
                       <button class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#editCategoryModal" onclick="edit_record('.$args.')"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-xs"  onclick="delete_record(event,'.$cat_row->id.')"><i class="fa fa-trash-o "></i></button>
                   </td>';
         
            $result.= "</tr>";
  
          }
        }
        return $result;
  
      }

}

