<?php

// c;ass to handle a signle book details display
class BookDetails extends Controller{

    function index($slug){
           
           $user = $this->loadModel('user');
           $userdata = $user->loginStatus();
           if(is_array($userdata)){
                $data['email']  = $userdata['email'];
                $data['name']   = $userdata['name'];
                $data['role']   = $userdata['role'];
                $data['userid'] = $userdata['userid'];

           }
           
           $conn = Database::newInstance();
           $list['slug']= $slug;
           $singlerow = $conn->read("SELECT *FROM book where slug =:slug",$list);

           $catid = $singlerow[0]['category'];
           $cat['id'] = $catid;

           //get catname that matches the id 
           $categoryname = $conn->read("SELECT categoryName FROM category where id = :id",$cat);
          
           $pubid = $singlerow[0]['publisher'];
           $pub['id'] = $pubid;

            //get publisher that matches the id 
            $publisherName = $conn->read("SELECT publisherName FROM publisher where id = :id",$pub);

            $authid = $singlerow[0]['author'];
            $auth['id'] = $authid;
 
            //get publisher that matches the id 
            $authorName = $conn->read("SELECT name FROM author where id = :id",$auth);

           $conn = Database::newInstance();
           $books = $conn->read("SELECT *FROM book limit 10");
          
          
          //passing data to views
          $data['book']          = $singlerow[0];
          $data['categoryName']  = $categoryname;   
          $data['publisherName'] = $publisherName;    
          $data['author']        = $authorName;    
          $data['BOOKS']         = $books;    
          $data["pageTitle"]     = "Book Details";
          $this->view("store/bookdetails",$data);
        
    }

   
}