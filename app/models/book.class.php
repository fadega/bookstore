<?php
/**
 * Undocumented class
 */
class Book{



    public function create($data, $files){ //I am not using $files because I am using function(uploadimages) to access the global $_FILES
       $_SESSION['error']="";
       $conn =  Database::db_connect();


       $book_data    = [];
       $images = uploadImage(); //custom function in function.pho

      //  display($images);die;

    //    foreach($images as $key =>$value){
    //      $book_data[$key] = $value;     //keys are image1 image2 image 2 and values are whatever images added
        
    //    }
        // print_r($images);


       $book_data['title']           = $data->title;
       $book_data['author']          = (int)$data->author;
       $book_data['category']        = (int)$data->category;
       $book_data['publisher']       = (int)$data->publisher;
       $book_data['publishdate']     = $data->publishdate;
       $book_data['price']           = $data->price;       
       $book_data['quantity']        = $data->quantity;
       $book_data['isbn']            = $data->isbn;
       $book_data['image1']          = $images['image1'];
       $book_data['image2']          = $images['image2'] !== null ? $images['image2'] : null;
       $book_data['slug']            = $this->strtoslug($data->title);
       $book_data['entrydate']            = date("Y-m-d H:i:s");
  

       //validate in backend
    //    if(!preg_match("/^[a-zA-Z 0-9_-\']+$/",trim($book_data['title']))){
    //           $_SESSION['error'] .= "Please enter valid book title ";

    //    }


       if(!is_numeric($book_data['quantity'])){
        $_SESSION['error'] .= "Please enter valid quantity  ";

        }
       if(!is_numeric($book_data['price'])){
        $_SESSION['error'] .= "Please enter valid price ";

        }

        //check for error in input
       if (!isset($_SESSION['error']) || $_SESSION['error']=="") {

            //check if the book already exists
           $sql = "SELECT isbn FROM book where isbn = :isbn limit 1";
           $list['isbn'] = $book_data['isbn'];
           $check1 = $conn->read($sql,$list);
           if (is_array($check1) && count($check1) >=1) {
               $_SESSION['error']="ERROR: Duplicate book";
               return false;
           }
           $query = "INSERT INTO book (title, author, category, publisher, publishdate, price, quantity, isbn, image1,image2, slug, entrydate) VALUES (:title, :author, :category, :publisher, :publishdate, :price, :quantity, :isbn, :image1, :image2, :slug, :entrydate)";

           $check = $conn->write($query,$book_data);
            if ($check) {
                 return true;
            }
            $_SESSION['error'] = "Problem with write query";

       }



    }

    public function editBook($data){
      $conn   =  Database::newInstance();
      $list    = [];
      $images = uploadImage();
      foreach($images as $key =>$value){
        $list[$key] = $value;

      }

       $id = (int)$data->id;
      $list['id']          = $id;
      $list['title']       = $data->title;
      $list['author']      = $data->author;
      $list["category"]    = $data->category;
      $list["publisher"]   = $data->publisher;
      $list["publishdate"] = $data->publishdate;
      $list['price']       = $data->price;
      $list['category']    = $data->category;
      $list['quantity']    = $data->quantity;
      $list['isbn']        = $data->isbn;
      // $list['image1']      = $images['image1'];
      // $list['image2']      = $images['image2'] !== null ? $images['image2'] : null;
      $list['slug']         = $this->strtoslug($data->title);
      $list['entrydate']        = date("Y-m-d H:i:s");
  
      if(!isset($_SESSION['error']) || $_SESSION['error']==""){
        // $query = "UPDATE book SET name = :name,description = :description,price = :price,category = :category,quantity = :quantity,image1 = :image1, image2 = :image2, image3 = :image3, date = :date WHERE id = :id limit 1 ";
        $query = "UPDATE book SET title = :title, author = :author, category = :category,publisher = :publisher, publishdate = :publishdate, price = :price, quantity = :quantity, isbn = :isbn, image1 = :image1, image2 = :image2, slug = :slug , entrydate = :entrydate WHERE id = :id limit 1 ";
        $conn->write($query,$list);
      }    

    }

    // Function to delete book
    
    public function deleteBook($id){

      $conn =  Database::newInstance();
      $id = (int)$id;
      $query = "DELETE FROM book WHERE id ='$id' limit 1 ";
      $conn->write($query);

    }

    public function getBooks(){
        $conn =  Database::newInstance();

        return $conn->read("SELECT *FROM book order by id asc");
    }


    function make_table($books){
        // print_r($books);
      $db =  Database::newInstance();
      $result="";
        if(is_array($books)){
          $books = (object)$books; // this is not object
          $counter = 0;
          foreach ($books as $book) {
          // $args = $book["id"]. ",'". $book["name"]."'";
            $args = $book["id"];
            //From the category table get the categoryname  associated with this book
            $catarr['id']= $book['category'];
            $sql = "SELECT categoryName FROM category where id =:id";
            $response = $db->read($sql,$catarr);
            $category = "";
            if($response){
               $category = $response[$counter]["categoryName"];
             }
             //From the author table get the authorname  associated with this book
            $autharr['id']= $book['author'];
            $sql = "SELECT name FROM author where id =:id";
            $response = $db->read($sql,$autharr);
            $author = "";
            if($response){
               $author = $response[$counter]["name"];
             }
             //From the publisher table get the publishername  associated with this book
             $pubarr['id']= $book['publisher'];
             $sql = "SELECT publisherName FROM publisher where id =:id";
             $response = $db->read($sql,$pubarr);
             $publisher = "";
             if($response){
                $publisher = $response[$counter]["publisherName"];
              }

            //data to be displayed in the backend edit/update form
            $info = array();
            $info["id"]           = $book["id"];
            $info["title"]        = $book["title"];
            $info["author"]       = $book["author"];
            $info["category"]     = $book["category"];
            $info["publisher"]    = $book["publisher"];
            $info["publishdate"]  = $book["publishdate"];
            $info["price"]        = $book["price"];
            $info["quantity"]     = $book["quantity"];
            $info["isbn"]         = $book["isbn"];
            $info["image1"]       = $book["image1"];
            $info["image2"]       = $book["image2"];


            //conver json to string
            $info = json_encode($info);
            $info =  str_replace('"',"'",json_encode($info));

            //data to be displayed in the backend book table
            $result .= "<tr>";

              $result.='
              <td>'.$book["id"].'</td>
              <td>'.$book["title"].'</td>
              <td>'.$author .'</td>
              <td>'.$category .'</td>
              <td>'.$publisher .'</td>
              <td>'.$book["publishdate"].'</td>
              <td>'.$book["price"].'</td>
              <td>'.$book["quantity"] .'</td>
              <td>'.$book["isbn"] .'</td>

              <td><img src ="'.ROOT.$book["image1"] .'" style="width:45px;height:45px;"/></td>
              <td><img src ="'.ROOT.$book["image2"] .'" style="width:45px;height:45px;"/></td>
               <td>'.date("jS M Y H:i:s", strtotime($book["entrydate"])) .'</td>



                   <td>
                       <button info = "'.$info.'"  onclick="edit_record('.$args.', event)" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#editBookModal"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-xs"  onclick="delete_record(event,'.$book["id"].')"><i class="fa fa-trash-o "></i></button>
                   </td>';

            $result.= "</tr>";


          }
          $counter++;


        }
        return $result;

      }



  public function strtoslug($url){
    $url = preg_replace('~[^\\pL0-9_]+~u', '-',$url);
    $url = trim($url, '-');
    $url = iconv("utf-8","us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9]+~','',$url);

    return $url;

  }





} //end of class
