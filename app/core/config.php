<?php

// Constansts
define("WEBSITE","Bookstre");

define("DB_TYPE",'mysql');
define("DB_HOST","localhost");
define("DB_NAME","bookstore");
define("DB_USER","root");
define("DB_PASS","passme2020");
define("PROTOCOL","http");

//paths to important folders
$path = str_replace("\\","/",PROTOCOL ."://". $_SERVER['SERVER_NAME']. __DIR__ ."/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'],"",$path);
define('ROOT',str_replace("app/core","public", $path));
define("ASSETS", str_replace("app/core","public/assets",$path));

//debug- Dev mode 
define('DEBUG',true);
if(DEBUG){
    ini_set("display_errors",1);
}else{
    ini_set("display_errors",0);
}






