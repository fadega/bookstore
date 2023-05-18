<?php
// model class for publisher
class Publisher{
    
   // method to create a new publisher
    public function create($data){

       $_SESSION['error'] = "";
       $conn              = Database::db_connect();
       $pubdata           = [];
       $pubdata['publisherName']   = $data->publisherName;
      //check if publisher name is valid
       if(!preg_match("/^[a-zA-Z ]+$/",trim($pubdata['publisherName']))){
           $_SESSION['error'] = "Please enter valid publisher name";

       }
       if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {

            //check if the Publisher already exists
           $sql = "SELECT publisherName FROM publisher where publisherName = :publisherName";
           $list['publisherName'] = $pubdata['publisherName'];
           $check1 = $conn->read($sql,$list);
           if (is_array($check1) && count($check1) >=1) {
               $_SESSION['error']="ERROR: Duplicate Record";
               return false;
           } 

            //no duplicate record found
            $query = "INSERT INTO publisher (publisherName) VALUES (:publisherName)";
            $check = $conn->write($query,$pubdata);
            if ($check) {
                return true;
            }
            $_SESSION['error'] = "Problem writing data to database";     
       }
    }
 // Function to update Publisher
    public function editPublisher($data){
        
      $conn                 =  Database::newInstance();
      $list                 = [];
      $id                   = (int)$data->id;
      $list['id']           = $id;
      $list['publisherName']= $data->publisherName;
         
      $query                = "UPDATE publisher SET publisherName = :publisherName WHERE id = :id limit 1 ";
      $conn->write($query,$list); 
        
    }

    // Function to delete Publisher
    public function deletePublisher($id){
      $conn =  Database::newInstance();
      $id = (int)$id;
      $query = "DELETE FROM publisher WHERE id ='$id' limit 1 ";
      $conn->write($query); 
        
    }
    // Function to get all Publishers
    public function getPublishers(){
        $conn =  Database::newInstance();
        return $conn->read("SELECT *FROM publisher order by publisherName asc");        
    }

    // Function to generate table on the fly
    function make_table($publishers){
        $result="";

        if(is_array($publishers)){
          foreach ($publishers as $publisher) {
            $args = $publisher["id"];
            $publisher = (object) $publisher;

            $info = array();
            $info['id'] = $publisher->id;
            $info['publisherName'] = $publisher->publisherName;

             //convert json to string
             $info = json_encode($info);
             $info =  str_replace('"',"'",json_encode($info));

            $result .= "<tr>";
         
              $result.='                    
                   <td  class="text-dark">'.$publisher->id.'</td>
                   <td class="text-dark">'.$publisher->publisherName .'</td>
                  
                   <td>
                       <button info = "'.$info.'" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#editPublisherModal" onclick="edit_record('.$args.', event)"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-xs"  onclick="delete_record(event,'.$publisher->id.')"><i class="fa fa-trash-o "></i></button>
                   </td>';
         
            $result.= "</tr>";
  
          }
    
  
        }
        return $result;
      }   
}

