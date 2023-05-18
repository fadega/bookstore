<?php
//model class for user
class User{
    // function to register a new user
    public function register($POST){

        //create instance to establish connection to the databse
       $instance = Database::db_connect();

       //Get POST data from user
       $name        = trim($POST['name']);
       $email       = trim($POST['email']);
       $password    = trim($POST['password']);
       $password2   = trim($POST['password2']);
       $phone       = trim($POST['phone']);
       $address     = trim($POST['address']);
       //$checkagree  = $POST['termscheck'];
 
       //call function to validate user input
       $error = validateInput($name, $email, $password,$password2,$phone,$address);
       if($error==""){
           $hashedPass = hash('sha1',$password);
           $data['name']     = $name; 
           $data['email']    = $email; 
           $data['password'] = $hashedPass;
           $data['userid']   = $this->generate_random_userid(60);
           $data['phone']    = $phone;
           $data['address']  = $address;
           
           //fixed entries
           $data['date'] = date("Y-m-d H:i:s");
           $data['role'] = "customer";
 
            //Before pushing data to database, check if there is a user with the same email already in the database
            $query        = "SELECT email FROM user WHERE email = :email limit 1";
            $list['email'] = $data['email'];
            $check        = $instance->read($query,$list);
            if(is_array($check) && count($check)>0){
                $message ='<a href="'.ROOT.'signin" class="text-success">login</a> instead  <br/>';
                $_SESSION['duplicateemail'] = "User with this email already exists, ".$message;
            }
            
            //One last check for userid before pushing data to database
            $list           = []; //unset the array from previous value
            $sql           = "SELECT userid FROM user WHERE userid = :userid limit 1";
            $list['userid'] = $data['userid'];
            $check         = $instance->read($sql,$list);
            if(is_array($check)){
                //generate another random userid
                $data['userid']   = $this->generate_random_userid(60);  
            }
            //Push data to database
           $query = "INSERT INTO user (userid,name,email,phone,password,role,address,date) VALUES( :userid, :name, :email, :phone, :password, :role, :address, :date)";
           $success = $instance->write($query,$data);
           if($success){
              //redirect and exit from here;
               header('location:'.ROOT.'signin');
               die;
           }
 
       }else{
           $_SESSION['error']  = $error;
           
       }

    }

   //Function to sign in user
    public function signin($POST){
       $instance = Database::db_connect();
       unset($_SESSION['error']); // unset previous errors

       $error                  = "";
       $data['email']          = trim($POST['email']);
       $data['password']       = trim($POST['password']);
       $keepme['keepmesigned'] = "";

       if(isset($POST['keepmesigned'])) {
           $keepme['keepmesigned'] = $POST['keepmesigned'];     
       }
      
       if(empty($data['email']) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$data['email'])){
               $error.= 'Wrong eamil or password  <br/>';
        }
        $uppercase    = preg_match('@[A-Z]@', $data['password']);
        $lowercase    = preg_match('@[a-z]@', $data['password']);
        $number       = preg_match('@[0-9]@', $data['password']);
        // $specialChars = preg_match('@[^\w]@', $data['password']);
        
        if(!$uppercase || !$lowercase || !$number || strlen($data['password']) < 6) {
            if($error == ""){ // don't repeat the error message
                $error.= "Wrong eamil or password  <br/>";
            }
        }

        if($error == ""){
            $data['password'] = hash('sha1',$data['password']);
            $query = "SELECT * FROM user WHERE email = :email && password = :password limit 1";
            $result = $instance->read($query,$data);
            if(is_array($result)){
                $_SESSION['logged']  = $result[0];
                display($result[0]);
                if($_SESSION['logged']['role']=="admin"){
                    header('location:'.ROOT.'admin');
                    die;  
                }else{
                    header('location:'.ROOT.'profile');
                    die;
                }
                
                //keep user logged in if they check the keep me signed in checkbox
                // if($keepme['keepmesigned'] == "on"){
                //     echo "got here \n";
                //     //set cookie
                //     setcookie("email",$data['email'],time()+3600*24*30);
                //     setcookie("password",$data['password'],time()+3600*24*30);
                // }
            //    else{
            //        //unset cookie
            //        setcookie("email","",time()-3600);
            //        setcookie("password","",time()-3600);
            //    }
            }
                   
            $error.= "Oops! Wrong credentials  <br/>";

        }
            //if execution gets here, it meeans credentials weren't OK
           $_SESSION['error']  = $error;

    }

    //Function to validate user's login
    public function validateLogin($email, $password){
        $error = "";
        if (empty($email)) {
            $error .= "Email is required <br/>";
        }
        if (empty($password)) {
            $error .= "Password is required <br/>";
        }
        return $error;
    }


   //check if user is logged in
    public function loginStatus($redirect = false){
        if(isset($_SESSION['logged'])){
            $user['userid'] = $_SESSION['logged']['userid'];
            $sql = "SELECT * FROM user WHERE userid = :userid limit 1";
            $db = Database::db_connect();
            $result = $db->read($sql,$user);
            if(is_array($result)){
                //user is logged in
                 return $result[0]; //return the first/only row[array]
            }
        }
        if($redirect){
            header('location:'.ROOT.'signin');
            die;
        }
        return false;
    }

     //generate a random userid
    public function generate_random_userid($len){
        
        $array = [0,1,2,3,4,5,6,7,8,9, 'A','a', 'B', 'b','C', 'c', 'D', 'd','E', 'e', 'F', 'f', 'G', 'g', 'H' ,'h', 'I', 'i', 'J', 'j' ,'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P' ,'p' ,'Q','q', 'R', 'r', 'S', 's', 'T', 't' ,'U' ,'u', 'V', 'v', 'W', 'w' ,'X' ,'x' ,'Y' ,'y' ,'Z' ,'z'];
        $randomuserid = "";
        $length = rand(6,$len);
        for($i=0; $i<$length; $i++){
            $random = rand(0,61);
            $randomuserid .= $array[$random];
        }
         return $randomuserid;
     }

    //sign out user
    public function signout(){
        if(isset($_SESSION['logged'])){
            unset($_SESSION['logged']);
            //   redirect to login page
            header("location:".ROOT."signin");
            die;
        }
      
    }
    //delete user profile
    public function deleteProfile($email){
        $conn =  Database::newInstance();
        $query = "DELETE FROM user WHERE email ='$email' limit 1 ";
        $result = $conn->write($query);
        if($result){
          unset($_SESSION['logged']);
          header("location:" .ROOT);
        }

      }


}