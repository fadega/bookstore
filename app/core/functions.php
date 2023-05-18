<?php


//Function to check for errors when registering and displaying them
function errorMessage(){
    if(isset($_SESSION['error']) && $_SESSION['error'] !=""){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['duplicateemail']) && $_SESSION['duplicateemail'] !=""){
        echo $_SESSION['duplicateemail'];
        unset($_SESSION['duplicateemail']);
    }
    if(isset($_SESSION['signin_error']) && $_SESSION['signin_error'] !=""){
        echo $_SESSION['signin_error'];
        unset($_SESSION['signin_error']);
    }
}

//Function to validate user input during registration
function validateInput($name, $email, $password,$password2,$phone,$address){
    $error = "";
    if(empty($email) || !preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z]+.[a-zA-Z]+$/",$email)){
        $error.= 'The email is not formatted properly <br/>';
    }
    if(empty($name) || !preg_match("/^[a-zA-Z\s]+$/",$name)){
        $error.= 'Name should only contain alphabets <br/>';       
    }
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
        $error.= "Password doesn't meet the minimum requirements <br/> ";
        }
    if($password !==$password2){
        $error.= 'Password does not match <br/> ';
    }

    if(!empty($phone) && !preg_match("/^[0-9]{11}+$/", $phone)){
        $error.= 'Please enter a valid phone number  <br/>';   
    }
    $letters = preg_match('@[a-zA-Z]@', $address);
    $number    = preg_match('@[0-9]@', $address);
    if(!empty($address) && !$letters && !$number){
        $error.= 'Valid address may look like 123 example street  <br/>';
    }
    return $error;
}

//Function to upload images to upload folder
function uploadImage(){
    $size = 15;
    $size = ($size *1024 *1024);
    $allowed[] = "image/jpeg";
    $allowed[] = "image/png";
    $list = array();
    $dir = "uploads/";
    if(!file_exists($dir)){
      mkdir($dir,0777,true);
    }
    foreach($_FILES as $key => $img_row){
        if($img_row['error']=="" && in_array($img_row['type'], $allowed) ){
        if($img_row['size'] < $size){
            $destination = $dir.$img_row['name'];
            move_uploaded_file($img_row['tmp_name'], $destination);
            $list[$key] = $destination;

        }else{
            $_SESSION['error'] .= $key ."is larger than max upload size (5 megabyte max)  <br/> ";
        }

        }
    }
   return $list;
}

//Function that returns a slug with dashes inbetween words
function addDashes($slug){
    return addslashes($slug);
}

function display($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}