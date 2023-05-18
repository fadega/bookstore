<?php
// class handles views of admin area including books, authors, categories, publishers etc
class Admin extends Controller
{
    public function index()
    {
        //check if user is logged in
        $user = $this->loadModel('user');
        $userdata = $user->loginStatus(true);
        if (is_array($userdata)) {
            $data['email']    = $userdata['email'];
            $data['name']     = $userdata['name'];
            $data['role']     = $userdata['role'];
            $data['userid']   = $userdata['userid'];
            $data['phone']    = $userdata['phone'];
            $data['address']  = $userdata['address'];
        }
        
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $data["pageTitle"] = "Admin";; 
                $this->view("admin/admin",$data); 
            } else if($_SESSION['logged']['role']=="customer"){
                $data["pageTitle"] = "Profile";
                $this->view("store/profile",$data); //will take non admin to 404 page
            }
            
        }else{
            $data=[];
            $data["pageTitle"] = "Page not found";
            $this->view("store/404",$data);
        }
    }


    //This method is used to pull data related to books from the database and pass it to the view
       
      function books(){

        $user = $this->loadModel('User');
        $userdata = $user->loginStatus();
        if(is_array($userdata)){
            //collect user info
            $data['email']    = $userdata['email'];
            $data['name']     = $userdata['name'];
            $data['role']     = $userdata['role'];
            $data['userid']   = $userdata['userid'];
            $data['phone']    = $userdata['phone'];
            $data['address']  = $userdata['address'];
        }
     
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM book order by title";
        $books = $conn->read($sql,[]); 
      
        //Get categories and feed the lookup in the books modal while adding a new book
        $query= "SELECT *FROM category order by categoryName";
        $categories = $conn->read($query,[]); 
        $data["categories"] = $categories;


        //Get authors and feed the lookup in the books modal while adding a new book
        $query= "SELECT *FROM author order by name";
        $authors = $conn->read($query,[]); 
        $data["authors"] = $authors;

        //Get publishers and feed the lookup in the books modal while adding a new book
        $query= "SELECT *FROM publisher order by publisherName";
        $publishers = $conn->read($query,[]); 
        $data["publishers"] = $publishers;
    
        $book = $this->loadModel('Book');
        $tblRows = $book->make_table($books);
        $data["tblRows"] = $tblRows;
        $data["books"] = $books;

        if(is_array($books)){
            $data["tblRows"] = $tblRows;
            $data["books"] = $books;  
       }

        $data["pageTitle"] = "Books";
        if(isset($_SESSION['logged'])){
            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/books",$data);
            }       
        }else{
            $this->view("store/404",$data);
        }
       
  
    }

    function authors(){
      
        $user = $this->loadModel('user');
        $userdata = $user->loginStatus();
        if(is_array($userdata)){
            $data['email']    = $userdata['email'];
            $data['name']     = $userdata['name'];
            $data['role']     = $userdata['role'];
            $data['userid']   = $userdata['userid'];
            $data['phone']    = $userdata['phone'];
            $data['address']  = $userdata['address'];
    
        }
      
        //Get authors to populate the backend
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM author order by id ";
        $authors = $conn->read($sql,[]); 
        
        $author = $this->loadModel('Author');
        $tblRows = $author->make_table($authors);
        $data["tblRows"] = $tblRows;
        $data["authors"] = $authors;
        if(is_array($authors)){
             $data["tblRows"] = $tblRows;
             $data["authors"] = $authors;
            
        }

        $data["pageTitle"] = "Authors";
        if(isset($_SESSION['logged'])){
            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/authors",$data);
            } else if($_SESSION['logged']['role']=="customer"){
                $this->view("store/index",$data); //will take non admin to 404 page
            }
            
        }else{
            $this->view("store/404",$data);
        }
    }

    // Function to handle the categories page in the admin area
    function categories(){
      
        $user = $this->loadModel('user');
        $userdata = $user->loginStatus();
        if(is_array($userdata)){
            $data['email']    = $userdata['email'];
            $data['name']     = $userdata['name'];
            $data['role']     = $userdata['role'];
            $data['userid']   = $userdata['userid'];
            $data['phone']    = $userdata['phone'];
            $data['address']  = $userdata['address'];
    
        }
        //get category data to be displayed in dashboard
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM category order by id ";
        $categories = $conn->read($sql,[]); 
        
        $category = $this->loadModel('Category');
        $tblRows = $category->make_table($categories);
        $data["tblRows"] = $tblRows;
        $data["categories"] = $categories;
        if(is_array($categories)){
             $data["tblRows"] = $tblRows;
             $data["categories"] = $categories;     
        }

        $data["pageTitle"] = "Categories";
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/categories",$data);
            } else if($_SESSION['logged']['role']=="customer"){
                $this->view("store/index",$data); //will take non admin to 404 page
            }
            
        }else{
            $this->view("store/404",$data);
        }
    }

    // Function to handle the publishers page in the admin area/dashboard
    function publishers(){
      
        $user = $this->loadModel('user');
        $userdata = $user->loginStatus();
        if(is_array($userdata)){
            $data['email']    = $userdata['email'];
            $data['name']     = $userdata['name'];
            $data['role']     = $userdata['role'];
            $data['userid']   = $userdata['userid'];
            $data['phone']    = $userdata['phone'];
            $data['address']  = $userdata['address'];
    
        }
      
         //get publisher data to be displayed in dashboard
        $conn =  Database::newInstance();
        $sql= "SELECT *FROM publisher order by id ";
        $publishers = $conn->read($sql,[]); 
        
        $publisher = $this->loadModel('Publisher');
        $tblRows = $publisher->make_table($publishers);
        $data["tblRows"] = $tblRows;
        $data["publishers"] = $publishers;
        if(is_array($publishers)){
             $data["tblRows"] = $tblRows;
             $data["publishers"] = $publishers;     
        }
        $data["pageTitle"] = "Publishers";
        if(isset($_SESSION['logged'])){

            if($_SESSION['logged']['role']=="admin"){
                $this->view("admin/publishers",$data);
            } else if($_SESSION['logged']['role']=="customer"){
                $this->view("store/index",$data); //will take non admin to 404 page
            }      
        }else{
            $this->view("store/404",$data);
        }
       
  
    }
    
}