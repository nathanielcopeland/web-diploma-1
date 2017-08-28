<?php

$user = getenv("dbuser"); //"user";
$password = getenv("dbpassword"); //"password";
$host= getenv("dbhost"); //"localhost";
$database = getenv("dbname"); //"daftastore";

//create connection
$connection = mysqli_connect($host,$user,$password,$database);

//check connection
if(!$connection){
    echo "database error";
} else{
    
}



?>