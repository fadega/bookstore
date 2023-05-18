<?php
// model class for author
class Author{
    
   // method to create a new author
    public function create($data){

       $_SESSION['error']= "";
       $conn             = Database::db_connect();
       $authordata       = [];
       $authordata['name']   = $data->name;
       $authordata['email']  = $data->email;
      //check if name is valid
       if(!preg_match("/^[a-zA-Z ]+$/",trim($authordata['name']))){
           $_SESSION['error'] = "Please enter valid author name0";

       }
       //check if email is valid
       if(!preg_match("/^[a-zA-Z0-9_-]+.+@[a-zA-Z]+.[a-zA-Z]+$/",$authordata['email'])){
        $_SESSION['error'] = "Please enter valid email";

        }

       if (!isset($_SESSION['error']) || $_SESSION['error']=="") {

            //check if the author already exists
           $sql = "SELECT email FROM author where email = :email limit 1";
           $list['email'] = $authordata['email'];
           $check1 = $conn->read($sql,$list);
    
           if (is_array($check1) && count($check1) >=1) {
               $_SESSION['error']="ERROR: Duplicate Record";
               return false;
           } 

            //if it gets in here, no duplicate record found
            $query = "INSERT INTO author (name,email) VALUES (:name,:email)";
            $check = $conn->write($query,$authordata);
            if ($check) {
                return true;
            }
            $_SESSION['error'] = "Problem writing data to database";
  
       }
    }
    // Function to edit author
    public function editAuthor($data){
        
      $conn          =  Database::newInstance();
      $list          = [];
      $id            = (int)$data->id;
      $list['name']  = $data->name;
      $list['email'] = $data->email;
      $list['id']    = $id;
    
      $query = "UPDATE authro SET categoryName = :category,email =:email WHERE id = :id limit 1 ";
      $conn->write($query,$list); 
        
    }

    // Function to delete author
    public function deleteAuthor($id){
      $conn   =  Database::newInstance();
      $id     = (int)$id;
      $query  = "DELETE FROM author WHERE id ='$id' limit 1 ";
      $conn->write($query); 
        
    }
    // Function to get all authors
    public function getAuthors(){
        $conn =  Database::newInstance();
        return $conn->read("SELECT *FROM author order by name asc");        
    }

    // Function to generate the author table on dashboard
    function make_table($authors){
        $result="";

        if(is_array($authors)){
          foreach ($authors as $author) {
            $args = $author["id"];
            $author = (object) $author;
          
            $result .= "<tr>";
         
              $result.='                    
                   <td  class="text-dark">'.$author->id.'</td>
                   <td class="text-dark">'.$author->name .'</td>
                   <td  class="text-dark">'.$author->email .'</td>
                  
                   <td>
                       <button class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#editAuthorModal" onclick="edit_record('.$args.')"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-xs"  onclick="delete_record(event,'.$author->id.')"><i class="fa fa-trash-o "></i></button>
                   </td>';
         
            $result.= "</tr>";
  
          }
        }
        return $result;
  
      }
} 

