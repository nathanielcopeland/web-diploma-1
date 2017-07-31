<?php

$user = "user";
$password = "password";
$host= "localhost";
$database ="datastore";

//create connection
$connection = mysqli_connect($host,$user,$password,$database);

//check connection
if(!$connection){
    echo "database error";
} else{
    
}



?>