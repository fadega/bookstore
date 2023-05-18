<?php
// class to perform database operations
class Database{
    
    public static $conn;
    
    public function __construct()
    {
        try{
            $datasource = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
            self::$conn = new PDO($datasource,DB_USER,DB_PASS);
        }catch(PDOException $er){
            die($er->getMessage());
        }
    }
    // function to connect to the database
    public static function db_connect(){
        if(self::$conn){
           return self::$conn;
        }
        return $instance = new self();
    }
    //prevent cloning of the same instance
    public static function newInstance(){
        return $instance = new self();
    }
    // Function to read from the database and returns true or false based the result
    public function read($query, $data = []){  
        $stmt = self::$conn->prepare($query);
        $result = $stmt->execute($data);
        if($result){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($data) && count($data) > 0){            
                return $data;
            }
        }
        return false;
    } 

    // Function to write into the database and returns true if the operation is successful
    public function write($query, $data = []){ 
        $stmt = self::$conn->prepare($query);
        $result = $stmt->execute($data);   
        if($result){   
          return true;       
        }
        return false;
    } 
  
}



